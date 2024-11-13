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

loginBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let modal = document.querySelector(".modal-login");
    modal.classList.toggle("hidden");
});

registerBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let modal = document.querySelector(".modal-register");
    modal.classList.toggle("hidden");
});

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
