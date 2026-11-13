<?php
session_start();
if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}
include '../configdb.php';

$consulta = $mysqli->prepare("SELECT DISTINCT p.cpf, p.nome, p.nascimento, p.observacoes FROM paciente p JOIN acompanhamento a ON a.paciente_cpf = p.cpf WHERE a.profissional_email = ? ORDER BY p.nome");
$consulta->bind_param("s", $_SESSION['profissional_email']);
$consulta->execute();
$resultado = $consulta->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>pacientes</title>
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
                <a href="pacientes.php">pacientes</a>
            </div>
            <div class="botao-nav">
                <a href="cadastrar_pacientes.php">cadastrar pacientes</a>
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

            <a href="cadastrar_pacientes.php">Novo paciente</a>

            <div>
                <?php if ($resultado->num_rows === 0){ ?>
                    <p>Nenhum paciente cadastrado.</p>
                <?php } ?>

                <?php while ($p = $resultado->fetch_assoc()) { ?>
                    <div>
                        <h2><?php echo ($p['nome']); ?></h2>
                        <p>CPF: <?php echo ($p['cpf']); ?></p>
                        <p>Nascimento: <?php echo ($p['nascimento']); ?></p>
                        <p>Observações: <?php echo ($p['observacoes'] ?? ''); ?></p>
                    </div>
                <?php } ?>
            </div>
    </body>
</html>