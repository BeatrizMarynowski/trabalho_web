
function confirmarExclusao() {
    const confirmar = confirm(
        "Tem certeza de que deseja excluir este relatório? Esta ação não poderá ser desfeita."
    );

 
}
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