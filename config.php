<?php 
ini_set('memory_limit', 258000000);

function sortearPorColuna($array, $coluna = "title") {
    $size = count($array); // Tamanho do array //
    
    if ($size <= 1) { // Se só achou 1 vamos retornar //
        return $array;
    }
    
    $pivot = $array[0][$coluna]; // Escolhemos um pivot //

    // Cria dois arrays vazios
    $esquerda = array();
    $direita = array();
    
    for ($i = 1; $i < $size; $i++) {
        if ($array[$i][$coluna] < $pivot) {
            $esquerda[] = $array[$i];
        } else {
            $direita[] = $array[$i];
        }
    }
    
    return array_merge(sortearPorColuna($esquerda, $coluna), array($array[0]), sortearPorColuna($direita, $coluna));
}

function buscaBinaria($array, $alvo, $coluna = 'title') {
    $esquerda = 0;
    $direita = count($array);
    $retorno = array();

    while ($esquerda <= $direita) {
        $meio = floor(($esquerda + $direita) / 2);

        if (comecaCom(strtolower($array[$meio][$coluna]), strtolower($alvo))) {
            $retorno[] = $meio;  // Encontrado //
        }

        if (strtolower($array[$meio][$coluna]) < strtolower($alvo)) {
            $esquerda = $meio + 1;  // Procurar à direita //
        } else {
            $direita = $meio - 1;  // Procurar à esquerda /
        }
    }

    return $retorno;  // Retorno //
}

function comecaCom($string, $prefixo) {
    $stringMinuscula = strtolower($string);
    $prefixoMinusculo = strtolower($prefixo);

    echo "String Minuscula: ".$stringMinuscula." Prefixo Minusculo: ".$prefixoMinusculo."<br>";
    
    return strpos($stringMinuscula, $prefixoMinusculo) === 0;
}

?>