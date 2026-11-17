
<?php
session_start();

if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}

include '../configdb.php';

$emailProfissional = $_SESSION['profissional_email'];
$nomeProfissional = $_SESSION['profissional_nome'] ?? 'Profissional';

// Quantidade de pacientes
$consulta = $mysqli->prepare("
    SELECT COUNT(DISTINCT paciente_cpf) AS total
    FROM acompanhamento
    WHERE profissional_email = ?
");

$consulta->bind_param("s", $emailProfissional);
$consulta->execute();

$totalPacientes = $consulta->get_result()->fetch_assoc()['total'];

// Iniciais do profissional
$partesNome = explode(' ', trim($nomeProfissional));
$iniciais = '';

foreach ($partesNome as $parte) {
    if ($parte !== '') {
        $iniciais .= strtoupper(substr($parte, 0, 1));
    }
}

$iniciais = substr($iniciais, 0, 2);
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

    <!-- NAVBAR -->

    <aside class="sidebar">

        <div class="sidebar-logo">
            <img src="../assets/imagens/logo.png" alt="Kids Map">
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <nav class="sidebar-menu">
            <a class="nav-link ativo" href="principal.php">
                <i class="bi bi-house"></i>
                <span>Início</span>
            </a>

            <a class="nav-link" href="pacientes.php">
                <i class="bi bi-people"></i>
                <span>Pacientes</span>
            </a>

            <a class="nav-link" href="#">
                <i class="bi bi-clipboard-check"></i>
                <span>Avaliações</span>
            </a>
        </nav>

        <div class="sidebar-inferior">

            <a href="index.php" class="nav-link sair">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
            </a>

            <a class="nav-link" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>

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

    </aside>

    <!-- CONTEÚDO -->

    <main class="conteudo-inicio">

        <header class="inicio-topo">

            <div>
                <span class="saudacao">SEJA BEM-VINDO(A)!</span>

                <h1>
                    Olá, <?php echo htmlspecialchars(explode(' ', trim($nomeProfissional))[0]); ?>!
                </h1>

                <p>
                    Que bom ter você por aqui. Vamos acompanhar o desenvolvimento das crianças?
                </p>
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
                    <h2>--</h2>
                </div>
            </div>

        </section>

        <!-- ATALHOS -->

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

        <!-- DESTAQUE -->

        <section class="destaque">

            <div class="destaque-icone">
                <i class="bi bi-heart-fill"></i>
            </div>

            <div>
                <h2>Cada pequena conquista importa!</h2>

                <p>
                    Acompanhe cada etapa do desenvolvimento e registre
                    a evolução de cada criança.
                </p>
            </div>

            <i class="bi bi-stars destaque-estrelas"></i>

        </section>

    </main>

    <script src="../assets/javascript/principal/nav.js"></script>

</body>
</html>
