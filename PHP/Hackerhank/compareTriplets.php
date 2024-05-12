<?php

/*
 * Complete a função 'compareTriplets' abaixo.
 *
 * A função deve retornar um ARRAY DE INTEIROS.
 * A função aceita os seguintes parâmetros:
 *  1. INTEGER_ARRAY a
 *  2. INTEGER_ARRAY b
 */


function compareTriplets($a, $b) { //$a e $b são arrays
    $Alice = 0; //Inicia as variaveis de pontações de alice e bob com zero pontos
    $Bob = 0;
    if (count($a) === count($b)) { //faz verificação de elementos em cada um dos arrays para verificar se os 2 tem o mesmo tamanho
        $tamanho = count($a);    /**você atribui o valor de count($a) (ou count($b), já que eles têm o mesmo tamanho) a uma variável $tamanho. 
        Pois assim se o array tem 3 elementos ao usar o for a seguir repitira o loop 3 vezes, se tiver 5 elementos, 5 vezes.. */
        
        for($i=0; $i < $tamanho; $i++){ // Dentro do loop, você compara os elementos correspondentes de $a e $b na posição $i.
        if($a[$i] > $b[$i]){//Se o elemento de $a for maior que o elemento de $b, Alice recebe um ponto incrementando $Alice.
            $Alice++;
        }elseif($a[$i] < $b[$i]){//Se o elemento de $a for menor que o elemento de $b, Bob recebe um ponto incrementando $Bob.
            $Bob++;
        }
    };
}
return [$Alice, $Bob];
}
$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$a_temp = rtrim(fgets(STDIN));

$a = array_map('intval', preg_split('/ /', $a_temp, -1, PREG_SPLIT_NO_EMPTY));

$b_temp = rtrim(fgets(STDIN));

$b = array_map('intval', preg_split('/ /', $b_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = compareTriplets($a, $b);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($fptr);