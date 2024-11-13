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

    // form.submit();
    // use ajax instead

    finalAppointmentBtn.textContent = "Submitting...";

    // successs
    submitAppointmentModal
        .querySelector(".modal-container")
        .classList.add("bg-green-100");
    submitAppointmentModal.querySelector(".modal-header h2").textContent =
        "Success";
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
            window.location.href = "http://127.0.0.1:8000/consultation/5";
        }
    }, 1000);
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
