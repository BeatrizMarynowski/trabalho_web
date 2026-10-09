const menuToggle = document.querySelector(".menu-botao");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-link");

menuToggle.addEventListener("click", () => {
    const isOpen = navLinks.classList.toggle("open");

    menuToggle.classList.toggle("active");
    menuToggle.setAttribute("aria-expanded", isOpen);
});

links.forEach(link => {
    link.addEventListener("click", () => {
        navLinks.classList.remove("open");
        menuToggle.classList.remove("active");
        menuToggle.setAttribute("aria-expanded", "false");
    });
});