const form = document.getElementById("formLogin");
const mensagemFinal = document.getElementById("mensagemFinal");

const campos = {
  email: document.getElementById("email"),
  senha: document.getElementById("senha")
};

function mostrarErro(campo, mensagem) {
  const input = campos[campo];
  const erro = document.getElementById(`erro-${campo}`);

  input.classList.add("erro");
  input.classList.remove("correto");
  erro.textContent = mensagem;
  erro.classList.add("visivel");
}

function mostrarSucesso(campo) {
  const input = campos[campo];
  const erro = document.getElementById(`erro-${campo}`);

  input.classList.remove("erro");
  input.classList.add("correto");
  erro.textContent = "";
  erro.classList.remove("visivel");
}

function validarEmail() {
  const email = campos.email.value.trim();
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!regexEmail.test(email)) {
    mostrarErro("email", "Digite um e-mail válido.");
    return false;
  }

  mostrarSucesso("email");
  return true;
}

function validarSenha() {
  if (campos.senha.value.length === 0) {
    mostrarErro("senha", "Digite sua senha.");
    return false;
  }

  mostrarSucesso("senha");
  return true;
}

campos.email.addEventListener("blur", validarEmail);
campos.senha.addEventListener("blur", validarSenha);

form.addEventListener("submit", function (event) {
  const emailValido = validarEmail();
  const senhaValida = validarSenha();

  if (!(emailValido && senhaValida)) {
    event.preventDefault();
    mensagemFinal.className = "erro-final";
    mensagemFinal.textContent = "Confira os campos destacados antes de entrar.";
  }
  // se estiver tudo válido, o formulário segue para o login.php
});