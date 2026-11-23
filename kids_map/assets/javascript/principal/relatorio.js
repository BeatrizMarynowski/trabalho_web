function confirmarExclusao() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const cpf = urlParams.get('cpf');

    if (confirm("Tem certeza de que deseja excluir esta avaliação?")) {
        window.location.href = `relatorio.php?id=${id}&cpf=${cpf}&acao=excluir`;
    }
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