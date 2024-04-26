<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumindo API Pokemon com PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adicionando estilos personalizados, se necessário */
        body {
            padding: 20px;
        }
        pre {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Como consumir API no PHP com file_get_contents:</h1> 
    <h4>Explicação do Processo</h4>
    <p>Primeiro, buscar a API que você quer utilizar, nesse exemplo utilizei a PokeAPI.</p>

    <p>Com o link da API, jogar numa variável para podermos ter acesso, aqui chamei a variável apenas de <code>$url</code>.</p>

    <p>A variável <code>$url</code>, no caso, retorna uma URL onde há valores em JSON. Então é necessário pegar os dados da API com o <code>file_get_contents</code> e decodificar esse resultado com o <code>json_decode</code> e jogamos o resultado em outra variável para ficar melhor de se trabalhar.</p>

    <pre><code>$resultado = json_decode(file_get_contents($url));</code></pre>

    <p>Após isso, fiz um <code>foreach</code> para buscar <code>$resultado</code> a propriedade <code>results</code> (<code>$resultado-&gt;results</code>) que vem do objeto resultante da decodificação do JSON e joguei como uma nova variável chamada <code>$pokemon</code>.</p>

    <pre><code>foreach($resultado-&gt;results as $pokemon){
}</code></pre>

    <p>Dentro desse <code>foreach</code>, utilizei o <code>echo</code> e concatenei para buscar e apresentar os nomes dos Pokémon.</p>

    <pre><code>echo "Pokemon: " . $pokemon-&gt;name . "&lt;br&gt;";</code></pre>

    <p>Tentei pegar os dados individuais de cada Pokémon com o código:</p>

    <pre><code>$pokemon_detalhes = $pokemon-&gt;url;
echo $pokemon_detalhes; 
</code></pre>

    <p>Aqui o código se encontrava errado, pois de fato ele retornava uma URL, porém essa URL continha novos dados JSON de cada Pokémon separadamente. Por isso, foi necessário novamente fazer uma busca dos dados na API com o <code>file_get_contents</code> e decodificar com o <code>json_decode</code> antes de jogar na variável <code>$pokemon_detalhes</code>.</p>

    <pre><code>$pokemon_detalhes = json_decode(file_get_contents($pokemon-&gt;url));
// Faz uma requisição para obter os detalhes específicos do Pokémon da API e decodifica os dados JSON
</code></pre>

    <p>Só assim consegui acessar os dados individuais de cada Pokémon, como URL para gerar o sprite, o ID, etc.</p>
    <?php
        $url = "https://pokeapi.co/api/v2/pokemon/"; // Colocar a API em uma variavel
        // Utilizar file_get_contents para buscar os dados na API, passar a variavel como valor
        $resultado = json_decode(file_get_contents($url)); // json_decode em PHP é usada para decodificar uma string JSON e converter em uma variável PHP.
        // var_dump($resultado);

        foreach($resultado->results as $pokemon){ 
            /*na variavel $resultados(que é o que vem após json_decode decodificar) ele pega a propriedade
            results(de um objeto) e joga na variavel $pokemon */
            echo "<br>";
            echo "Pokemon: " . $pokemon->name . "<br>"; //Aqui busca a propriedade name do objeto pokemon

            /*$pokemon_detalhes = $pokemon->url;
              echo $pokemon_detalhes; 
              Aqui o código se encontrava errado pois de fato ele retornava uma url porem essa url continha novos dados JSON de cada pokemon separadamente por isso 
              foi necessario novamente fazer uma busca dos dados na api com o file_get_contents e decodificar com o json_decode antes de jogar na variavel $pokemon_detalhes
            */

            
            $pokemon_detalhes = json_decode(file_get_contents($pokemon->url));// Faz uma requisição para obter os detalhes específicos do Pokémon da API e decodifica os dados JSON
            $sprite_frontal = $pokemon_detalhes->sprites->front_default;
            $id_pokemon = $pokemon_detalhes->id;
            echo "Pokedex n°: " . $id_pokemon . ".";
            echo "<img src='{$sprite_frontal}' alt='Sprite {$pokemon->name}'>";
            echo "<hr>";
        };
    ?>
</body>
</html>