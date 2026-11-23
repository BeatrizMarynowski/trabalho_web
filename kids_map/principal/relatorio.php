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


$im1 = 0;
$im2 = 0;
$im3 = 0;
$im4 = 0;
$im5 = 0;
$im6 = 0;

$soma = 0;

$idavaliacao = $_GET['id'];
$cpfpassado = $_GET['cpf'];
$consulta = $mysqli->prepare("
    SELECT e.avaliaçao_id, e.atividade_id, e.data, e.resultado, p.nome, p.nome_pai, p.nascimento
    FROM exame e
    JOIN paciente p ON p.cpf = e.paciente_cpf
    WHERE e.profissional_email = ? AND e.avaliaçao_id = ? AND e.paciente_cpf = ?
    ORDER BY e.atividade_id ASC
");
$consulta->bind_param("sis", $emailprofissional, $idavaliacao, $cpfpassado);
$consulta->execute();
$resultado = $consulta->get_result();
$consulta->close();

$resultadocerto = null;

while ($celula = $resultado->fetch_assoc()) {
    if ($resultadocerto === null) {
        $resultadocerto = $celula;
    }

    $idatividade = (int) $celula['atividade_id'];
    $valor = (float) $celula['resultado'];

    // Define a pontuação
    if ($valor == 1) {
        $soma = 12;
    } else if ($valor == 5) {
        $soma = 6;
    } else {
        $soma = 0;
    }

    if ($idatividade >= 1 && $idatividade <= 10) {
        $im1 += $soma;
    } else if ($idatividade >= 11 && $idatividade <= 20) {
        $im2 += $soma;
    } else if ($idatividade >= 21 && $idatividade <= 30) {
        $im3 += $soma;
    } else if ($idatividade >= 31 && $idatividade <= 40) {
        $im4 += $soma;
    } else if ($idatividade >= 41 && $idatividade <= 50) {
        $im5 += $soma;
    } else if ($idatividade >= 51 && $idatividade <= 60) {
        $im6 += $soma;
    }
}

if ($resultadocerto) {
    $datanas = new DateTime($resultadocerto['nascimento']);
    $dataexame = new DateTime($resultadocerto['data']);

    $idade = $dataexame->diff($datanas);

    $datanas = $datanas->format('d/m/Y');
    $dataexame = $dataexame->format('d/m/Y');
    $idadenum = $idade->format('%y anos e %m meses');

    $ic = ($idade->y * 12) + $idade->m;
} else {
    $ic = 0;
    $datanas = "";
    $dataexame = "";
    $idadenum = "";
}

$img = ($im1 + $im2 + $im3 + $im4 + $im5 + $im6) / 6;
$img = round($img, 2);
$qmg = ($ic > 0) ? round(($img / $ic) * 100, 2) : 0;
$ipin = $img - $ic;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Geral | Kids Map</title>
    <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/principal/nav.css">
    <link rel="stylesheet" href="../assets/css/principal/relatorio.css">
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

    <main class="conteudo-relatorio">
        <header class="topo-relatorio">
            <div>
                <a href="teste.php" class="voltar">
                    <i class="bi bi-arrow-left"></i>
                    Voltar aos testes
                </a>
                <h1>Relatório geral</h1>
            </div>
          <div class="acoes-relatorio">
            <a href="editar_relatorio.php?id=<?php echo $idavaliacao; ?>" class="btn-acao btn-editar">
                <i class="bi bi-pencil-square"></i>
                <span>Editar</span>
            </a>
            <button type="button" class="btn-acao btn-excluir"
                onclick="confirmarExclusao()">
                <i class="bi bi-trash3"></i>
                <span>Excluir</span>
            </button>
            <button type="button" class="btn-acao btn-imprimir"
                onclick="window.print()">
                <i class="bi bi-printer"></i>
                <span>Imprimir</span>
            </button>
        </div>
        </header>

        <section class="identificacao">
            <div class="identificacao-principal">
                <div class="nome-crianca">
                    <span class="legenda">PACIENTE</span>
                    <h2><?php echo $resultadocerto['nome']?></h2>
                </div>
            </div>
            <div class="dados-crianca">
                <div class="dado">
                    <span>Data de nascimento</span>
                    <strong><?php echo $datanas?></strong>
                </div>
                <div class="dado">
                    <span>Idade atual</span>
                    <strong><?php echo $idadenum?></strong>
                </div>
                <div class="dado">
                    <span>Data da avaliações</span>
                    <strong><?php echo $dataexame?></strong>
                </div>
                <div class="dado">
                    <span>Nome do responsável</span>
                    <strong><?php echo $resultadocerto['nome_pai']?></strong>
                </div>
            </div>
        </section>

        <section class="secao">
            <div class="titulo-secao">
                <div>
                    <span class="legenda">RESUMO DO DESENVOLVIMENTO</span>
                    <h2>Indicadores gerais</h2>
                    <p>Principais informações da última avaliação.</p>
                </div>
            </div>
            <div class="indicadores">
                <div class="card-indicador rosa">
                    <div class="indicador-topo">
                        <span>IC</span>
                        <i class="bi bi-calendar-heart"></i>
                    </div>
                    <strong><?php echo $ic?></strong>
                    <p>Idade cronológica</p>
                    <small>Em meses</small>
                </div>
                <div class="card-indicador roxo">
                    <div class="indicador-topo">
                        <span>IMG</span>
                        <i class="bi bi-person-arms-up"></i>
                    </div>
                    <strong><?php echo $img?></strong>
                    <p>Idade motora geral</p>
                    <small>Em meses</small>
                </div>
                <div class="card-indicador azul">
                    <div class="indicador-topo">
                        <span>QM</span>
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <strong><?php echo $qmg?></strong>
                    <p>Quociente motor geral</p>
                    <small>Resultado geral</small>
                </div>
                <div class="card-indicador verde">
                    <div class="indicador-topo">
                        <span>IP/IN</span>
                        <i class="bi bi-clipboard2-check"></i>
                    </div>
                    <strong><?php echo $ipin?></strong>
                    <p>Idade Positiva / Idade Negativa</p>
                </div>
            </div>
        </section>

        <section class="secao">
            <div class="titulo-secao">
                <div>
                    <span class="legenda">RESULTADOS DA ÚLTIMA AVALIAÇÃO</span>
                    <h2>Desempenho por área motora</h2>
                    <p>Detalhamento dos resultados obtidos.</p>
                </div>
            </div>
            <div class="tabela-container">
                <table class="tabela-resultados">
                    <thead>
                        <tr>
                            <th>Área avaliada</th>
                            <th>Idade motora</th>
                            <th>Idade cronológica</th>
                            <th>Diferença</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Motricidade fina</td>
                            <td><?php echo $im1?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-25 meses</span></td>
                        </tr>
                        <tr>
                            <td>Motricidade global</td>
                            <td><?php echo $im2?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-15 meses</span></td>
                        </tr>
                        <tr>
                            <td>Equilíbrio</td>
                            <td><?php echo $im3?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-5 meses</span></td>
                        </tr>
                        <tr>
                            <td>Esquema corporal</td>
                            <td><?php echo $im4?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-10 meses</span></td>
                        </tr>
                        <tr>
                            <td>Organização espacial</td>
                            <td><?php echo $im5?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-21 meses</span></td>
                        </tr>
                        <tr>
                            <td>Organização temporal</td>
                            <td><?php echo $im6?> meses</td>
                            <td><?php echo $ic?> meses</td>
                            <td><span class="resultado-negativo">-12 meses</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script src="../assets/javascript/principal/relatorio.js"></script>
    </main>
</body>
</html>