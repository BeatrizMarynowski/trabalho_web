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



$pacientes = $mysqli->prepare("SELECT DISTINCT p.cpf, p.nome FROM paciente p JOIN acompanhamento a ON a.paciente_cpf = p.cpf WHERE a.profissional_email = ? ORDER BY p.nome");
$pacientes->bind_param("s", $emailprofissional);
$pacientes->execute();
$pacientes_resultado = $pacientes->get_result();
$pacientes->close();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = $_POST['cpf'];
    $classificacao = 0;
    try {
        $avaliacao = $mysqli->prepare("INSERT INTO avaliaçao (classificacao) VALUES (?)");
        $avaliacao->bind_param("i", $classificacao);
        $avaliacao->execute();
        $avaliacaoid = $mysqli->insert_id;
        $avaliacao->close();

        $consulta = $mysqli->prepare("INSERT INTO exame (profissional_email, paciente_cpf, atividade_id, data, resultado, avaliaçao_id)VALUES (?, ?, ?, CURDATE(), ?, ?)");
        foreach ($_POST['resultado'] as $atividadeId => $resultado) {
            if ($resultado === "0.5") {
                $resultadobanco = 5;
            } else {
                $resultadobanco = $resultado;
            }
            $consulta->bind_param("ssiii", $emailprofissional, $cpf, $atividadeId, $resultadobanco, $avaliacaoid);
            $consulta->execute();
        }
        $consulta->close();

        header("Location: teste.php");
        exit;
    } catch (Exception $e) {
        echo "<p>" . $e->getMessage() . "</p>";
    }
}
$areas = [
    "Motricidade Fina",
    "Motricidade Global",
    "Equilíbrio",
    "Esquema Corporal / Rapidez",
    "Organização Espacial",
    "Organização Temporal / Linguagem",
];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Cadastrar teste | Kids Map</title>
        <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../assets/css/principal/cadastrar_teste.css">
        <link rel="stylesheet" href="../assets/css/principal/nav.css">
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
                <a class="nav-link" href="principal.php"><i class="bi bi-house"></i><span>Início</span></a>
                <a class="nav-link" href="pacientes.php"><i class="bi bi-people"></i><span>Pacientes</span></a>
                <a class="nav-link" href="teste.php"><i class="bi bi-clipboard-check"></i><span>Avaliações</span></a>
            </nav>
            <div class="sidebar-inferior">
                <a href="../index.html" class="nav-link sair"><i class="bi bi-box-arrow-right"></i><span>Sair</span></a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle"></i><span>Ajuda</span></a>
            </div>
            <div class="sidebar-conta">
                <div class="conta-avatar"><?php echo $iniciais; ?></div>
                <div class="conta-info">
                    <strong><?php echo $nomeprofissional; ?></strong>
                    <span><?php echo $emailprofissional; ?></span>
                </div>
            </div>
        </aside>

        <main class="conteudo">
              <a href="teste.php" class="voltar"><i class="bi bi-arrow-left"></i>Voltar para avaliações</a>
            <header class="pagina-topo">
                <div>
                    <h1>Nova avaliação</h1>
                    <p>Selecione o paciente e preencha o resultado de cada atividade.</p>
                </div>
            </header>

            <form method="post" action="" class="form-teste">
                <section class="card-form">
                    <div class="campo">
                        <label for="cpf">Paciente</label>
                        <select id="cpf" name="cpf" required>
                            <option value="">Selecione...</option>
                            <?php
                            foreach ($pacientes_resultado as $opcoes) {
                                echo "<option value='" . $opcoes['cpf'] . "'>" . $opcoes['nome'] . " (" . $opcoes['cpf'] . ")" . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </section>

                <section class="card-form">
                 <h2>Atividades</h2>
                    <div class="tabela-wrap">
                        <table class="tabela-edm">
                            <thead>
                                <tr>
                                    <th>Teste</th>
                                    <?php for ($idade = 2; $idade <= 11; $idade++) { ?>
                                        <th><?php echo $idade; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($areas as $linha => $nomeArea) { ?>
                                    <tr>
                                        <td class="area-nome"><?php echo $nomeArea; ?></td>
                                        <?php for ($coluna = 0; $coluna < 10; $coluna++) {
                                            $atividade = $linha * 10 + $coluna + 1; ?>
                                            <td>
                                                <select name="resultado[<?php echo $atividade; ?>]" aria-label="<?php echo $nomeArea; ?> - atividade <?php echo $atividade; ?>">
                                                    
                                                    <option value="0">0</option>
                                                    <?php if ($atividade == 5 || $atividade == 6 ||$atividade == 7 ||$atividade == 8 ||$atividade == 10 
                                                    ||$atividade == 16
                                                    ||$atividade == 22 ||$atividade == 25 ||$atividade == 26 ||$atividade == 30) { ?>
                                                        <option value="0.5">0,5</option>
                                                        <?php } ?>
                                                    <option value="1">1</option>
                                                </select>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <div class="form-acoes">
                    <button type="submit" class="botao-salvar">Salvar avaliação</button>
                </div>
            </form>
        </main>

        <script src="../assets/javascript/principal/pacientes.js"></script>
    </body>
</html>