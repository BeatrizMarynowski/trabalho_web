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

$avaliacaoid = $_GET['id'];

$consulta = $mysqli->prepare("
    SELECT e.atividade_id, e.resultado, e.paciente_cpf, p.nome
    FROM exame e
    JOIN paciente p ON p.cpf = e.paciente_cpf
    WHERE e.avaliaçao_id = ? AND e.profissional_email = ?
");
$consulta->bind_param("is", $avaliacaoid, $emailprofissional);
$consulta->execute();
$valor = $consulta->get_result();

$respostas = [];

$resultadocerto = null;

while ($linha = $valor->fetch_assoc()) {
    if ($resultadocerto === null) {
        $resultadocerto = $linha;
    }
    $idativ = $linha['atividade_id'];
    $resp = $linha['resultado'];
    
    if ($resp == 5) {
        $respostas[$idativ] = "0.5";
    } else {
        $respostas[$idativ] = (string)$resp;
    }
}
$consulta->close();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = $resultadocerto['paciente_cpf'];

    try {
        $consulta = $mysqli->prepare("UPDATE exame SET resultado = ? WHERE avaliaçao_id = ? AND atividade_id = ? AND profissional_email = ?");
        foreach ($_POST['resultado'] as $atividadeId => $resultado) {
            if ($resultado === "0.5") {
                $resultadobanco = 5;
            } else {
                $resultadobanco = $resultado;
            }
            $consulta->bind_param("iiis", $resultadobanco, $avaliacaoid, $atividadeId, $emailprofissional);
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
                <a href="./logout.php" class="nav-link sair"><i class="bi bi-box-arrow-right"></i><span>Sair</span></a>
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
                    <h1>Editar avaliação</h1>
                    <p>Selecione o paciente e preencha o resultado de cada atividade.</p>
                </div>
            </header>

            <form method="post" action="" class="form-teste">
                <section class="card-form">
                    <div class="campo">
                        <label for="cpf">Paciente</label>
                        <p><?php echo $resultadocerto['nome']?></p>
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
                                            $atividade = $linha * 10 + $coluna + 1; 
                                            $valor = $respostas[$atividade]; ?>
                                            <td>
                                                <select name="resultado[<?php echo $atividade; ?>]">
                                                    <option value="1" <?php echo ($valor === "1") ? 'selected' : ''; ?>>1</option>
                                                    <?php if (in_array($atividade, [5, 6, 7, 8, 10, 16, 22, 25, 26, 30])) { ?>
                                                        <option value="0.5" <?php echo ($valor === "0.5") ? 'selected' : ''; ?>>0,5</option>
                                                    <?php } ?>
                                                    <option value="0" <?php echo ($valor === "0") ? 'selected' : ''; ?>>0</option>
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