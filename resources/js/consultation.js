const apiUrl = "http://127.0.0.1:8000/api/appointment";
let countdown = 5;

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

    console.log(data);

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

            submitAppointmentModal
                .querySelector(".modal-container")
                .classList.add("bg-green-100");
            submitAppointmentModal.querySelector(
                ".modal-header h2"
            ).textContent = "Success";
            submitAppointmentModal.querySelector(
                ".modal-body .modal-info"
            ).textContent = "Your appointment has been submitted successfully";
            finalAppointmentBtn.textContent = "Redirecting in ...";

            // Create an interval to update the button text every second
            let interval = setInterval(() => {
                finalAppointmentBtn.textContent = `Redirecting in ${countdown}...`;
                countdown--;

                if (countdown < 0) {
                    clearInterval(interval);
                    window.location.href = `http://127.0.0.1:8000/consultation/${data.id}`;
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
let currentStep = 2;

let consultationParent = document.querySelector(".consultation");
let progress = document.querySelectorAll(".consultation .container");
let nextBtn = document.querySelector(".next-btn");

let appointmentForOptions = document.querySelectorAll(".appointment-option");

consultationParent.addEventListener("click", function (e) {
    // Next button
    if (e.target.classList.contains("next-btn")) {
        currentStep += 1;

        progress.forEach((progress) => {
            if (currentStep == progress.getAttribute("data-step")) {
                progress.classList.remove("hidden");
            }

            if (currentStep != progress.getAttribute("data-step")) {
                progress.classList.add("hidden");
            }
        });
    }

    // Previous button
    if (e.target.classList.contains("previous-btn")) {
        currentStep -= 1;

        progress.forEach((progress) => {
            if (currentStep == progress.getAttribute("data-step")) {
                progress.classList.remove("hidden");
            }

            if (currentStep != progress.getAttribute("data-step")) {
                progress.classList.add("hidden");
            }
        });
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
            // console.log(data);
            currentStep = data.step;
            progress.forEach((progress) => {
                if (currentStep == progress.getAttribute("data-step")) {
                    progress.classList.remove("hidden");
                }

                if (currentStep != progress.getAttribute("data-step")) {
                    progress.classList.add("hidden");
                }
            });
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
