
<?php
session_start();

if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}

include '../configdb.php';

$emailProfissional = $_SESSION['profissional_email'];
$nomeProfissional = $_SESSION['profissional_nome'] ?? 'Profissional';

$partesNome = explode(' ', trim($nomeProfissional));
$iniciais = '';

foreach ($partesNome as $parte) {
    if ($parte !== '') {
        $iniciais .= strtoupper(substr($parte, 0, 1));
    }
}

$iniciais = substr($iniciais, 0, 2);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['nome'] != "" && $_POST['cpf'] != "" && $_POST['nascimento'] != "") {

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastrar Paciente | Kids Map</title>

    <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/principal/cadastrar_pacientes.css">
    <link rel="stylesheet" href="../assets/css/principal/nav.css">
</head>

<body>

    <!-- NAVBAR LATERAL -->

    <aside class="sidebar">

        <div class="sidebar-logo">
            <img src="../assets/imagens/logo.png" alt="Kids Map">
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <nav class="sidebar-menu">

            <a class="nav-link" href="principal.php">
                <i class="bi bi-house"></i>
                <span>Início</span>
            </a>

            <a class="nav-link ativo" href="pacientes.php">
                <i class="bi bi-people"></i>
                <span>Pacientes</span>
            </a>

            <a class="nav-link" href="#">
                <i class="bi bi-clipboard-check"></i>
                <span>Avaliações</span>
            </a>

        </nav>

        <div class="sidebar-inferior">
            <a class="nav-link" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>
        </div>

        <div class="sidebar-conta">

            <div class="conta-avatar">
                <?= $iniciais ?>
            </div>

            <div class="conta-info">
                <strong><?= htmlspecialchars($nomeProfissional) ?></strong>
                <span><?= htmlspecialchars($emailProfissional) ?></span>
            </div>

        </div>

    </aside>


    <!-- CONTEÚDO PRINCIPAL -->

    <main class="conteudo-cadastro">

        <a href="pacientes.php" class="voltar">
            <i class="bi bi-arrow-left"></i>
            Voltar para pacientes
        </a>

        <section class="cadastro-container">

            <div class="cadastro-card">

                <div class="login-logo">
                    <img src="../assets/imagens/logo.png" alt="Kids Map">
                </div>

                <div class="login-divisor"></div>

                <h1>Cadastrar paciente</h1>

                <p class="subtitulo">
                    Preencha as informações para adicionar uma nova criança.
                </p>


                <!-- FORMULÁRIO -->

                <form method="POST" action="" id="formCadastro" class="cadastro-form">

                    <div class="campo">

                        <label for="nome">
                            Nome completo *
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Digite o nome completo"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="cpf">
                            CPF *
                        </label>

                        <input
                            type="text"
                            id="cpf"
                            name="cpf"
                            placeholder="000.000.000-00"
                            maxlength="14"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="nascimento">
                            Data de nascimento *
                        </label>

                        <input
                            type="date"
                            id="nascimento"
                            name="nascimento"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="observacoes">
                            Observações
                        </label>

                        <textarea
                            id="observacoes"
                            name="observacoes"
                            placeholder="Adicione informações importantes sobre o paciente..."
                            rows="4"
                        ></textarea>

                    </div>


                    <button type="submit" class="botao-cadastrar">
                        <i class="bi bi-person-plus"></i>
                        Cadastrar paciente
                    </button>

                    <small>
                        Os campos marcados com * são obrigatórios.
                    </small>

                </form>

            </div>

        </section>

    </main>


    <script src="../assets/javascript/principal/cadastrar_pacientes.js"></script>

</body>
</html>
