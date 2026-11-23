
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
                <a class="nav-link ativo" href="teste.php"><i class="bi bi-clipboard-check"></i><span>Avaliações</span></a>
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


    <!-- CONTEÚDO PRINCIPAL -->
    <main class="conteudo-relatorio">

        <!-- CABEÇALHO -->
        <header class="topo-relatorio">

            <div>
                <a href="pacientes.php" class="voltar">
                    <i class="bi bi-arrow-left"></i>
                    Voltar aos pacientes
                </a>

                <h1>Relatório geral</h1>

            </div>

          <div class="acoes-relatorio">

            <a href="editar_relatorio.php" class="btn-acao btn-editar">
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


        <!-- IDENTIFICAÇÃO -->
        <section class="identificacao">

            <div class="identificacao-principal">
                <div class="nome-crianca">
                    <span class="legenda">PACIENTE</span>
                    <h2>Ana Maria Silva</h2>
   
                </div>
                     <div class="classificacao-qmg">
                    <span>Classificação</span>
                    <strong>Normal médio</strong>
                </div>
                

            </div>

            <div class="dados-crianca">

                <div class="dado">
                    <span>Data de nascimento</span>
                    <strong>10/04/2018</strong>
                </div>

                <div class="dado">
                    <span>Idade atual</span>
                    <strong>8 anos e 7 meses</strong>
                </div>

                <div class="dado">
                    <span>Data da avaliações</span>
                    <strong>18/52</strong>
                </div>

                <div class="dado">
                    <span>Nome do responsável</span>
                    <strong>Adriano</strong>
                </div>

            </div>

        </section>


        <!-- INDICADORES GERAIS -->
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

                    <strong>103</strong>
                    <p>Idade cronológica</p>
                    <small>Em meses</small>
                </div>

                <div class="card-indicador roxo">
                    <div class="indicador-topo">
                        <span>IMG</span>
                        <i class="bi bi-person-arms-up"></i>
                    </div>

                    <strong>96</strong>
                    <p>Idade motora geral</p>
                    <small>Em meses</small>
                </div>

                <div class="card-indicador azul">
                    <div class="indicador-topo">
                        <span>QM</span>
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <strong>93,2</strong>
                    <p>Quociente motor geral</p>
                    <small>Resultado geral</small>
                </div>

                <div class="card-indicador verde">
                    <div class="indicador-topo">
                        <span>IP/IN</span>
                        <i class="bi bi-clipboard2-check"></i>
                    </div>

                    <strong>03</strong>
                    <p>Idade Positiva / Idade Negativa</p>
                
                </div>

             

            </div>

        </section>



        <!-- RESULTADOS DETALHADOS -->
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
                            <td>78 meses</td>
                            <td>103 meses</td>
                            <td><span class="resultado-negativo">-25 meses</span></td>
                        </tr>

                        <tr>
                            <td>Motricidade global</td>
                            <td>88 meses</td>
                            <td>103 meses</td>
                            <td><span class="resultado-negativo">-15 meses</span></td>
                        </tr>

                        <tr>
                            <td>Equilíbrio</td>
                            <td>98 meses</td>
                            <td>103 meses</td>
                            <td><span class="resultado-negativo">-5 meses</span></td>
                        </tr>

                        <tr>
                            <td>Esquema corporal</td>
                            <td>93 meses</td>
                            <td>103 meses</td>
                            <td><span class="resultado-negativo">-10 meses</span></td>
                        </tr>

                        <tr>
                            <td>Organização espacial</td>
                            <td>82 meses</td>
                            <td>103 meses</td>
                            <td><span class="resultado-negativo">-21 meses</span></td>
                        </tr>

                        <tr>
                            <td>Organização temporal</td>
                            <td>91 meses</td>
                            <td>103 meses</td>
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
