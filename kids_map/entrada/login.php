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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <form method="post" action="">
        <label for="email">Seu email:</label>
        <input type="text" name="email" id="email" required>

        <label for="senha">Sua senha:</label>
        <input type="password" name="senha" id="senha" required>

        <button type="submit">Entrar</button>
    </form>

    <?php if ($erro != "") { echo "<p>$erro</p>"; } ?>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>

</body>
</html>