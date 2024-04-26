
# Consumindo API Pokemon

Nesta seção, documentei o processo que segui e as lições que aprendi ao criar este projeto simples de busca de API.

Embora o conceito pareça simples, a falta de experiência tornou a compreensão um pouco desafiadora inicialmente.
No entanto, ao entender os conceitos e tomar notas claras, estou confiante de que as ideias permanecerão claras e úteis para projetos futuros.


## Explicação do Processo


Primeiro, buscar a API que você quer utilizar, nesse exemplo utilizei a PokeAPI.

Com o link da API, jogar numa variável para podermos ter acesso, aqui chamei a variável apenas de `$url`.

A variável `$url`, no caso, retorna uma URL onde há valores em JSON. Então é necessário pegar os dados da API com o `file_get_contents` e decodificar esse resultado com o `json_decode` e jogamos o resultado em outra variável para ficar melhor de se trabalhar.

`$resultado = json_decode(file_get_contents($url));`

Após isso, fiz um `foreach` para buscar `$resultado` a propriedade results (`$resultado->results`) que vem do objeto resultante da decodificação do JSON e joguei como uma nova variável chamada `$pokemon`.

`foreach($resultado->results as $pokemon){
}`

Dentro desse `foreach`, utilizei o `echo` e concatenei para buscar e apresentar os nomes dos Pokémon.

`echo "Pokemon: " . $pokemon->name . "<br>";`

Tentei pegar os dados individuais de cada Pokémon com o código:

`$pokemon_detalhes = $pokemon->url;
echo $pokemon_detalhes;`

Aqui o código se encontrava errado, pois de fato ele retornava uma URL, porém essa URL continha novos dados JSON de cada Pokémon separadamente. Por isso, foi necessário novamente fazer uma busca dos dados na API com o `file_get_contents` e decodificar com o `json_decode` antes de jogar na variável `$pokemon_detalhes`.

`$pokemon_detalhes = json_decode(file_get_contents($pokemon->url));
// Faz uma requisição para obter os detalhes específicos do Pokémon da API e decodifica os dados JSON`

Só assim consegui acessar os dados individuais de cada Pokémon, como URL para gerar o sprite, o ID, etc.

