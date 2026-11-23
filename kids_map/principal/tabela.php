
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Relatório Geral | Kids Map</title>

    <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/principal/nav.css">
    <link rel="stylesheet" href="../assets/css/principal/tabela.css">
</head>

<body>
    <!-- CONTEÚDO PRINCIPAL -->
    <main class="conteudo-relatorio">

       

        <!-- GRÁFICOS -->
        <section class="secao">

            <div class="titulo-secao">
                <div>
                    <span class="legenda">ANÁLISE DOS RESULTADOS</span>
                    <h2>Desempenho motor</h2>
                    <p>Comparação entre as áreas avaliadas.</p>
                </div>
            </div>


            <div class="graficos-grid">

                <!-- GRÁFICO POR ÁREA -->
                <div class="card-grafico">

                    <h3>Idade motora por área</h3>

                    <p class="descricao">
                        Comparação da idade motora com a idade cronológica.
                    </p>

                    <div class="legenda-grafico">
                        <span><i class="bolinha rosa-bg"></i> Idade motora</span>
                        <span><i class="bolinha roxo-bg"></i> Idade cronológica</span>
                    </div>

                    <div class="grafico-barras">

                        <div class="linha-grafico">
                            <span>Motricidade fina</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:75%">78</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                        <div class="linha-grafico">
                            <span>Motricidade global</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:85%">88</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                        <div class="linha-grafico">
                            <span>Equilíbrio</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:95%">98</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                        <div class="linha-grafico">
                            <span>Esquema corporal</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:90%">93</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                        <div class="linha-grafico">
                            <span>Organização espacial</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:80%">82</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                        <div class="linha-grafico">
                            <span>Organização temporal</span>
                            <div class="barras">
                                <div class="barra rosa-barra" style="width:88%">91</div>
                                <div class="barra roxa-barra" style="width:99%">103</div>
                            </div>
                        </div>

                    </div>

                    <div class="observacao-grafico">
                        <i class="bi bi-info-circle"></i>
                        Valores ilustrativos em meses.
                    </div>

                </div>


                <!-- EVOLUÇÃO -->
                <div class="card-grafico">

                    <h3>Evolução das avaliações</h3>

                    <p class="descricao">
                        Acompanhamento da idade motora geral ao longo do tempo.
                    </p>

                    <div class="legenda-grafico">
                        <span><i class="bolinha rosa-bg"></i> Idade motora geral</span>
                    </div>

                    <div class="grafico-evolucao">

                        <div class="eixo-vertical">
                            <span>100</span>
                            <span>90</span>
                            <span>80</span>
                            <span>70</span>
                        </div>

                        <div class="area-grafico">

                            <div class="grade-grafico">
                                <i></i>
                                <i></i>
                                <i></i>
                                <i></i>
                            </div>

                            <div class="colunas-evolucao">

                                <div class="coluna">
                                    <div class="barra-evolucao" style="height:55%"></div>
                                    <strong>78</strong>
                                    <span>Mar/26</span>
                                </div>

                                <div class="coluna">
                                    <div class="barra-evolucao" style="height:72%"></div>
                                    <strong>88</strong>
                                    <span>Jul/26</span>
                                </div>

                                <div class="coluna">
                                    <div class="barra-evolucao" style="height:85%"></div>
                                    <strong>96</strong>
                                    <span>Nov/26</span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="observacao-grafico">
                        <i class="bi bi-info-circle"></i>
                        Valores ilustrativos em meses.
                    </div>

                </div>

            </div>

        </section>


        

    </main>

</body>
</html>
