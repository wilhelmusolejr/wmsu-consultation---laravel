let countdown = 5;

let submitAppointmentBtn = document.querySelector(".appointment-btn");
let submitAppointmentModal = document.querySelector(
    ".modal-submit-consultation"
);
let modalCancelBtn = document.querySelectorAll(".modal-close");

submitAppointmentBtn.addEventListener("click", function (e) {
    e.preventDefault();

    submitAppointmentModal.classList.remove("hidden");
});

submitAppointmentModal.addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("modal-close")) {
        submitAppointmentModal.classList.add("hidden");
    }
});

let finalAppointmentBtn = document.getElementById("submitButton");

finalAppointmentBtn.addEventListener("click", function (event) {
    event.preventDefault();

    finalAppointmentBtn.textContent = "Submitting...";

    // successs
    submitAppointmentModal
        .querySelector(".modal-container")
        .classList.add("bg-green-100");
    finalAppointmentBtn.textContent = `Redirecting in ${countdown}...`;
    submitAppointmentModal.querySelector(".modal-header h2").textContent =
        "Success";
    submitAppointmentModal.querySelector(
        ".modal-body .modal-info"
    ).textContent = "Your appointment has been submitted successfully";

    // Create an interval to update the button text every second
    let interval = setInterval(() => {
        finalAppointmentBtn.textContent = `Redirecting in ${countdown}...`;
        countdown--;

        if (countdown < 0) {
            clearInterval(interval);
            window.location.href =
                "http://127.0.0.1:8000/consultation?consultation_id=5";
        }
    }, 1000); // Update every 1 second (1000 milliseconds)
});
