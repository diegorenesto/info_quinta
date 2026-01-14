<?php
$persone = [
    "p1" => ["nome1", "cognome1"],
    "p2" => ["nome2", "cognome2"],
    "p3" => ["nome3", "cognome3"]
];

$file_w = fopen("txt/test_funzioni.txt", "w");
foreach ($persone as $key => $value) {
    $line = $key . "@" . implode(" ", $value) . PHP_EOL;
    fwrite($file_w, $line);
}
fclose($file_w);

// EXPLODE
$frase = "ciao oggi è una bella giornata";
$arr_frase = explode(" ", $frase);
foreach ($arr_frase as $parola)
    echo $parola . "<br>";
echo "<br>";

// FGETS
echo "Stampa fgets: ";
$file_r = fopen("txt/test_funzioni.txt", "r");
while (($buffer = fgets($file_r)) !== false) {
    echo $buffer;
}
fclose($file_r);
echo "<br>";

// FILE_PUT_CONTENTS
$put_test = "test file_put_contents da functions.php";
file_put_contents("txt/test_put.txt", $put_test);

// FILE_GET_CONTENTS
echo "Stampa file_get_contents: ";
$get_test = file_get_contents("txt/test_put.txt");
echo $get_test;