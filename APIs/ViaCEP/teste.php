<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar CEP</title>
</head>
<body>
    <h1>Buscando CEPs</h1>
    <form method="post" action="">
        <label for="cep">Digite seu cep:</label>
        <input type="text" name="cep" id="cep" required>
        <input type="submit" value="Buscar">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $cep = $_POST['cep'];
            encontrarEndereco($cep);
        }

        function encontrarEndereco($cep) {
            $url = "https://viacep.com.br/ws/$cep/json/";

            $resposta = @file_get_contents($url);
            $dados = json_decode($resposta, true);

            if(isset($dados['erro']) || empty($dados)){
                echo "<h2>Dados não encontrados.</h2><p>Verifique se o CEP digitado está correto</p>";
            } else {
                echo "<h2>Dados encontrados</h2>";
                echo "<p><b>Estado: </b>". htmlspecialchars($dados['estado']) ."</p>";
                echo "<p><b>Cidade: </b>". htmlspecialchars($dados['localidade']) ."</p>";
                echo "<p><b>Bairro: </b>". htmlspecialchars($dados['bairro']) ."</p>";
                echo "<p><b>Logradouro: </b>". htmlspecialchars($dados['logradouro']) ."</p>";
                echo "<p><b>Complemento: </b>". htmlspecialchars($dados['complemento']) ."</p>";

            }
        }
    ?>
</body>
</html><p><b></b></p>