const apiUrl = "http://127.0.0.1:8000/api/appointment";
const token = localStorage.getItem("api_token");

// VARIABLES
let countdown = 1;
let currentStep = 2;
let currentUser = "patient";
let currentId = 1;

// DATA
let SUPER_DATA = {
    appointment_id: "LOADING",
    appointment_date: "LOADING",
    appointment_status: "LOADING",
    appointment_information: {
        appointment_date: "LOADING",
        appointment_status: "LOADING",
        appointment_id: "LOADING",
        appointment_step: "LOADING",
    },
    dietitian_information: {
        first_name: "LOADING",
        last_name: "LOADING",
        image: "LOADING",
        id: "LOADING",
    },
    personal_information: {
        first_name: "LOADING",
        last_name: "LOADING",
        birthdate: "LOADING",
        gender: "LOADING",
    },
    contact_information: {
        phone_number: "LOADING",
        email: "LOADING",
    },
    consultation_information: {
        chief_complaint: "LOADING",
        referral_form: "LOADING",
    },
    health_information: {
        height: "LOADING",
        weight: "LOADING",
        weight_changed_past_year: "LOADING",
        exercise: "LOADING",
        medical_reason: "LOADING",
        stress_level: "LOADING",
    },
    nutrition_information: {
        meet_past_dietitian: "LOADING",
        special_diet: "LOADING",
        food_preference: "LOADING",
        who_grocery: "LOADING",
        who_prepare_meal: "LOADING",
        skip_meals: "LOADING",
    },
};

let chatForm = document.querySelector("#chatForm");
let sendMessageBtn = document.querySelector("#send_message");

sendMessageBtn.addEventListener("click", function (e) {
    sendMessageBtn.disabled = true;
    let messageInput = chatForm.querySelector("input[name='message_content']");

    const data = {
        appointment_id: SUPER_DATA.appointment_information.appointment_id,
        message_content: messageInput.value,
        recipient_id: SUPER_DATA.dietitian_information.id,
    };

    let apiUrl = `http://127.0.0.1:8000/api/chat`;

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            if (data) {
                messageInput.value = "";
                sendMessageBtn.disabled = false;
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

let submitAppointmentBtn = document.querySelector(".appointment-btn");
let submitAppointmentModal = document.querySelector(
    ".modal-submit-consultation"
);
let modalCancelBtn = document.querySelectorAll(".modal-close");
let finalAppointmentBtn = document.getElementById("submitButton");
let form = document.querySelector("#appointmentForm");

let consultationParent = document.querySelector(".consultation");
let progress = document.querySelectorAll(".consultation .container");
let nextBtn = document.querySelector(".next-btn");
let appointmentForOptions = document.querySelectorAll(".appointment-option");

// web path
const currentPath = window.location.pathname;
const pathParts = currentPath.split("/");
const appointmentId = pathParts[pathParts.length - 1];

// Show modal when submit btn is pressed
submitAppointmentBtn?.addEventListener("click", function (e) {
    e.preventDefault();

    // when input is invalid
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
    };
    data.personal_information = {
        first_name: form.querySelector("input[name='first_name']").value,
        last_name: form.querySelector("input[name='last_name']").value,
        birthdate: form.querySelector("input[name='birthdate']").value,
        gender: form.querySelector("select[name='consult_gender']").value,
    };
    data.contact_information = {
        phone_number: form.querySelector("input[name='phone_numer']").value,
        email: form.querySelector("input[name='email']").value,
    };
    data.consultation_information = {
        chief_complaint: form.querySelector("input[name='chief_complain']")
            .value,
        referral_form: form.querySelector("input[name='referral_form']").value,
    };
    data.health_information = {
        height: form.querySelector("input[name='height']").value,
        weight: form.querySelector("input[name='weight']").value,
        weight_changed_past_year: form.querySelector(
            "select[name='consult_weight_changed_past_year']"
        ).value,
        exercise: form.querySelector("select[name='consult_exercise']").value,
        medical_reason: form.querySelector(
            "select[name='consult_medical_reason']"
        ).value,
        stress_level: form.querySelector("select[name='consult_stress_level']")
            .value,
    };
    data.nutrition_information = {
        meet_past_dietitian: form.querySelector(
            "select[name='consult_meet_past_dietician']"
        ).value,
        special_diet: form.querySelector("select[name='consult_special_diet']")
            .value,
        food_preference: form.querySelector("input[name='food_preference']")
            .value,
        who_grocery: form.querySelector("select[name='consult_who_grocery']")
            .value,
        who_prepare_meal: form.querySelector(
            "select[name='consult_who_prepare_meal']"
        ).value,
        skip_meals: form.querySelector("select[name='consult_skip_meals']")
            .value,
    };

    finalAppointmentBtn.textContent = "Submitting...";

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            currentStep = data.appointment_information.step;

            SUPER_DATA.appointment_information = {
                appointment_id: data.appointment_information.id,
                appointment_date: new Date(
                    data.appointment_information.appointment_date
                )
                    .toISOString()
                    .split("T")[0],
                appointment_status: data.appointment_information.status,
                appointment_step: data.appointment_information.step,
            };
            SUPER_DATA.personal_information = data.personal_information;
            SUPER_DATA.contact_information = data.contact_information;
            SUPER_DATA.consultation_information = data.consultation_information;
            SUPER_DATA.health_information = data.health_information;
            SUPER_DATA.nutrition_information = data.nutrition_information;

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
                    clearInterval(interval); // hide current modal submitAppointmentModal.classList.add("hidden");
                    submitAppointmentModal.classList.add("hidden");
                    change_step(currentStep, progress, SUPER_DATA);
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
// NEXT AND PREV BUTTON
consultationParent.addEventListener("click", function (e) {
    // Next button
    if (e.target.classList.contains("next-btn")) {
        currentStep += 1;

        if (
            currentStep == 4 &&
            SUPER_DATA.appointment_information.appointment_step >= 5
        ) {
            currentStep = 5;
        }

        change_step(currentStep, progress, SUPER_DATA);
    }

    // Previous button
    if (e.target.classList.contains("previous-btn")) {
        currentStep -= 1;

        if (
            currentStep == 4 &&
            SUPER_DATA.appointment_information.appointment_step >= 5
        ) {
            currentStep = 3;
        }

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

// FOR SEARCH FUNCTION
// FOR SEARCH FUNCTION
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
            Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            currentStep = data.step;

            SUPER_DATA.personal_information = data.personal_information;
            SUPER_DATA.contact_information = data.contact_information;
            SUPER_DATA.consultation_information = data.consultation_information;
            SUPER_DATA.health_information = data.health_information;
            SUPER_DATA.nutrition_information = data.nutrition_information;
            SUPER_DATA.dietitian_information = data.dietitian_information;

            SUPER_DATA.appointment_information = {
                appointment_id: data.id,
                appointment_date: new Date(data.appointment_date)
                    .toISOString()
                    .split("T")[0],
                appointment_status: data.status,
                appointment_step: data.step,
            };
            SUPER_DATA.personal_information.birthdate = new Date(
                data.personal_information.birthdate
            )
                .toISOString()
                .split("T")[0];

            change_step(currentStep, progress, SUPER_DATA);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function step_one(progress, data) {
    submitAppointmentBtn.classList.add("hidden");
    progress.querySelector(".next-btn").classList.remove("hidden");

    let first_name = progress.querySelector("input[name='first_name']");
    first_name.value = `${data.personal_information.first_name}`;
    disable_input(first_name);

    let last_name = progress.querySelector("input[name='last_name']");
    last_name.value = `${data.personal_information.last_name}`;
    disable_input(last_name);

    let birthdate = progress.querySelector("input[name='birthdate']");
    birthdate.value = `${data.personal_information.birthdate}`;
    disable_input(birthdate);

    let gender = progress.querySelector("select[name='consult_gender']");
    setOptionValue(gender, data.personal_information.gender);
    disable_input(gender);

    //
    let phone_number = progress.querySelector("input[name='phone_numer']");
    phone_number.value = `${data.contact_information.phone_number}`;
    disable_input(phone_number);

    let email = progress.querySelector("input[name='email']");
    email.value = `${data.contact_information.email}`;
    disable_input(email);

    //
    let chief_complaint = progress.querySelector(
        "input[name='chief_complain']"
    );
    chief_complaint.value = `${data.consultation_information.chief_complaint}`;
    disable_input(chief_complaint);

    let appointment_date = progress.querySelector(
        "input[name='appointment_date']"
    );
    appointment_date.value = `${data.appointment_information.appointment_date}`;
    disable_input(appointment_date);

    //
    let height = progress.querySelector("input[name='height']");
    height.value = `${data.health_information.height}`;
    disable_input(height);

    let weight = progress.querySelector("input[name='weight']");
    weight.value = `${data.health_information.weight}`;
    disable_input(weight);

    let weight_changed_past_year = progress.querySelector(
        "select[name='consult_weight_changed_past_year']"
    );
    setOptionValue(
        weight_changed_past_year,
        data.health_information.weight_changed_past_year
    );
    disable_input(weight_changed_past_year);

    let exercise = progress.querySelector("select[name='consult_exercise']");
    setOptionValue(exercise, data.health_information.exercise);
    disable_input(exercise);

    let medical_reason = progress.querySelector(
        "select[name='consult_medical_reason']"
    );
    setOptionValue(medical_reason, data.health_information.medical_reason);
    disable_input(medical_reason);

    let stress_level = progress.querySelector(
        "select[name='consult_stress_level']"
    );
    setOptionValue(stress_level, data.health_information.stress_level);
    disable_input(stress_level);

    //
    let meet_past_dietitian = progress.querySelector(
        "select[name='consult_meet_past_dietician']"
    );
    setOptionValue(
        meet_past_dietitian,
        data.nutrition_information.meet_past_dietitian
    );
    disable_input(meet_past_dietitian);

    let skip_meals = progress.querySelector(
        "select[name='consult_skip_meals']"
    );
    setOptionValue(skip_meals, data.nutrition_information.skip_meals);
    disable_input(skip_meals);

    let who_prepare_meal = progress.querySelector(
        "select[name='consult_who_prepare_meal']"
    );
    setOptionValue(
        who_prepare_meal,
        data.nutrition_information.who_prepare_meal
    );
    disable_input(who_prepare_meal);

    let who_grocery = progress.querySelector(
        "select[name='consult_who_grocery']"
    );
    setOptionValue(who_grocery, data.nutrition_information.who_grocery);
    disable_input(who_grocery);

    let special_diet = progress.querySelector(
        "select[name='consult_special_diet']"
    );
    setOptionValue(special_diet, data.nutrition_information.special_diet);
    disable_input(special_diet);

    let food_preference = progress.querySelector(
        "input[name='food_preference']"
    );
    food_preference.value = `${data.nutrition_information.food_preference}`;
    disable_input(food_preference);
}

function step_two(progress, data) {
    // appointment number
    progress.querySelector(
        "input[name='appointment_number']"
    ).value = `#${data.appointment_information.appointment_id}`;

    // appointment status
    progress.querySelector(
        "input[name='appointment_status']"
    ).value = `${data.appointment_information.appointment_status.toUpperCase()}`;

    // appointment date
    progress.querySelector(
        "input[name='appointment_date']"
    ).value = `${data.appointment_information.appointment_date}`;

    progress.querySelector(
        ".doctor-container .name"
    ).textContent = `Rnd LOADING`;

    if (data.appointment_information.appointment_step >= 3) {
        // disable button
        progress.querySelector(".disabled-btn").classList.add("hidden");

        // next button
        progress.querySelector(".next-btn").classList.remove("hidden");

        progress.querySelector(
            ".doctor-container .name"
        ).textContent = `Rnd ${data.dietitian_information.first_name} ${data.dietitian_information.last_name}`;

        // dietitian assgined
        progress.querySelector(
            "input[name='assigned_instructor']"
        ).value = `${data.dietitian_information.first_name} ${data.dietitian_information.last_name}`;
    } else {
        // submitAppointmentBtn.classList.add("hidden");
        progress.querySelector(".doctor-container img").src =
            "http://127.0.0.1:8000/images/blank_doctor.png";

        // remove floating
        progress
            .querySelector(".doctor-container .floating-info")
            .classList.add("hidden");
    }
}

function step_three(progress, data) {
    if (data.appointment_information.appointment_step >= 4) {
        // disable button
        progress.querySelector(".disabled-btn").classList.add("hidden");

        // next button
        progress.querySelector(".next-btn").classList.remove("hidden");

        // message input
        disable_input(progress.querySelector("input[name='message_content']"));
        sendMessageBtn.classList.add("hidden");

        // sms disable btn
        progress.querySelector(".sms-disable-btn").classList.remove("hidden");
    } else {
        progress.querySelector(".sms-disable-btn").classList.add("hidden");
    }

    progress.querySelector(
        ".doctor-container .name"
    ).textContent = `Rnd ${data.dietitian_information.first_name} ${data.dietitian_information.last_name}`;

    // appointment number
    progress.querySelector(
        "input[name='appointment_number']"
    ).value = `#${data.appointment_information.appointment_id}`;

    let chief_complaint = progress.querySelector(
        "input[name='chief_complain']"
    );
    chief_complaint.value = `${data.consultation_information.chief_complaint}`;
    disable_input(chief_complaint);

    //
    //
    //
    //
    let url = `http://127.0.0.1:8000/api/chat/${SUPER_DATA.appointment_information.appointment_id}`;

    let previous_data;

    // Start the interval and save its ID
    let intervalId = setInterval(function () {
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
                if (data.length != previous_data) {
                    console.log(data);

                    previous_data = data.length;
                    let messageWhole = "";

                    data.forEach((message) => {
                        let messagerUser =
                            message.sender_id === currentId
                                ? "patient"
                                : "diatetian";

                        let messageTemplate = `
        <div class="${
            messagerUser === "patient" ? "self-end" : "self-start"
        } w-11/12 p-2 bg-${
                            messagerUser === "patient" ? "blue" : "gray"
                        }-200 border rounded-md md:w-2/3">
            <p>${message.message_content}
            </p>
        </div>`;

                        messageWhole += messageTemplate;
                    });

                    progress.querySelector(".chat-box").innerHTML =
                        messageWhole;
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }, 3000);

    setTimeout(() => {
        clearInterval(intervalId);
        console.log("Interval cleared!");
    }, 300000);

    let apiUrl = `http://127.0.0.1:8000/api/schedule/${SUPER_DATA.appointment_information.appointment_id}`;

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        .then((data) => {
            let markUp = "";

            data.schedules.forEach((schedule) => {
                markUp += `<div class="flex flex-wrap items-center justify-around py-5 bg-green-100">
                                <p>${schedule.formatted_date}</p>
                                <p>${schedule.formatted_time}</p>
                            </div>`;
            });

            progress.querySelector(".schedule-container").innerHTML = markUp;
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function step_four(progress, data) {
    if (data.appointment_information.appointment_step >= 5) {
        // disable button
        progress.querySelector(".disabled-btn").classList.add("hidden");

        // next button
        progress.querySelector(".next-btn").classList.remove("hidden");
    }

    // appointment number
    progress.querySelector(
        "input[name='appointment_number']"
    ).value = `#${data.appointment_information.appointment_id}`;

    // appointment date
    progress.querySelector(
        "input[name='appointment_date_submitted']"
    ).value = `${data.appointment_information.appointment_date}`;

    // appointment date completed
    progress.querySelector(
        "input[name='appointment_date_completed']"
    ).value = `${data.appointment_information.appointment_date}`;

    // Chief complaint
    let chief_complaint = progress.querySelector(
        "input[name='chief_complain']"
    );
    chief_complaint.value = `${data.consultation_information.chief_complaint}`;
    disable_input(chief_complaint);
}

function step_five(progress, data) {
    // appointment number
    progress.querySelector(
        "input[name='appointment_number']"
    ).value = `#${data.appointment_information.appointment_id}`;
}

function change_step(currentStep, progress, data) {
    progress.forEach((progress) => {
        if (currentStep == progress.getAttribute("data-step")) {
            progress.classList.remove("hidden");

            if (currentStep == 1) {
                step_one(progress, data);
            }

            if (currentStep == 2) {
                step_two(progress, data);
            }

            if (currentStep == 3) {
                step_three(progress, data);
            }

            if (currentStep == 4) {
                step_four(progress, data);
            }

            if (currentStep == 5) {
                step_five(progress, data);
            }
        }

        if (currentStep != progress.getAttribute("data-step")) {
            progress.classList.add("hidden");
        }
    });
}

function disable_input(element) {
    element.classList.add("bg-gray-200");
    element.disabled = true;
}

function setOptionValue(element, target) {
    element.querySelectorAll("option").forEach((option) => {
        if (option.value === target) {
            option.selected = true;
        }
    });
}
