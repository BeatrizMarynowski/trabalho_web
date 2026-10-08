    const form = document.getElementById("formCadastro");
    const mensagemFinal = document.getElementById("mensagemFinal");

    const campos = {
      nome: document.getElementById("nome"),
      email: document.getElementById("email"),
      senha: document.getElementById("senha"),
      telefone: document.getElementById("telefone"),
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

    function limparFeedback(campo) {
      const input = campos[campo];
      const erro = document.getElementById(`erro-${campo}`);

      input.classList.remove("erro", "correto");
      erro.textContent = "";
      erro.classList.remove("visivel");
    }
    function validarNome() {
      const nome = campos.nome.value.trim();

      if (nome.length < 3) {
        mostrarErro("nome", "Digite um nome com pelo menos 3 caracteres.");
        return false;
      }

      if (!nome.includes(" ")) {
        mostrarErro("nome", "Digite nome e sobrenome.");
        return false;
      }

      mostrarSucesso("nome");
      return true;
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
      const senha = campos.senha.value;

      if (senha.length < 6) {
        mostrarErro("senha", "A senha precisa ter pelo menos 6 caracteres.");
        return false;
      }

      mostrarSucesso("senha");
      return true;
    }

    function validarTelefone() {
      const telefone = campos.telefone.value.trim();
      const regexTelefone = /^\(\d{2}\)\s?\d{4,5}-\d{4}$/;

      if (!regexTelefone.test(telefone)) {
        mostrarErro("telefone", "Use o formato (99) 99999-9999.");
        return false;
      }

      mostrarSucesso("telefone");
      return true;
    }

    function validarCrefito() {
      const crefito = campos.crefito.value.trim();
      const regexCrefito = /^\d{6}$/;

      if (!regexCrefito.test(crefito)) {
        mostrarErro("crefito", "O CREFITO deve conter exatamente 6 números.");
        return false;
      }

      mostrarSucesso("crefito");
      return true;
    }
    
    campos.nome.addEventListener("blur", validarNome);
    campos.email.addEventListener("blur", validarEmail);
    campos.senha.addEventListener("blur", validarSenha);
    campos.telefone.addEventListener("blur", validarTelefone);
    campos.crefito.addEventListener("blur", validarCrefito);

    campos.telefone.addEventListener("input", () => {
      let valor = campos.telefone.value.replace(/\D/g, "");

      if (valor.length > 11) valor = valor.slice(0, 11);

      if (valor.length > 6) {
        campos.telefone.value = `(${valor.slice(0, 2)}) ${valor.slice(2, -4)}-${valor.slice(-4)}`;
      } else if (valor.length > 2) {
        campos.telefone.value = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
      } else {
        campos.telefone.value = valor;
      }
    });

    campos.crefito.addEventListener("input", () => {
      campos.crefito.value = campos.crefito.value.replace(/\D/g, "");
    });

    form.addEventListener("submit", function(event) {
      event.preventDefault();

      const isNomeValido = validarNome();
      const isEmailValido = validarEmail();
      const isSenhaValida = validarSenha();
      const isTelefoneValido = validarTelefone();
      const isCrefitoValido = validarCrefito();

      const formularioValido =
        isNomeValido &&
        isEmailValido &&
        isSenhaValida &&
        isTelefoneValido &&
        isCrefitoValido;

      if (formularioValido) {
        mensagemFinal.className = "sucesso";
        mensagemFinal.textContent = "Cadastro validado com sucesso!";
        form.reset();

        Object.keys(campos).forEach(limparFeedback);
      } else {
        mensagemFinal.className = "erro-final";
        mensagemFinal.textContent = "Confira os campos destacados antes de enviar.";
      }
    });