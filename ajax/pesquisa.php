<?php

$pesquisa = $_POST['pesquisa'];

$handle = fopen("filmes.csv", "r");

$header = fgetcsv($handle, 10000, ";");

while ($row = fgetcsv($handle, 10000, ";")) {
    $nota[] = array_combine($header, $row);
}

fclose($handle);

echo json_encode($nota[1]);


?>