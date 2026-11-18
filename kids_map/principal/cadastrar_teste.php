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
            $consulta->bind_param("ssiii", $emailprofissional, $cpf, $atividadeId, $resultado, $avaliacaoid);
            $consulta->execute();
        }
        $consulta->close();

        header("Location: teste.php");
        exit;
    } catch (Exception $e) {
        echo "<p>" . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Cadastrar teste | Kids Map</title>
        <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
    </head>
    <body>
        <form method="post" action="">
            <label for='cpf'>cpf paciente</label>
            <select id='cpf' name='cpf' required>
                <option value="">Selecione...</option>
                <?php
                foreach ($pacientes_resultado as $opcoes) {
                    echo "<option value='" . $opcoes['cpf'] . "'>". $opcoes['nome'] . " (" . $opcoes['cpf'] . ")". "</option>";
                }
                ?>
            </select>
            <datalist id="opcoes">
                <option value="0">
                <option value="1">
            </datalist>
            <?php
            for ($i = 1; $i <= 42; $i++) {
                if ($i == 31 || $i == 32) continue;

                $id   = "atividade_$i";
                $name = "resultado[$i]";

                echo "<label for='$id'>Atividade $i</label>";
                echo "<input type='text' id='$id' name='$name' list='opcoes' maxlength='1' required>";    
            }
            ?>
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>