<?php
session_start();
include '../configdb.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = $mysqli->prepare("SELECT  nome, senha FROM profissional WHERE email = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $usuario = $resultado->fetch_assoc();
    $consulta->close();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['profissional_email'] = $email;
        $_SESSION['profissional_nome'] = $usuario['nome'];

        header("Location: ../principal/principal.html");
        exit;
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Kids Map</title>
  <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
  <link rel="stylesheet" href="../assets/css/entrada/estilo.css">
</head>

<body>

    <form id="formLogin" action="login.php" method="post" novalidate>

        <div class="login-logo">
            <img src="../assets/imagens/logo.png" alt="Logo Kids Map">
        </div>

        <div class="login-divisor"></div>

        <h1>Login</h1>

        <div id="mensagemFinal"></div>

        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="exemplo@email.com" autocomplete="email">
            <span class="mensagem" id="erro-email"></span>
        </div>

        <div class="campo">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" autocomplete="current-password">
            <span class="mensagem" id="erro-senha"></span>
        </div>

        <input type="submit" value="Entrar">

        <?php if ($erro != "") { echo "<p>$erro</p>"; } ?>

        <div class="login-separador">♡</div>

        <small>
            Seus dados estão protegidos de acordo com a LGPD.
        </small>

        <small>
            Não tem conta?
            <a href="cadastro.php">Cadastre-se</a>
        </small>

        <small>
            <a href="#">Esqueceu sua senha?</a>
        </small>

    </form>

   <script src="../assets/javascript/2-login.js" defer></script>

</body>
</html>