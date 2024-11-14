const apiUrl = "http://127.0.0.1:8000/api/appointment";
let countdown = 1;
let currentStep = 2;

let SUPER_DATA = {
    appointment_id: 1,
    appointment_date: "2024-11-22",
    appointment_status: "PENDING",
    personal_information: {
        first_name: "tite",
        last_name: "tite",
        email: "tite@tite.tite",
    },
};

let submitAppointmentBtn = document.querySelector(".appointment-btn");
let submitAppointmentModal = document.querySelector(
    ".modal-submit-consultation"
);
let modalCancelBtn = document.querySelectorAll(".modal-close");
let finalAppointmentBtn = document.getElementById("submitButton");
let form = document.querySelector("#appointmentForm");

// Show modal when submit btn is pressed
submitAppointmentBtn?.addEventListener("click", function (e) {
    e.preventDefault();

    // Loop through each input element in the form
    Array.from(form.elements).forEach(function (input) {
        if (!input.checkValidity()) {
            input.classList.add("invalid-input");
        } else {
            input.classList.remove("invalid-input");
        }
    });

    if (form.checkValidity()) {
        submitAppointmentModal.classList.remove("hidden");
    }
});

// Hide modal when modal close button is pressed
submitAppointmentModal.addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("modal-close")) {
        submitAppointmentModal.classList.add("hidden");
    }
});

// Consultation Form Submission
finalAppointmentBtn.addEventListener("click", function (event) {
    event.preventDefault();

    const data = {};

    data.appointment_information = {
        appointment_date: form.querySelector("input[name='appointment_date']")
            .value,
        patient_id: 1,
    };
    data.personal_information = {
        first_name: "John",
        last_name: "Doe",
        birthdate: "1990-01-01",
        gender: "male",
    };
    data.contact_information = {
        phone_number: "123-456-7890",
        email: "johndoe@example.com",
    };
    data.consultation_information = {
        chief_complaint: "Persistent headache",
        referral_form: form.querySelector("input[name='referral_form']").value,
    };
    data.health_information = {
        height: "175 cm",
        weight: "70 kg",
        weight_changed_past_year: true,
        exercise: false,
        medical_reason: true,
        stress_level: "high",
    };
    data.nutrition_information = {
        meet_past_dietitian: true,
        special_diet: true,
        food_preference: "Vegetarian",
        who_grocery: "Myself",
        who_prepare_meal: "Myself",
        skip_meals: false,
    };

    finalAppointmentBtn.textContent = "Submitting...";

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            console.log(data);

            currentStep = data.appointment_information.step;

            let appointment_info = data.appointment_information;
            let personal_info = data.personal_information;

            SUPER_DATA = {
                appointment_id: appointment_info.id,
                appointment_date: appointment_info.appointment_date,
                appointment_status: appointment_info.status,
                personal_information: {
                    first_name: personal_info.first_name,
                    last_name: personal_info.last_name,
                    email: personal_info.email,
                },
            };

            // add green bg
            submitAppointmentModal
                .querySelector(".modal-container")
                .classList.add("bg-green-100");

            // change HEADER to Success
            submitAppointmentModal.querySelector(
                ".modal-header h2"
            ).textContent = "Success";

            // Remove cancel button
            submitAppointmentModal
                .querySelector(".modal-close")
                .classList.add("hidden");

            // Change DESCRIPTION
            submitAppointmentModal.querySelector(
                ".modal-body .modal-info"
            ).textContent = "Your appointment has been submitted successfully";

            // Change button to Redirecting
            finalAppointmentBtn.textContent = "Redirecting in ...";

            // Create an interval to update the button text every second
            let interval = setInterval(() => {
                finalAppointmentBtn.textContent = `Redirecting in ${countdown}...`;
                countdown--;

                if (countdown < 0) {
                    clearInterval(interval);

                    // hide current modal
                    submitAppointmentModal.classList.add("hidden");

                    change_step(currentStep, progress, SUPER_DATA);

                    // window.location.href = `http://127.0.0.1:8000/consultation/${data.id}`;
                }
            }, 1000);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

//
//
//
//

let consultationParent = document.querySelector(".consultation");
let progress = document.querySelectorAll(".consultation .container");
let nextBtn = document.querySelector(".next-btn");

let appointmentForOptions = document.querySelectorAll(".appointment-option");

consultationParent.addEventListener("click", function (e) {
    // Next button
    if (e.target.classList.contains("next-btn")) {
        currentStep += 1;

        change_step(currentStep, progress, SUPER_DATA);
    }

    // Previous button
    if (e.target.classList.contains("previous-btn")) {
        currentStep -= 1;

        change_step(currentStep, progress, SUPER_DATA);
    }

    // appointment for
    if (e.target.closest(".appointment-option")) {
        appointmentForOptions.forEach((option) => {
            if (option.querySelector("input").checked) {
                option.classList.add("radio-checked");
            } else {
                option.classList.remove("radio-checked");
            }
        });
    }
});

//
//
//
//

const currentPath = window.location.pathname;
const pathParts = currentPath.split("/");
const appointmentId = pathParts[pathParts.length - 1];

// FOR SEARCH FUNCTION
if (appointmentId > 0) {
    let data = {
        patient_id: 1,
    };

    let url = `${apiUrl}/${appointmentId}`;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            currentStep = data.step;

            change_step(currentStep, progress, SUPER_DATA);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function step_two(progress, data) {
    console.log(data);

    // appointment number
    progress.querySelector(
        "input[name='appointment_number']"
    ).value = `#${data.appointment_id}`;

    // appointment status
    progress.querySelector(
        "input[name='appointment_status']"
    ).value = `${data.appointment_status.toUpperCase()}`;

    // appointment date
    progress.querySelector(
        "input[name='appointment_date']"
    ).value = `${data.appointment_date}`;

    // submitAppointmentBtn.classList.add("hidden");
    progress.querySelector(".doctor-container img").src =
        "http://127.0.0.1:8000/images/blank_doctor.png";

    // remove floating
    progress
        .querySelector(".doctor-container .floating-info")
        .classList.add("hidden");
}

function step_one(progress, data) {
    submitAppointmentBtn.classList.add("hidden");
    progress.querySelector(".next-btn").classList.remove("hidden");

    progress.querySelector(
        "input[name='first_name']"
    ).value = `${data.personal_information.first_name}`;
    progress.querySelector("input[name='first_name']").disabled = true;
    progress
        .querySelector("input[name='first_name']")
        .classList.add("bg-gray-200");

    progress.querySelector(
        "input[name='last_name']"
    ).value = `${data.personal_information.last_name}`;
    progress.querySelector("input[name='last_name']").disabled = true;
    progress
        .querySelector("input[name='last_name']")
        .classList.add("bg-gray-200");
}

function change_step(currentStep, progress, data) {
    progress.forEach((progress) => {
        if (currentStep == progress.getAttribute("data-step")) {
            progress.classList.remove("hidden");

            if (currentStep == 1) {
                console.log("trigger", currentStep);
                step_one(progress, data);
            }

            if (currentStep == 2) {
                console.log("trigger", currentStep);
                step_two(progress, data);
            }
        }

        if (currentStep != progress.getAttribute("data-step")) {
            progress.classList.add("hidden");
        }
    });
}
