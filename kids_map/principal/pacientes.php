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

// Buscar pacientes
$consulta = $mysqli->prepare("
    SELECT DISTINCT
        p.cpf,
        p.nome,
        p.nascimento,
        p.observacoes
    FROM paciente p
    JOIN acompanhamento a ON a.paciente_cpf = p.cpf
    WHERE a.profissional_email = ?
    ORDER BY p.nome
");

$consulta->bind_param("s", $emailProfissional);
$consulta->execute();

$resultado = $consulta->get_result();

// Quantidade de pacientes
$totalPacientes = $resultado->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
          <title>Pacientes | Kids Map</title>
 <link rel="icon" type="image/x-icon" href="/../assets/imagens/icone.png">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/principal/pacientes.css">
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

           <a class="nav-link" href="principal.html"><i class="bi bi-house"></i><span>Início</span></a>
            <a class="nav-link ativo" href="pacientes.php"><i class="bi bi-people"></i><span>Pacientes</span></a>
            <a class="nav-link" href="#"><i class="bi bi-clipboard-check"></i><span>Avaliações</span></a>

        </nav>

        <div class="sidebar-inferior">

            <a class="nav-link" href="#"><i class="bi bi-question-circle"></i><span>Ajuda</span></a>
            <a class="nav-link" href="#"><i class="bi bi-envelope"></i><span>Fale conosco</span></a>

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

            <span class="conta-seta">⌄</span>

        </div>

    </aside>


    <!-- CONTEÚDO PRINCIPAL -->

    <main class="conteudo">

        <header class="pagina-topo">

            <div>
             

                <h1>Pacientes</h1>

                <p>
                    <?php if ($totalPacientes > 0) { ?>
                        Gerencie os pacientes vinculados à sua conta.
                    <?php } else { ?>
                        Nenhum paciente ainda — Vamos adicionar o primeiro?
                    <?php } ?>
                </p>
            </div>

            <a href="cadastrar_pacientes.php" class="botao-adicionar">
                <span>+</span>
                Adicionar paciente
            </a>

        </header>


        <!-- BUSCA -->

        <div class="busca-pacientes">

            <span class="busca-icone">⌕</span>

            <input
                type="text"
                id="buscaPaciente"
                placeholder="Busque pelo nome da criança..."
            >

        </div>


        <!-- LISTA DE PACIENTES -->

        <section class="area-pacientes">

            <div class="tabela-cabecalho">
                <span>Paciente</span>
                <span>CPF</span>
                <span>Nascimento</span>
                <span>Observações</span>
            </div>

            <?php if ($totalPacientes === 0) { ?>

                <div class="estado-vazio">

                    <div class="vazio-ilustracao">
                        <span>＋</span>
                        <a class="vazio-pata" href="#"><i class="bi bi-journal-medical"></i></a>
                    </div>

                    <h2>Nenhum paciente por aqui ainda</h2>

                    <p>
                        Adicione seu primeiro paciente para iniciar
                        uma avaliação EDM.
                    </p>

                    <a href="cadastrar_pacientes.php" class="botao-adicionar">
                        Adicionar paciente
                    </a>

                </div>

            <?php } else { ?>

                <div class="lista-pacientes" id="listaPacientes">

                    <?php while ($p = $resultado->fetch_assoc()) { ?>

                        <div
                            class="paciente-linha"
                            data-nome="<?php echo htmlspecialchars($p['nome']); ?>"
                        >

                            <div class="paciente-nome">
                                <div class="paciente-avatar">
                                    <?php echo strtoupper(substr($p['nome'], 0, 1)); ?>
                                </div>

                                <strong>
                                    <?php echo htmlspecialchars($p['nome']); ?>
                                </strong>
                            </div>

                            <span>
                                <?php echo htmlspecialchars($p['cpf']); ?>
                            </span>

                            <span>
                                <?php echo htmlspecialchars($p['nascimento']); ?>
                            </span>

                            <span class="paciente-observacao">
                                <?php
                                echo htmlspecialchars(
                                    $p['observacoes'] ?? 'Sem observações'
                                );
                                ?>
                            </span>

                        </div>

                    <?php } ?>

                </div>

                <p class="nenhum-resultado" id="nenhumResultado">
                    Nenhum paciente encontrado.
                </p>

            <?php } ?>

        </section>

    </main>


    <!-- BUSCA EM JAVASCRIPT -->

    <script>
        const busca = document.getElementById("buscaPaciente");
        const pacientes = document.querySelectorAll(".paciente-linha");
        const mensagem = document.getElementById("nenhumResultado");

        if (busca) {
            busca.addEventListener("input", function () {

                const pesquisa = this.value.toLowerCase();
                let encontrados = 0;

                pacientes.forEach(function (paciente) {

                    const nome = paciente.dataset.nome.toLowerCase();

                    if (nome.includes(pesquisa)) {
                        paciente.style.display = "grid";
                        encontrados++;
                    } else {
                        paciente.style.display = "none";
                    }

                });

                if (mensagem) {
                    mensagem.style.display =
                        encontrados === 0 ? "block" : "none";
                }

            });
        }
     </script>

<script src="../assets/javascript/4-pacientes.js"></script>

</body>
</html>

<?php
$consulta->close();
?>