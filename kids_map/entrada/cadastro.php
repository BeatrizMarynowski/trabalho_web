<?php
include '../configdb.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && $_POST['nome'] != "") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $crefito = $_POST['crefito'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $consulta = $mysqli->prepare("INSERT INTO profissional (nome, email, crefito, senha) VALUES (?,?,?,?)");
        $consulta->bind_param("ssss", $nome, $email, $crefito, $senha);
        $consulta->execute();
        
        $consulta->close();
        header("Location: login.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Ops! Ocorreu um erro ao cadastrar. Tente novamente mais tarde.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>

    <form method="post" action="">
        <label for="nome">Seu nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Seu email:</label>
        <input type="text" name="email" id="email" required>

        <label for="crefito">Seu crefito:</label>
        <input type="text" name="crefito" id="crefito" required>

        <label for="senha">Sua senha:</label>
        <input type="password" name="senha" id="senha" required>

        <button type="submit">Enviar</button>
    </form>

</body>
</html>