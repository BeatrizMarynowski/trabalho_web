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



$consulta = $mysqli->prepare("SELECT COUNT(DISTINCT paciente_cpf) AS total FROM acompanhamento WHERE profissional_email = ?");
$consulta->bind_param("s", $emailprofissional);
$consulta->execute();
$totalPacientes = $consulta->get_result()->fetch_assoc()['total'];
$consulta->close();

$testes = $mysqli->prepare("SELECT COUNT(DISTINCT avaliaçao_id) AS total FROM exame WHERE profissional_email = ?");
$testes->bind_param("s", $emailprofissional);
$testes->execute();
$totalTestes = $testes->get_result()->fetch_assoc()['total'];
$testes->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início | Kids Map</title>
        <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../assets/css/principal/nav.css">
        <link rel="stylesheet" href="../assets/css/principal/principal.css">
    </head>
    <body>
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="../assets/imagens/logo.png" alt="Kids Map">
            </div>
            <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>
            <nav class="sidebar-menu">
                <a class="nav-link ativo" href="principal.php"><i class="bi bi-house"></i><span>Início</span></a>
                <a class="nav-link" href="pacientes.php"><i class="bi bi-people"></i><span>Pacientes</span></a>
                <a class="nav-link" href="teste.php"><i class="bi bi-clipboard-check"></i><span>Avaliações</span></a>
            </nav>
            <div class="sidebar-inferior">
                <a href="./logout.php" class="nav-link sair"><i class="bi bi-box-arrow-right"></i><span>Sair</span></a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle"></i><span>Ajuda</span></a>
            </div>
            <div class="sidebar-conta">
                <div class="conta-avatar">
                    <?php echo $iniciais; ?>
                </div>
                <div class="conta-info">
                    <strong><?php echo $nomeprofissional; ?></strong>
                    <span><?php echo $emailprofissional; ?></span>
                </div>
            </div>
        </aside>
        <main class="conteudo-inicio">
            <header class="inicio-topo">
                <div>
                    <span class="saudacao">SEJA BEM-VINDO(A)!</span>
                    <h1>Olá, <?php echo htmlspecialchars(explode(' ', trim($nomeprofissional))[0]); ?>!</h1>
                    <p>Que bom ter você por aqui. Vamos acompanhar o desenvolvimento das crianças?</p>
                </div>
            </header>

            <!-- RESUMO -->
            <section class="resumo">
                <div class="card-resumo">
                    <div class="resumo-icone rosa">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <span>Pacientes cadastrados</span>
                        <h2><?php echo $totalPacientes; ?></h2>
                    </div>
                </div>
                <div class="card-resumo">
                    <div class="resumo-icone roxo">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div>
                        <span>Avaliações realizadas</span>
                         <h2><?php echo $totalTestes; ?></h2>
                    </div>
                </div>
            </section>
            <section class="secao-atalhos">
                <div class="titulo-secao">
                    <h2>Acesso rápido</h2>
                    <p>Encontre facilmente o que você precisa.</p>
                </div>
                <div class="atalhos-grid">
                    <a href="cadastrar_pacientes.php" class="card-atalho">
                        <div class="atalho-icone rosa">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h3>Adicionar paciente</h3>
                        <p>Cadastre uma nova criança.</p>
                        <span class="atalho-seta">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </a>
                    <a href="pacientes.php" class="card-atalho">
                        <div class="atalho-icone roxo">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3>Meus pacientes</h3>
                        <p>Consulte os pacientes vinculados.</p>
                        <span class="atalho-seta">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </a>
                    <a href="#" class="card-atalho">
                        <div class="atalho-icone azul">
                            <i class="bi bi-clipboard-check-fill"></i>
                        </div>
                        <h3>Avaliações</h3>
                        <p>Acesse as avaliações realizadas.</p>
                        <span class="atalho-seta">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </a>
                </div>
            </section>
     
        </main>
         <script src="../assets/javascript/principal/pacientes.js"></script>
    </body>
</html>