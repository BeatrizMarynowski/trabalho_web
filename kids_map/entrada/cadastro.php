<?php
include '../configdb.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && $_POST['nome'] != "") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $crefito = $_POST['crefito'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $consulta = $mysqli->prepare("INSERT INTO profissional (nome, email, crefito, senha) VALUES (?,?,?,?)");
        $consulta->bind_param("ssss", $nome, $email, $crefito, $senha);
        $consulta->execute();
        
        $consulta->close();
        header("Location: login.php");
        exit;
    } catch (Exception $e) {
        echo "<p>Ops! Ocorreu um erro ao cadastrar. Tente novamente mais tarde.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
      <link rel="icon" type="image/x-icon" href="../assets/imagens/icone.png">
    <title>Cadastro | Kids Map</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/entrada/estilo.css">
</head>
<body>

    
   <form id="formCadastro" action="#" method="post" enctype="multipart/form-data" novalidate>
      <div class="login-logo">
            <img src="../assets/imagens/logo.png" alt="Logo Kids Map">
        </div>

        <div class="login-divisor"></div> 
   <h1>Cadastro</h1>

    <div id="mensagemFinal"></div>

    <div class="campo">
      <label for="nome">Nome completo:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo">
      <span class="mensagem" id="erro-nome"></span>
    </div>

    <div class="campo">
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" placeholder="exemplo@email.com">
      <span class="mensagem" id="erro-email"></span>
    </div>

    <div class="campo">
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
      <span class="mensagem" id="erro-senha"></span>
    </div>

    <div class="campo">
      <label for="crefito">CREFITO:</label>
      <div style="display: flex; gap: 8px;">
        <input 
          type="text" 
          id="crefito" 
          name="crefito" 
          placeholder="Ex: 123456" 
          maxlength="6"
        >
        <select id="tipoCrefito" name="tipoCrefito">
          <option value="F">F (Fisioterapia)</option>
          <option value="TO">TO (Terapia Ocupacional)</option>
        </select>
      </div>
      <span class="mensagem" id="erro-crefito"></span>
    </div>

    <input type="submit" value="Enviar">
    <small>Seus dados estão protegidos de acordo com a LGPD</small>
  </form>

     <script src="../assets/javascript/3-cadastro.js" defer></script>

</body>
</html>