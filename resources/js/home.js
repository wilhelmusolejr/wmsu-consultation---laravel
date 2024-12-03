const apiUrl = "http://127.0.0.1:8000/api";

const token = localStorage.getItem("api_token");

let modals = document.querySelectorAll(".modal");
let loginBtn = document.querySelector(".login-btn");
let registerBtn = document.querySelector(".register-btn");

let registerModal = document.querySelector(".modal-register");
let registerFormBtn = document.querySelector("#register-form-btn");

let loginModal = document.querySelector(".modal-login");
let loginFormBtn = document.querySelector("#login-form-btn");

let logoutBtn = document.querySelector("#logout-btn");

modals.forEach((modal) => {
    modal.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal")) {
            e.target.classList.toggle("hidden");
        }
    });
});

loginBtn?.addEventListener("click", function (e) {
    e.preventDefault();
    let modal = document.querySelector(".modal-login");
    modal.classList.toggle("hidden");
});

registerBtn?.addEventListener("click", function (e) {
    e.preventDefault();
    let modal = document.querySelector(".modal-register");
    modal.classList.toggle("hidden");
});

registerFormBtn?.addEventListener("click", function (e) {
    let data = {
        first_name: registerModal.querySelector("input[name='first_name']")
            .value,
        last_name: registerModal.querySelector("input[name='last_name']").value,
        type: "patient",
        email: registerModal.querySelector("input[name='email']").value,
        password: registerModal.querySelector("input[name='password']").value,
    };

    fetch(`${apiUrl}/register`, {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            localStorage.setItem("api_token", data.token);
            window.location.reload();
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

loginFormBtn?.addEventListener("click", function (e) {
    e.preventDefault();

    let data = {
        email: loginModal.querySelector("input[name='email']").value,
        password: loginModal.querySelector("input[name='password']").value,
    };

    fetch(`${apiUrl}/login`, {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            localStorage.setItem("api_token", data.token);
            window.location.reload();
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

logoutBtn?.addEventListener("click", function (e) {
    e.preventDefault();

    fetch(`${apiUrl}/logout`, {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            localStorage.removeItem("api_token");
            window.location = `http://127.0.0.1:8000/`;
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

registerModal?.addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("go-to-login")) {
        registerModal.classList.toggle("hidden");
        loginModal.classList.toggle("hidden");
    }
});

loginModal?.addEventListener("click", function (e) {
    e.preventDefault();

    if (e.target.classList.contains("go-to-register")) {
        registerModal.classList.toggle("hidden");
        loginModal.classList.toggle("hidden");
    }
});

let userParent = document.querySelector(".authenticated-parent");
let guestParent = document.querySelector(".guest-parent");

if (token) {
    fetch(`${apiUrl}/userinfo`, {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        // Parse JSON response
        .then((response) => response.json())
        // successs
        .then((data) => {
            guestParent.classList.add("hidden");
            userParent.classList.remove("hidden");
            userParent.querySelector(
                ".user-name"
            ).textContent = `${data.first_name} ${data.last_name}`;

            console.log();
            console.log(data);

            if (data.profile === null) {
                userParent.querySelector(
                    "img"
                ).src = `http://127.0.0.1:8000/images/blank_profile.png`;
            } else {
                userParent.querySelector(
                    "img"
                ).src = `http://127.0.0.1:8000/images/${data.profile}`;
            }

            if (data.type === "patient") {
                userParent
                    .querySelector('a[href="/my-pending-consultation"]')
                    .classList.add("hidden");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
} else {
    guestParent.classList.remove("hidden");
}

// Select the header element to observe
const header = document.querySelector("header");
const navigator = document.querySelector(".navigator");
const heightWithPadding = navigator.clientHeight;

// Define a callback function to handle visibility changes
const handleIntersect = (entries) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) {
            navigator.classList.remove("sticky");
            navigator.classList.add("fixed");
            navigator.classList.add("bg-white");
            navigator.classList.add("shadow-md");
        } else {
            navigator.classList.add("sticky");
            navigator.classList.remove("bg-white");
            navigator.classList.remove("shadow-md");
        }
    });
};

// Create an Intersection Observer instance with the callback
const observer = new IntersectionObserver(handleIntersect, {
    root: null, // Observes relative to the viewport
    threshold: 0, // Trigger as soon as any part is out of view
    rootMargin: `-${heightWithPadding}px`, // Offset by navigator's height
});

// Start observing the header element
observer.observe(header);

//
let accountInfo = document.querySelector(".account-info");
let accountInfoOptions = document.querySelector(".account-info-option");

accountInfo?.addEventListener("click", function () {
    accountInfoOptions.classList.toggle("hidden");
});
