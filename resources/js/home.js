let modals = document.querySelectorAll(".modal");
let loginBtn = document.querySelector(".login-btn");
let registerBtn = document.querySelector(".register-btn");

modals.forEach((modal) => {
    modal.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal")) {
            e.target.classList.toggle("hidden");
        }
    });
});

loginBtn.addEventListener("click", function () {
    let modal = document.querySelector(".modal-login");
    modal.classList.toggle("hidden");
});

registerBtn.addEventListener("click", function () {
    let modal = document.querySelector(".modal-register");
    modal.classList.toggle("hidden");
});
