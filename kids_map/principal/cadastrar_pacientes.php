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
        <title>(nome do projeto)</title>
        <link rel="icon" type="image/x-icon" href="assets/logo.png" />
        <link href="../assets/css/principal/estilo.css" rel="stylesheet" />
    </head>

    <body>
        <nav>
            <div class="logo">
                <div class="icone">

                </div>
                <div>
                    <p>oi</p>
                </div>
            </div>
            <div class="botao-nav">
                <a href="principal.html">Inicio</a>
            </div>
            <div class="botao-nav">
                <a href="pacientes.html">pacientes</a>
            </div>
            <div class="botao-nav">
                <p>ajuda</p>
            </div>
            <div class="logo">
                <div class="conta"> 
                </div>
                <div>
                    <p>oi</p>
                </div>
            </div>
        </nav>
    </body>
</html>