const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");

const links = document.querySelectorAll(
    ".sidebar-menu a, .sidebar-inferior a"
);

if (menuToggle && sidebar) {

    menuToggle.addEventListener("click", () => {
        const isOpen = sidebar.classList.toggle("aberto");

        menuToggle.classList.toggle("active", isOpen);

        menuToggle.setAttribute(
            "aria-expanded",
            String(isOpen)
        );

        menuToggle.setAttribute(
            "aria-label",
            isOpen ? "Fechar menu" : "Abrir menu"
        );

        menuToggle.innerHTML = isOpen
            ? '<i class="bi bi-x-lg" aria-hidden="true"></i>'
            : '<i class="bi bi-list" aria-hidden="true"></i>';
    });

    links.forEach(link => {
        link.addEventListener("click", () => {

            sidebar.classList.remove("aberto");
            menuToggle.classList.remove("active");

            menuToggle.setAttribute("aria-expanded", "false");
            menuToggle.setAttribute("aria-label", "Abrir menu");

            menuToggle.innerHTML =
                '<i class="bi bi-list" aria-hidden="true"></i>';
        });
    });
}