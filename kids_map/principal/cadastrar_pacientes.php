<?php
session_start();
if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}

include '../configdb.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" &&  $_POST['nome'] != "" &&  $_POST['cpf'] != "" &&  $_POST['nascimento'] != "") {
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];
    $observacoes = $_POST['observacoes'];

    try {
        $consulta = $mysqli->prepare("INSERT INTO paciente (nome, cpf, nascimento, observacoes) VALUES (?,?,?,?)");
        $consulta->bind_param("ssss", $nome, $cpf, $nascimento, $observacoes);
        $consulta->execute();
        
        $consulta->close();
        header("Location: pacientes.php");
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
    <title>cadastrar paciente</title>
</head>
<body>

    <form method="post" action="">
        <label for="nome">nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="cpf">cpf:</label>
        <input type="text" name="cpf" id="cpf" required>

        <label for="nascimento">nascimento:</label>
        <input type="date" name="nascimento" id="nascimento" required>

        <label for="observacoes">observaçoes</label>
        <input type="text" name="observacoes" id="observacoes" required>

        <button type="submit">Enviar</button>
    </form>

</body>
</html>