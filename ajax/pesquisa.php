<?php

include("../config.php");

$pesquisa = $_POST['pesquisa']; // Por enquanto não recebe nada //
$coluna = $_POST['select'];

$dicionarioColunas = [
    'id'             => 'id',
    'titulo'         => 'title',
    'lancamento'     => 'release_date',
    'lingua'         => 'original_language',
    'votos_medios'   => 'vote_average',
    "votos_contagem" => 'vote_count',
    "popularidade"   => 'popularity',
    'resumo'         => 'overview',
    'orcamento'      => 'budget',
    'lucro'          => 'revenue',
    'tempo'          => 'runtime',
    'subtitulo'      => 'tagline'
];

$resultados = array();

$handle = fopen("filmes.csv", "r");

$header = fgetcsv($handle, 10000, ";");

while ($row = fgetcsv($handle, 10000, ";")) {
    $array[] = array_combine($header, $row);
}

fclose($handle);

// deixa tudo em utf8 //
array_walk_recursive($array, function (&$item) {
    $item = mb_convert_encoding($item, 'UTF-8');
});

$array = sortearPorColuna($array, $dicionarioColunas[$coluna]);
$positions = buscaBinaria($array, $pesquisa, $dicionarioColunas[$coluna]);

foreach($positions as $position){
    $resultados[] = $array[$position];
}

echo json_encode($resultados);
?>