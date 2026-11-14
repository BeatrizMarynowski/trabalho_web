const form = document.getElementById("formCadastro");
const mensagemFinal = document.getElementById("mensagemFinal");

const campos = {
    email: document.getElementById("email"),
    senha: document.getElementById("senha"),
    nome: document.getElementById("nome"),
    crefito: document.getElementById("crefito")
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

function validarNome() {
  if (campos.nome.value.length === 0) {
    mostrarErro("nome", "Digite seu nome completo.");
    return false;
  }

  mostrarSucesso("nome");
  return true;
}


function validarCrefito() {
    if (!/^\d{6}$/.test(campos.crefito.value.trim())) {
        mostrarErro("crefito", "Digite os 6 números do CREFITO.");
        return false;
    }

    mostrarSucesso("crefito");
    return true;
}

campos.email.addEventListener("blur", validarEmail);
campos.senha.addEventListener("blur", validarSenha);
campos.nome.addEventListener("blur", validarNome);
campos.crefito.addEventListener("blur", validarCrefito);


form.addEventListener("submit", function(event) {

    const emailValido = validarEmail();
    const nomeValido = validarNome();
    const senhaValida = validarSenha();
    const crefitoValido = validarCrefito();

    if (!emailValido || !nomeValido || !senhaValida || !crefitoValido) {
        event.preventDefault();

        mensagemFinal.className = "erro-final";
        mensagemFinal.textContent = "Confira os campos destacados antes de continuar.";
    }
  // se estiver tudo válido, o formulário segue para o login.php
});