<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relatório geral | Kids Map</title>

    <link rel="icon" href="../assets/imagens/icone.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/principal/nav.css">
    <link rel="stylesheet" href="../assets/css/principal/relatorio_geral.css">
</head>

<body>

<!-- SIDEBAR -->
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
        <div class="conta-avatar">PR</div>

        <div class="conta-info">
            <strong>Profissional</strong>
            <span>profissional@email.com</span>
        </div>
    </div>

</aside>


<!-- CONTEÚDO -->
<main class="conteudo-relatorio">

    <!-- TOPO -->
    <header class="topo-paciente">

        <a href="pacientes.php" class="voltar-pacientes">
            <i class="bi bi-arrow-left"></i>
            Voltar para pacientes
        </a>

        <div class="topo-principal">

            <div>
                <span class="subtitulo">RELATÓRIO GERAL DO PACIENTE</span>
                <h1>Beatriz Rodrigues</h1>
                <p>Acompanhamento do desenvolvimento motor</p>
            </div>

            <div class="acoes-topo">

                <a href="editar_paciente.php?id=1" class="btn-acao btn-editar">
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>

                <button type="button" class="btn-acao btn-excluir"
                    onclick="confirmarExclusao()">
                    <i class="bi bi-trash"></i>
                    Excluir
                </button>

            </div>

        </div>

    </header>


    <!-- DADOS DO PACIENTE -->
    <section class="card-paciente">

        <div class="secao-card-titulo">
            <div class="icone-titulo">
                <i class="bi bi-person-vcard"></i>
            </div>
            <h2>Dados do paciente</h2>
        </div>

        <div class="dados-paciente-grid">

            <div class="dado-paciente">
                <span>Sexo</span>
                <strong>Feminino</strong>
            </div>

            <div class="dado-paciente">
                <span>Data de nascimento</span>
                <strong>04/11/2020</strong>
            </div>

            <div class="dado-paciente">
                <span>Idade atual</span>
                <strong>6 anos e 12 dias</strong>
            </div>

            <div class="dado-paciente">
                <span>Idade gestacional</span>
                <strong>41 <small>· A termo</small></strong>
            </div>

            <div class="dado-paciente">
                <span>
                    Peso
                    <i class="bi bi-graph-up indicador-evolucao"></i>
                </span>
                <strong>3,450 kg</strong>
            </div>

            <div class="dado-paciente">
                <span>
                    Altura
                    <i class="bi bi-graph-up indicador-evolucao"></i>
                </span>
                <strong>51 cm</strong>
            </div>

        </div>

        <div class="divisor-card"></div>

        <!-- RESPONSÁVEL -->
        <div class="responsavel-secao">

            <div class="secao-card-titulo">
                <div class="icone-titulo rosa">
                    <i class="bi bi-person-heart"></i>
                </div>
                <h2>Responsável</h2>
            </div>

            <div class="dados-responsavel-grid">

                <div class="dado-paciente">
                    <span>Nome</span>
                    <strong>Maria Rodrigues</strong>
                </div>

                <div class="dado-paciente">
                    <span>E-mail</span>
                    <strong>maria@email.com</strong>
                </div>

                <div class="dado-paciente">
                    <span>Telefone</span>
                    <strong>(41) 99999-9999</strong>
                </div>

            </div>

        </div>

    </section>


    <!-- EDM -->
    <section class="secao-edm">

        <div class="cabecalho-edm">

            <div>
                <span class="subtitulo">ACOMPANHAMENTO</span>
                <h2>EDM: Desenvolvimento Motor</h2>
                <p>Histórico e evolução dos resultados de todas as avaliações.</p>
            </div>

            <div class="acoes-edm">

                <button type="button" class="btn-acao btn-imprimir"
                    onclick="window.print()">
                    <i class="bi bi-printer"></i>
                    Imprimir
                </button>

                <a href="nova_avaliacao.php?paciente=1"
                    class="btn-acao btn-nova">
                    <i class="bi bi-plus-lg"></i>
                    Nova EDM
                </a>

            </div>

        </div>


        <!-- CURVA EVOLUTIVA -->
        <section class="card-relatorio">

            <div class="titulo-grafico">
                <div>
                    <h3>Curva evolutiva IC × IMG</h3>
                    <p>Relação entre idade cronológica e idade motora geral.</p>
                </div>

                <span class="tag-grafico">
                    <i class="bi bi-graph-up"></i>
                    3 avaliações
                </span>
            </div>

            <div class="grafico-curva-container">

                <svg class="grafico-curva"
                    viewBox="0 0 680 660"
                    role="img"
                    aria-label="Gráfico da relação entre idade cronológica e idade motora geral">

                    <defs>
                        <clipPath id="areaGrafico">
                            <rect x="65" y="25" width="540" height="540"/>
                        </clipPath>
                    </defs>

                    <!-- ÁREAS DE CLASSIFICAÇÃO -->
                    <g clip-path="url(#areaGrafico)">

                        <rect x="65" y="25" width="540" height="540" fill="#E8F3FA"/>

                        <!-- Muito inferior -->
                        <polygon points="65,565 605,565 605,302"
                            fill="#F3C7CC"/>

                        <!-- Inferior -->
                        <polygon points="65,565 605,302 605,265"
                            fill="#F6D5C9"/>

                        <!-- Normal baixo -->
                        <polygon points="65,565 605,265 605,227"
                            fill="#F8EDC5"/>

                        <!-- Normal médio -->
                        <polygon points="65,565 605,227 605,152"
                            fill="#D9EAF7"/>

                        <!-- Normal alto -->
                        <polygon points="65,565 605,152 620,125"
                            fill="#CDEBE5"/>

                        <!-- Superior -->
                        <polygon points="65,565 620,125 620,100"
                            fill="#D5EBD4"/>

                        <!-- Muito superior -->
                        <polygon points="65,565 620,100 65,25"
                            fill="#E4F0C9"/>

                        <!-- Grade -->
                        <g class="grade-curva">
                            <line x1="65" y1="565" x2="605" y2="565"/>
                            <line x1="65" y1="475" x2="605" y2="475"/>
                            <line x1="65" y1="385" x2="605" y2="385"/>
                            <line x1="65" y1="295" x2="605" y2="295"/>
                            <line x1="65" y1="205" x2="605" y2="205"/>
                            <line x1="65" y1="115" x2="605" y2="115"/>
                            <line x1="65" y1="25" x2="605" y2="25"/>

                            <line x1="65" y1="25" x2="65" y2="565"/>
                            <line x1="155" y1="25" x2="155" y2="565"/>
                            <line x1="245" y1="25" x2="245" y2="565"/>
                            <line x1="335" y1="25" x2="335" y2="565"/>
                            <line x1="425" y1="25" x2="425" y2="565"/>
                            <line x1="515" y1="25" x2="515" y2="565"/>
                            <line x1="605" y1="25" x2="605" y2="565"/>
                        </g>

                        <!-- RETAS DE CLASSIFICAÇÃO -->
                        <g class="retas-classificacao">

                            <line x1="65" y1="565" x2="605" y2="302"/>
                            <line x1="65" y1="565" x2="605" y2="265"/>
                            <line x1="65" y1="565" x2="605" y2="227"/>
                            <line x1="65" y1="565" x2="605" y2="190"
                                class="linha-normal"/>
                            <line x1="65" y1="565" x2="605" y2="152"/>
                            <line x1="65" y1="565" x2="605" y2="115"/>
                            <line x1="65" y1="565" x2="605" y2="77"/>

                        </g>

                        <!-- PONTOS DAS AVALIAÇÕES -->
                        <polyline class="linha-avaliacoes"
                            points="245,407.5 290,385 335,355"/>

                        <g class="pontos-avaliacoes">
                            <circle cx="245" cy="407.5" r="11"/>
                            <circle cx="290" cy="385" r="11"/>
                            <circle cx="335" cy="355" r="11"/>
                        </g>

                        <g class="numeros-avaliacoes">
                            <text x="245" y="412">1</text>
                            <text x="290" y="389">2</text>
                            <text x="335" y="359">3</text>
                        </g>

                    </g>

                    <!-- EIXOS -->
                    <g class="eixos-curva">
                        <line x1="65" y1="25" x2="65" y2="565"/>
                        <line x1="65" y1="565" x2="605" y2="565"/>
                    </g>

                    <!-- EIXO Y -->
                    <g class="texto-eixo-curva">
                        <text x="52" y="569">0</text>
                        <text x="52" y="479">24</text>
                        <text x="52" y="389">48</text>
                        <text x="52" y="299">72</text>
                        <text x="52" y="209">96</text>
                        <text x="52" y="119">120</text>
                        <text x="52" y="29">144</text>
                    </g>

                    <!-- EIXO X -->
                    <g class="texto-eixo-curva eixo-x">
                        <text x="65" y="584">0</text>
                        <text x="155" y="584">24</text>
                        <text x="245" y="584">48</text>
                        <text x="335" y="584">72</text>
                        <text x="425" y="584">96</text>
                        <text x="515" y="584">120</text>
                        <text x="605" y="584">144</text>
                    </g>

                    <!-- RÓTULOS DAS RETAS -->
                    <g class="rotulos-retas">
                        <text x="607" y="307">70</text>
                        <text x="607" y="270">80</text>
                        <text x="607" y="232">90</text>
                        <text x="607" y="195">100</text>
                        <text x="607" y="157">110</text>
                        <text x="607" y="120">120</text>
                        <text x="607" y="82">130</text>
                    </g>

                    <text x="335" y="630" class="titulo-eixo">
                        Idade cronológica (meses)
                    </text>

                    <text x="15" y="300"
                        transform="rotate(-90 15 300)"
                        class="titulo-eixo">
                        Idade motora geral (meses)
                    </text>

                </svg>

            </div>


            <!-- LEGENDA -->
            <div class="legenda-classificacoes">

                <div class="classificacao-item">
                    <i class="bolinha c-muito-inferior"></i>
                    <div class="classificacao-texto">
                        <strong>Muito inferior</strong>
                        <span>QMG abaixo de 70</span>
                    </div>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-inferior"></i>
                    <div class="classificacao-texto">
                        <strong>Inferior</strong>
                        <span>70 a 79</span>
                    </div>
                    <span class="quantidade">1 (33%)</span>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-normal-baixo"></i>
                    <div class="classificacao-texto">
                        <strong>Normal baixo</strong>
                        <span>80 a 89</span>
                    </div>
                    <span class="quantidade">2 (67%)</span>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-normal-medio"></i>
                    <div class="classificacao-texto">
                        <strong>Normal médio</strong>
                        <span>90 a 109</span>
                    </div>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-normal-alto"></i>
                    <div class="classificacao-texto">
                        <strong>Normal alto</strong>
                        <span>110 a 119</span>
                    </div>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-superior"></i>
                    <div class="classificacao-texto">
                        <strong>Superior</strong>
                        <span>120 a 129</span>
                    </div>
                </div>

                <div class="classificacao-item">
                    <i class="bolinha c-muito-superior"></i>
                    <div class="classificacao-texto">
                        <strong>Muito superior</strong>
                        <span>130 ou mais</span>
                    </div>
                </div>

            </div>

            <div class="explicacao-grafico">
                <i class="bi bi-info-circle"></i>
                <p>
                    Pontos acima da reta 100 indicam IMG maior que a IC.
                    Abaixo da reta, a IMG é menor que a IC.
                    Os pontos de cada paciente são ligados em ordem cronológica.
                </p>
            </div>

        </section>


        <!-- GRÁFICOS SECUNDÁRIOS -->
        <div class="graficos-duplos">


            <!-- IDADE CRONOLÓGICA X MOTORA -->
            <section class="card-relatorio grafico-secundario">

                <div class="titulo-grafico">
                    <div>
                        <h3>Idade cronológica × Idade motora</h3>
                        <p>Evolução das idades ao longo das avaliações.</p>
                    </div>
                </div>

                <div class="grafico-secundario-area">

                    <svg viewBox="0 0 500 290"
                        class="grafico-linhas"
                        role="img"
                        aria-label="Comparação entre idade cronológica e idades motoras">

                        <g class="grade-secundaria">
                            <line x1="55" y1="25" x2="475" y2="25"/>
                            <line x1="55" y1="75" x2="475" y2="75"/>
                            <line x1="55" y1="125" x2="475" y2="125"/>
                            <line x1="55" y1="175" x2="475" y2="175"/>
                            <line x1="55" y1="225" x2="475" y2="225"/>
                        </g>

                        <g class="eixo-secundario">
                            <text x="43" y="229">0</text>
                            <text x="43" y="179">36</text>
                            <text x="43" y="129">72</text>
                            <text x="43" y="79">108</text>
                            <text x="43" y="29">144</text>
                        </g>

                        <!-- IC -->
                        <polyline class="serie linha-ic"
                            points="110,158 265,142 420,125"/>

                        <!-- IMG -->
                        <polyline class="serie linha-img"
                            points="110,167 265,158 420,147"/>

                        <!-- IM1 -->
                        <polyline class="serie linha-im1"
                            points="110,161 265,158 420,142"/>

                        <!-- IM2 -->
                        <polyline class="serie linha-im2"
                            points="110,156 265,158 420,142"/>

                        <!-- IM3 -->
                        <polyline class="serie linha-im3"
                            points="110,158 265,158 420,142"/>

                        <!-- IM4 -->
                        <polyline class="serie linha-im4"
                            points="110,161 265,158 420,142"/>

                        <!-- IM5 -->
                        <polyline class="serie linha-im5"
                            points="110,156 265,158 420,142"/>

                        <!-- IM6 -->
                        <polyline class="serie linha-im6"
                            points="110,172 265,175 420,175"/>

                        <g class="pontos-secundarios">
                            <circle cx="110" cy="158" r="4"/>
                            <circle cx="265" cy="142" r="4"/>
                            <circle cx="420" cy="125" r="4"/>
                        </g>

                        <g class="rotulos-avaliacoes">
                            <text x="110" y="250">#1</text>
                            <text x="265" y="250">#2</text>
                            <text x="420" y="250">#3</text>
                        </g>

                    </svg>

                </div>

                <div class="chips-legenda">

                    <span><i class="cor-ic"></i> IC</span>
                    <span><i class="cor-img"></i> IMG</span>
                    <span><i class="cor-im1"></i> IM1</span>
                    <span><i class="cor-im2"></i> IM2</span>
                    <span><i class="cor-im3"></i> IM3</span>
                    <span><i class="cor-im4"></i> IM4</span>
                    <span><i class="cor-im5"></i> IM5</span>
                    <span><i class="cor-im6"></i> IM6</span>

                </div>

            </section>


            <!-- QUOCIENTE MOTOR -->
            <section class="card-relatorio grafico-secundario">

                <div class="titulo-grafico">
                    <div>
                        <h3>Quociente motor</h3>
                        <p>Evolução dos quocientes motores.</p>
                    </div>
                </div>

                <div class="grafico-secundario-area">

                    <svg viewBox="0 0 500 290"
                        class="grafico-linhas"
                        role="img"
                        aria-label="Evolução dos quocientes motores">

                        <g class="grade-secundaria">
                            <line x1="55" y1="25" x2="475" y2="25"/>
                            <line x1="55" y1="75" x2="475" y2="75"/>
                            <line x1="55" y1="125" x2="475" y2="125"/>
                            <line x1="55" y1="175" x2="475" y2="175"/>
                            <line x1="55" y1="225" x2="475" y2="225"/>
                        </g>

                        <g class="eixo-secundario">
                            <text x="43" y="229">0</text>
                            <text x="43" y="179">36</text>
                            <text x="43" y="129">72</text>
                            <text x="43" y="79">108</text>
                            <text x="43" y="29">144</text>
                        </g>

                        <!-- QMG -->
                        <polyline class="serie linha-qmg"
                            points="110,103.5 265,114 420,117"/>

                        <!-- QM1 -->
                        <polyline class="serie linha-qm1"
                            points="110,109.7 265,114 420,109.7"/>

                        <!-- QM2 -->
                        <polyline class="serie linha-qm2"
                            points="110,97.2 265,114 420,109.7"/>

                        <!-- QM3 -->
                        <polyline class="serie linha-qm3"
                            points="110,106.9 265,111.2 420,114"/>

                        <!-- QM4 -->
                        <polyline class="serie linha-qm4"
                            points="110,114 265,118.2 420,122.4"/>

                        <!-- QM5 -->
                        <polyline class="serie linha-qm5"
                            points="110,101.4 265,109.7 420,114"/>

                        <!-- QM6 -->
                        <polyline class="serie linha-qm6"
                            points="110,126.5 265,126.5 420,126.5"/>

                        <g class="rotulos-avaliacoes">
                            <text x="110" y="250">#1</text>
                            <text x="265" y="250">#2</text>
                            <text x="420" y="250">#3</text>
                        </g>

                    </svg>

                </div>

                <div class="chips-legenda">

                    <span><i class="cor-qmg"></i> QMG</span>
                    <span><i class="cor-qm1"></i> QM1</span>
                    <span><i class="cor-qm2"></i> QM2</span>
                    <span><i class="cor-qm3"></i> QM3</span>
                    <span><i class="cor-qm4"></i> QM4</span>
                    <span><i class="cor-qm5"></i> QM5</span>
                    <span><i class="cor-qm6"></i> QM6</span>

                </div>

            </section>

        </div>


        <!-- HISTÓRICO -->
        <section class="card-relatorio secao-historico">

            <div class="titulo-grafico">
                <div>
                    <h3>Histórico de avaliações</h3>
                    <p>Consulte os resultados individuais de cada EDM.</p>
                </div>

                <span class="tag-grafico">3 registros</span>
            </div>

            <div class="tabela-container">

                <table class="tabela-historico">

                    <thead>
                        <tr>
                            <th>Avaliação</th>
                            <th>Data</th>
                            <th>IC</th>
                            <th>IMG</th>
                            <th>IP/IN</th>
                            <th>QMG</th>
                            <th>Classificação</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr onclick="abrirAvaliacao(3)" tabindex="0"
                            onkeydown="if(event.key==='Enter') abrirAvaliacao(3)">

                            <td><strong>#3</strong></td>
                            <td>15/11/2026</td>
                            <td>72</td>
                            <td>56</td>
                            <td>16</td>
                            <td>77,8</td>
                            <td>
                                <span class="classificacao-tabela">
                                    <i class="bolinha c-inferior"></i>
                                    Inferior
                                </span>
                            </td>
                            <td><i class="bi bi-chevron-right seta-tabela"></i></td>
                        </tr>

                        <tr onclick="abrirAvaliacao(2)" tabindex="0"
                            onkeydown="if(event.key==='Enter') abrirAvaliacao(2)">

                            <td><strong>#2</strong></td>
                            <td>15/08/2026</td>
                            <td>60</td>
                            <td>48</td>
                            <td>12</td>
                            <td>80,0</td>
                            <td>
                                <span class="classificacao-tabela">
                                    <i class="bolinha c-normal-baixo"></i>
                                    Normal baixo
                                </span>
                            </td>
                            <td><i class="bi bi-chevron-right seta-tabela"></i></td>
                        </tr>

                        <tr onclick="abrirAvaliacao(1)" tabindex="0"
                            onkeydown="if(event.key==='Enter') abrirAvaliacao(1)">

                            <td><strong>#1</strong></td>
                            <td>15/06/2026</td>
                            <td>48</td>
                            <td>42</td>
                            <td>6</td>
                            <td>87,5</td>
                            <td>
                                <span class="classificacao-tabela">
                                    <i class="bolinha c-normal-baixo"></i>
                                    Normal baixo
                                </span>
                            </td>
                            <td><i class="bi bi-chevron-right seta-tabela"></i></td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

        <footer class="rodape-relatorio">
            <span>Kids Map · Acompanhamento do desenvolvimento motor</span>
            <span>Relatório demonstrativo</span>
        </footer>

    </section>

</main>


<script src="../assets/javascript/principal/pacientes.js"></script>

<script>

function abrirAvaliacao(id) {
    window.location.href = "relatorio_avaliacao.php?id=" + id;
}

function confirmarExclusao() {

    const confirmar = confirm(
        "Tem certeza de que deseja excluir este paciente?"
    );

    if (confirmar) {
        alert("A exclusão deverá ser conectada à funcionalidade PHP.");
    }

}

</script>

</body>
</html>
