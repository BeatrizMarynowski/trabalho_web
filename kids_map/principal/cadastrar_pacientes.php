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
       <title>Cadastrar Pacientes | Kids Map</title>
 <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">

    <link rel="stylesheet" href="../assets/css/principal/cadastrar_pacientes.css">
    </head>

    <body>
        <!-- NAVBAR LATERAL -->

    <nav class="sidebar">

        <div class="sidebar-logo">
            <img src="../assets/imagens/logo.png" alt="Kids Map">
        </div>
        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <nav class="sidebar-menu">

           <a class="nav-link" href="principal.html"><i class="bi bi-house"></i><span>Início</span></a>
            <a class="nav-link ativo" href="pacientes.php"><i class="bi bi-people"></i><span>Pacientes</span></a>
            <a class="nav-link" href="#"><i class="bi bi-clipboard-check"></i><span>Avaliações</span></a>

        </nav>

        <div class="sidebar-inferior">

            <a class="nav-link" href="#"><i class="bi bi-question-circle"></i><span>Ajuda</span></a>

        </div>

        <div class="sidebar-conta">

            <div class="conta-avatar">
                <?php echo htmlspecialchars($iniciais); ?>
            </div>

            <div class="conta-info">
                <strong>
                    <?php echo htmlspecialchars($nomeProfissional); ?>
                </strong>

                <span>
                    <?php echo htmlspecialchars($emailProfissional); ?>
                </span>
            </div>

        </div>

</nav>
<script src="../assets/javascript/5-cadastrar-pacientes.js"></script>
    </body>
</html>