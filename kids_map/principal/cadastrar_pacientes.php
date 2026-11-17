<?php
session_start();
if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}
include '../configdb.php';
//nav
$emailprofissional = $_SESSION['profissional_email'];
$nomeprofissional = $_SESSION['profissional_nome'] ?? 'Profissional';
$partesNome = explode(' ', trim($nomeprofissional));
$iniciais = '';
foreach ($partesNome as $parte) {
    if ($parte !== '') {
        $iniciais .= strtoupper(substr($parte, 0, 1));
    }
}
$iniciais = substr($iniciais, 0, 2);



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

        $acompanhamento = $mysqli->prepare("INSERT INTO acompanhamento (paciente_cpf, profissional_email, data) VALUES (?, ?, CURDATE())");
        $acompanhamento->bind_param("ss", $cpf, $_SESSION['profissional_email']);
        $acompanhamento->execute();
        $acompanhamento->close();

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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Cadastrar Pacientes | Kids Map</title>
        <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
        <link rel="stylesheet" href="../assets/css/principal/cadastrar_pacientes.css">
    </head>
    <body>
        <!-- NAVBAR LATERAL -->

        <form method="post" action="">
        <label for="nome">nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="cpf">cpf:</label>
        <input type="text" name="cpf" id="cpf" required>

        <label for="nascimento">nacsimento:</label>
        <input type="date" name="nascimento" id="nascimento" required>

        <label for="observacoes">observacoes:</label>
        <input type="text" name="observacoes" id="observacoes" required>

        <button type="submit">Enviar</button>
        </form>

        <script src="../assets/javascript/principal/cadastrar_pacientes.js"></script>
    </body>
</html>