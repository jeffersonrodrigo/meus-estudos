<?php
    // Verifica se o parâmetro 'nome_livro' foi passado na URL
    if(!isset($_GET['nome_livro'])){
        header("Location: index.php"); // Redireciona para a página index.php se o parâmetro não estiver presente
        exit;
    }

    // Prepara o valor para a consulta SQL, adicionando '%' antes e depois do valor do usuário
    $nome = "%".trim($_GET['nome_livro'])."%"; 

    // Cria uma nova conexão com o banco de dados usando PDO
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=sistemabuscalivro', 'root', 'root1234'); 

    // Prepara a consulta SQL para buscar livros cujo nome contenha o valor de $nome
    $sth = $dbh->prepare('SELECT * FROM `livro` WHERE `nome` LIKE :nome');

    // Vincula o valor de $nome ao parâmetro :nome na consulta SQL
    // PDO::PARAM_STR indica que o parâmetro é uma string
    //bindParam(): Método que associa um valor a um parâmetro na consulta SQL preparada, permitindo que esse valor seja inserido de forma segura.
    $sth->bindParam(':nome', $nome, PDO::PARAM_STR);

    // Executa a consulta preparada
    $sth->execute();

    // Busca todos os resultados da consulta e retorna como um array associativo
    // PDO::FETCH_ASSOC indica que o array resultante deve usar os nomes das colunas como chaves
    $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    // O código abaixo foi comentado para evitar a exibição dos resultados
    // echo "<pre>";
    // print_r($resultados);
    // exit;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da busca</title>
</head>
<body>
    <h2>Resultado da busca</h2>
    <?php
    if(count($resultados)) {
        foreach($resultados as $resultado) {
    ?>
    <label><?php echo $resultado['id']; ?> - <?php echo $resultado['nome']; ?></label>
    <br>
    <?php
    } } else {
    ?>
    <label>Não foram encontrados resultados</label>
    <?php }
    ?>
</body>
</html>