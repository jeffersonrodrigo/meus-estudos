<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de CEP</title>
</head>
<body>
    <h1>Buscar Endereço pelo CEP</h1>
    <form method="post" action="">
        <label for="cep">Digite o CEP:</label>
        <input type="text" id="cep" name="cep" required>
        <input type="submit" value="Buscar">
    </form>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){ //se o $_SERVER verificar que o metodo requisitado(http) for o post.
    $cep = $_POST['cep']; //Pega o que foi enviado no input de texto e armazena em $cep
    buscaCep($cep);

  }

  function buscaCep($cep){
    $url = "https://viacep.com.br/ws/$cep/json/";

    $resposta = @file_get_contents($url); //le o texto da string
    $dados = json_decode($resposta, true);

    if(isset($dados['erro']) || empty($dados)) {
        echo "<p>Cep nao encontrado</p>";
    } else {
        echo "<h2>Cep e DDD encontrado: </h2>";
        echo "<p><b>Estado: </b>" . htmlspecialchars($dados['uf']) . "</p>";
        echo "<p><b>Cidade: </b>" . htmlspecialchars($dados['localidade']) . "</p>";
        echo "<p><b>DDD: </b>" . htmlspecialchars($dados['ddd']) . "</p>";
        echo "<p><b>Bairro: </b>" . htmlspecialchars($dados['bairro']) . "</p>";
        echo "<p><b>Rua/Logradouro: </b>" . htmlspecialchars($dados['logradouro']) . "</p>";
        echo "<p></p>";
    }
    
}
?>
</body>
</html>
<p></p>