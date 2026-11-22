
<?php
session_start();

if (!isset($_SESSION['profissional_email'])) {
    header("Location: ../entrada/login.php");
    exit;
}

// DADOS FICTÍCIOS PARA O PROTÓTIPO
$paciente = [
    'nome' => 'Beatriz Rodrigues',
    'sexo' => 'Feminino',
    'nascimento' => '14/03/2018',
    'idade' => '8 anos 8 meses e 3 dias',
    'peso' => '27,5 kg',
    'altura' => '129 cm',
    'data_avaliacao' => '17/11/2026'
];

$avaliacao = [
    'ic' => 104,
    'img' => 56,
    'qmg' => 54,
    'ipin' => -48
];

$areas = [
    ['codigo' => 'IM1', 'nome' => 'Motricidade Fina',       'im' => 60, 'qm' => 58],
    ['codigo' => 'IM2', 'nome' => 'Motricidade Global',     'im' => 72, 'qm' => 69],
    ['codigo' => 'IM3', 'nome' => 'Equilíbrio',             'im' => 48, 'qm' => 46],
    ['codigo' => 'IM4', 'nome' => 'Esquema Corporal',       'im' => 60, 'qm' => 58],
    ['codigo' => 'IM5', 'nome' => 'Organização Espacial',   'im' => 60, 'qm' => 58],
    ['codigo' => 'IM6', 'nome' => 'Organização Temporal',   'im' => 35, 'qm' => 34]
];

$classificacoes = [
    ['nome' => 'Muito Inferior', 'intervalo' => 'Abaixo de 70', 'cor' => '#D76A72', 'classe' => 'muito-inferior'],
    ['nome' => 'Inferior', 'intervalo' => '70 a 79', 'cor' => '#E9997C', 'classe' => 'inferior'],
    ['nome' => 'Normal Baixo', 'intervalo' => '80 a 89', 'cor' => '#E6C75D', 'classe' => 'normal-baixo'],
    ['nome' => 'Normal Médio', 'intervalo' => '90 a 109', 'cor' => '#65A6D2', 'classe' => 'normal-medio'],
    ['nome' => 'Normal Alto', 'intervalo' => '110 a 119', 'cor' => '#62BBAA', 'classe' => 'normal-alto'],
    ['nome' => 'Superior', 'intervalo' => '120 a 129', 'cor' => '#72B77C', 'classe' => 'superior'],
    ['nome' => 'Muito Superior', 'intervalo' => '130 ou mais', 'cor' => '#A6C96D', 'classe' => 'muito-superior']
];

function classificacaoQMG($qmg, $classificacoes) {
    if ($qmg < 70) return $classificacoes[0];
    if ($qmg < 80) return $classificacoes[1];
    if ($qmg < 90) return $classificacoes[2];
    if ($qmg < 110) return $classificacoes[3];
    if ($qmg < 120) return $classificacoes[4];
    if ($qmg < 130) return $classificacoes[5];
    return $classificacoes[6];
}

function formatarDiferenca($valor) {
    return ($valor < 0 ? '−' : '+') . abs($valor) . ' meses';
}

$classificacao = classificacaoQMG(
    $avaliacao['qmg'],
    $classificacoes
);

$atencoes = array_filter($areas, function ($area) {
    return $area['qm'] < 80;
});

usort($atencoes, function ($a, $b) {
    return $a['qm'] <=> $b['qm'];
});

$areaForte = $areas[0];
$areaFraca = $areas[0];

foreach ($areas as $area) {
    if ($area['im'] > $areaForte['im']) {
        $areaForte = $area;
    }

    if ($area['im'] < $areaFraca['im']) {
        $areaFraca = $area;
    }
}

$nomeProfissional = $_SESSION['profissional_nome'] ?? 'Profissional';
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

    <title>Resultado EDM | Kids Map</title>

    <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/principal/nav.css">
    <link rel="stylesheet" href="../assets/css/principal/relatorio_especifico.css">
</head>

<body>

<!-- MENU LATERAL -->

<aside class="sidebar">

    <div class="sidebar-logo">
        <img src="../assets/imagens/logo.png" alt="Kids Map">
    </div>

    <button class="menu-toggle" id="menuToggle"
        aria-label="Abrir menu" aria-expanded="false">
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

        <a class="nav-link" href="teste.php">
            <i class="bi bi-clipboard-check"></i>
            <span>Avaliações</span>
        </a>

    </nav>

    <div class="sidebar-inferior">

        <a href="../index.html" class="nav-link sair">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sair</span>
        </a>

        <a href="#" class="nav-link">
            <i class="bi bi-question-circle"></i>
            <span>Ajuda</span>
        </a>

    </div>

    <div class="sidebar-conta">

        <div class="conta-avatar">
            <?= htmlspecialchars($iniciais) ?>
        </div>

        <div class="conta-info">
            <strong><?= htmlspecialchars($nomeProfissional) ?></strong>
            <span><?= htmlspecialchars($_SESSION['profissional_email']) ?></span>
        </div>

    </div>

</aside>


<!-- CONTEÚDO -->

<main class="conteudo-resultado">

    <!-- TOPO -->

    <header class="topo-resultado">

        <div>

            <h1>Resultado — EDM</h1>
            <p>Resultado individual da avaliação do paciente.</p>
        </div>

        <div class="acoes-resultado">

            <button class="btn-acao btn-imprimir"
                onclick="window.print()">
                <i class="bi bi-printer"></i>
                Imprimir
            </button>

            <a href="editar_avaliacao.php?id=1"
                class="btn-acao btn-editar">
                <i class="bi bi-pencil"></i>
                Editar
            </a>

            <button class="btn-acao btn-excluir"
                onclick="confirmarExclusao()">
                <i class="bi bi-trash"></i>
                Excluir
            </button>

        </div>

    </header>


    <!-- RESUMO DA AVALIAÇÃO -->

    <section class="card-resumo">

        <div class="resumo-principal">

            <div class="dados-resumo">

                <span class="linha-pequena">
                    <?= $paciente['sexo'] ?> ·
                    Nascimento <?= $paciente['nascimento'] ?>
                    (<?= $paciente['idade'] ?>)
                </span>

                <a href="relatorio_geral.php?id=1"
                    class="nome-paciente">
                    <?= htmlspecialchars($paciente['nome']) ?>
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>

                <span class="data-avaliacao">
                    <i class="bi bi-calendar3"></i>
                    Avaliação em <?= $paciente['data_avaliacao'] ?>
                </span>

            </div>

            <div class="classificacao-destaque"
                style="--cor-classificacao: <?= $classificacao['cor'] ?>">

                <span>CLASSIFICAÇÃO</span>

                <strong><?= $classificacao['nome'] ?></strong>

                <small>QMG <?= $avaliacao['qmg'] ?></small>

            </div>

        </div>


        <!-- INDICADORES -->

        <div class="indicadores-grid">

            <div class="indicador-card ic-card">
                <span>IC</span>
                <strong><?= $avaliacao['ic'] ?></strong>
                <small>meses</small>
            </div>

            <div class="indicador-card img-card">
                <span>IMG</span>
                <strong><?= $avaliacao['img'] ?></strong>
                <small>meses</small>
            </div>

            <div class="indicador-card qmg-card">
                <span>QMG</span>
                <strong><?= $avaliacao['qmg'] ?></strong>
                <small><?= $classificacao['nome'] ?></small>
            </div>

            <div class="indicador-card ipin-card">
                <span>IP/IN</span>
                <strong class="valor-negativo">
                    <?= $avaliacao['ipin'] ?>
                </strong>
                <small>meses abaixo do esperado</small>
            </div>

        </div>

    </section>



        <!-- PONTOS DE ATENÇÃO -->

        <div class="atencoes-container">


            <div class="lista-atencoes">

                <?php foreach ($atencoes as $area): ?>

                    <div class="atencao-item">

                        <strong>
                            <?= $area['codigo'] ?> —
                            <?= $area['nome'] ?>
                        </strong>

                        <span class="selo-qm">
                            QM <?= $area['qm'] ?>
                        </span>

                        <span class="diferenca-negativa">
                            <?= formatarDiferenca($area['im'] - $avaliacao['ic']) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- PONTO FORTE E PRÓXIMO FOCO -->

        <div class="foco-grid">

            <div class="foco-card ponto-forte">

                <div class="foco-icone">
                    <i class="bi bi-star"></i>
                </div>

                <div>
                    <span>PONTO FORTE</span>

                    <strong>
                        <?= $areaForte['codigo'] ?> —
                        <?= $areaForte['nome'] ?>
                    </strong>

                    <p>
                        IM <?= $areaForte['im'] ?> meses ·
                        <?= formatarDiferenca($areaForte['im'] - $avaliacao['ic']) ?>
                    </p>
                </div>

            </div>

            <div class="foco-card proximo-foco">

                <div class="foco-icone">
                    <i class="bi bi-bullseye"></i>
                </div>

                <div>
                    <span>PRÓXIMO FOCO</span>

                    <strong>
                        <?= $areaFraca['codigo'] ?> —
                        <?= $areaFraca['nome'] ?>
                    </strong>

                    <p>
                        IM <?= $areaFraca['im'] ?> meses ·
                        <?= formatarDiferenca($areaFraca['im'] - $avaliacao['ic']) ?>
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- PERFIL MOTOR E QUOCIENTES -->

    <section class="secao-resultado">

        <div class="cabecalho-secao">
            <div>
                <h2>Perfil motor e quocientes</h2>
                <p>
                    Resultados individuais das seis áreas avaliadas.
                </p>
            </div>
        </div>

        <div class="tabelas-grid">

            <!-- PERFIL MOTOR -->

            <div class="card-tabela">

                <div class="titulo-tabela">
                    <div class="icone-tabela roxo">
                        <i class="bi bi-person-arms-up"></i>
                    </div>

                    <div>
                        <h3>Perfil motor</h3>
                        <span>Idade motora em meses</span>
                    </div>
                </div>

                <div class="tabela-responsiva">

                    <table class="tabela-resultados">

                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>IM</th>
                                <th>Diferença vs IC</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($areas as $area):
                                $diferenca = $area['im'] - $avaliacao['ic'];
                            ?>

                                <tr>
                                    <td>
                                        <strong><?= $area['codigo'] ?></strong>
                                        <span><?= $area['nome'] ?></span>
                                    </td>

                                    <td><?= $area['im'] ?></td>

                                    <td class="<?= $diferenca < 0 ? 'valor-negativo' : '' ?>">
                                        <?= $diferenca ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                            <tr class="linha-total">
                                <td>
                                    <strong>IMG</strong>
                                    <span>Idade motora geral</span>
                                </td>

                                <td><?= $avaliacao['img'] ?></td>

                                <td class="valor-negativo">
                                    <?= $avaliacao['ipin'] ?>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- QUOCIENTES -->

            <div class="card-tabela">

                <div class="titulo-tabela">
                    <div class="icone-tabela rosa">
                        <i class="bi bi-graph-up"></i>
                    </div>

                    <div>
                        <h3>Quocientes motores</h3>
                        <span>Quociente por área</span>
                    </div>
                </div>

                <div class="tabela-responsiva">

                    <table class="tabela-resultados tabela-qm">

                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>QM</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($areas as $area): ?>

                                <tr>
                                    <td>
                                        <strong><?= $area['codigo'] ?></strong>
                                        <span><?= $area['nome'] ?></span>
                                    </td>

                                    <td class="<?= $area['qm'] < 80 ? 'valor-negativo' : '' ?>">
                                        <?= $area['qm'] ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                            <tr class="linha-total">
                                <td>
                                    <strong>QMG</strong>
                                    <span>Quociente motor geral</span>
                                </td>

                                <td class="valor-negativo">
                                    <?= $avaliacao['qmg'] ?>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>


    <!-- CURVA DE DESENVOLVIMENTO -->

    <section class="secao-resultado">

        <div class="cabecalho-secao">
            <div>
                <h2>Curva de desenvolvimento motor</h2>

                <p>
                    Escala de 0 a 132 meses, ajustada a esta avaliação.
                </p>
            </div>

            <span class="tag-individual">
                <i class="bi bi-circle-fill"></i>
                Avaliação individual
            </span>
        </div>


        <div class="card-grafico">

            <div class="grafico-area">

                <svg class="grafico-curva"
                    viewBox="0 0 540 540"
                    role="img"
                    aria-label="Gráfico individual da idade cronológica e idade motora geral">

                    <defs>
                        <clipPath id="recorteGrafico">
                            <rect x="65" y="45" width="420" height="420"/>
                        </clipPath>
                    </defs>

                    <g clip-path="url(#recorteGrafico)">

                        <!-- FAIXAS DE CLASSIFICAÇÃO -->

                        <polygon points="65,465 485,465 485,245"
                            fill="#F3C7CC"/>

                        <polygon points="65,465 485,245 485,210"
                            fill="#F6D5C9"/>

                        <polygon points="65,465 485,210 485,175"
                            fill="#F8EDC5"/>

                        <polygon points="65,465 485,175 485,45"
                            fill="#D9EAF7"/>

                        <polygon points="65,465 485,45 443,45"
                            fill="#CDEBE5"/>

                        <polygon points="65,465 443,45 415,45"
                            fill="#D5EBD4"/>

                        <polygon points="65,465 415,45 65,45"
                            fill="#E4F0C9"/>


                        <!-- GRADE -->

                        <g class="grade-curva">
                            <?php for ($i = 0; $i <= 132; $i += 24):
                                $pos = 465 - ($i / 132 * 420);
                            ?>
                                <line x1="65" y1="<?= $pos ?>"
                                    x2="485" y2="<?= $pos ?>"/>

                                <line x1="<?= 65 + ($i / 132 * 420) ?>"
                                    y1="45" x2="<?= 65 + ($i / 132 * 420) ?>"
                                    y2="465"/>
                            <?php endfor; ?>
                        </g>


                        <!-- RETAS DE CLASSIFICAÇÃO -->

                        <g class="retas-classificacao">

                            <line x1="65" y1="465" x2="485" y2="245"/>
                            <line x1="65" y1="465" x2="485" y2="210"/>
                            <line x1="65" y1="465" x2="485" y2="175"/>

                            <line class="linha-referencia"
                                x1="65" y1="465" x2="485" y2="45"/>

                            <line x1="65" y1="465" x2="443" y2="45"/>
                            <line x1="65" y1="465" x2="415" y2="45"/>
                            <line x1="65" y1="465" x2="389" y2="45"/>

                        </g>


                        <!-- PONTO DA AVALIAÇÃO -->

                        <?php
                            $pontoX = 65 + ($avaliacao['ic'] / 132 * 420);
                            $pontoY = 465 - ($avaliacao['img'] / 132 * 420);
                        ?>

                        <circle class="ponto-avaliacao"
                            cx="<?= $pontoX ?>"
                            cy="<?= $pontoY ?>"
                            r="10"/>

                        <text class="rotulo-ponto"
                            x="<?= $pontoX ?>"
                            y="<?= $pontoY - 17 ?>">
                            EDM
                        </text>

                    </g>


                    <!-- EIXOS -->

                    <g class="eixos-grafico">

                        <line x1="65" y1="45" x2="65" y2="465"/>
                        <line x1="65" y1="465" x2="485" y2="465"/>

                    </g>


                    <!-- VALORES DOS EIXOS -->

                    <g class="texto-eixo">

                        <?php for ($i = 0; $i <= 132; $i += 24):
                            $pos = 465 - ($i / 132 * 420);
                            $posX = 65 + ($i / 132 * 420);
                        ?>

                            <text x="53" y="<?= $pos + 4 ?>">
                                <?= $i ?>
                            </text>

                            <text x="<?= $posX ?>" y="483">
                                <?= $i ?>
                            </text>

                        <?php endfor; ?>

                    </g>


                    <!-- RÓTULOS DAS RETAS -->

                    <g class="rotulos-retas">
                        <text x="490" y="249">70</text>
                        <text x="490" y="214">80</text>
                        <text x="490" y="179">90</text>
                        <text x="490" y="49">100</text>
                        <text x="443" y="39">110</text>
                        <text x="415" y="39">120</text>
                        <text x="389" y="39">130</text>
                    </g>


                    <text x="275" y="523" class="titulo-eixo">
                        IC — Idade cronológica (meses)
                    </text>

                    <text x="17" y="255"
                        class="titulo-eixo titulo-vertical"
                        transform="rotate(-90 17 255)">
                        IMG — Idade motora geral (meses)
                    </text>

                </svg>

            </div>


            <!-- LEGENDA -->

            <div class="legenda-container">

                <h3>Classificação por QMG</h3>

                <div class="legenda-classificacoes">

                    <?php foreach ($classificacoes as $item): ?>

                        <div class="legenda-item">

                            <span class="bolinha <?= $item['classe'] ?>"></span>

                            <div>
                                <strong><?= $item['nome'] ?></strong>
                                <small><?= $item['intervalo'] ?></small>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="nota-grafico">
                <i class="bi bi-info-circle"></i>
                <p>
                    O ponto representa esta avaliação. Pontos acima da
                    reta 100 indicam IMG superior à IC; abaixo da reta,
                    indicam IMG inferior à IC. As retas representam
                    referências de classificação por QMG.
                </p>
            </div>

        </div>

    </section>


    <!-- RODAPÉ -->

    <footer class="rodape-resultado">
        <span>Kids Map · Desenvolvimento e acompanhamento motor</span>
        <span>Resultado individual da avaliação EDM</span>
    </footer>

</main>


<script src="../assets/javascript/principal/pacientes.js"></script>

<script>
function confirmarExclusao() {

    const confirmar = confirm(
        "Tem certeza de que deseja excluir esta avaliação? Esta ação não poderá ser desfeita."
    );

    if (confirmar) {
        alert(
            "Protótipo: conecte esta ação à exclusão da avaliação no PHP."
        );
    }

}
</script>

</body>
</html>
