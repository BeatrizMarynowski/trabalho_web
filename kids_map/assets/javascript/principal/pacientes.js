const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");
const links = document.querySelectorAll(".sidebar-menu a, .sidebar-inferior a");

menuToggle.addEventListener("click", () => {
    const isOpen = sidebar.classList.toggle("aberto");

    menuToggle.classList.toggle("active", isOpen);
    menuToggle.setAttribute("aria-expanded", isOpen);

    menuToggle.innerHTML = isOpen
        ? '<i class="bi bi-x-lg"></i>'
        : '<i class="bi bi-list"></i>';
});

links.forEach(link => {
    link.addEventListener("click", () => {
        sidebar.classList.remove("aberto");
        menuToggle.classList.remove("active");

        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.innerHTML = '<i class="bi bi-list"></i>';
    });
});