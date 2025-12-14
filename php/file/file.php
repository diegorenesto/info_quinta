<?php
echo getcwd() . "<br>";
echo "Dir separator: " . DIRECTORY_SEPARATOR . "<br>";

$path = getcwd();
echo "Il file prova.txt esiste? ";
echo is_file($path . DIRECTORY_SEPARATOR . "txt/prova.txt") ? "true" : "false";
echo "<br>La directory txt esiste? ";
echo is_dir($path . DIRECTORY_SEPARATOR . "txt") ? "true" : "false";

$items = scandir($path . DIRECTORY_SEPARATOR . "txt");
echo "<h1>File nella dir: </h1>";
echo "<ul>";
foreach ($items as $item) {
    echo "<li>$item</li>";
}
echo "</ul>";

echo "<br><br>";
$file1 = fopen("txt/prova.txt", "w");
fwrite($file1, "diegorenesto, fwrite da file.php");
fclose($file1);

/**
 * @fopen e @fwrite di un'array associativo annidato in un nuovo file
 * @date 12 Dicembre 2025
 */
$classe = [
    "studente1" => ["Diego", "Renesto", 9],
    "studente2" => ["Simone", "Pizzo", 2],
    "studente3" => ["Nicolò", "Zanforlin", 4],
    "studente4" => ["Francesco", "Bazaj", 7],
    "studente5" => ["Mattia", "Pavarin", 8]
];

$file = fopen("txt/voti.txt", "w");
foreach ($classe as $key => $stud) {
    $line = $key . "@" . implode(" - ", $stud) . PHP_EOL; // End Of Line
    fwrite($file, $line); // o file_put_contents() --(fwrite si usa nei file grandi)
}
fclose($file);

$dati = [];
$file = fopen("txt/voti.txt", "r");
while (($line = fgets($file)) !== false) {
    $dati[] = trim($line);
}
fclose($file);
foreach ($dati as $data) {
    echo $data . "<br>";
}

echo "<br>";
// EXPLODE
$frase = "oggi è una bella giornata";
$arr_frase = explode(" ", $frase);
foreach ($arr_frase as $parola) {
    echo $parola . "<br>";
}

echo "<br>Stampa di un elemento dell'array associativo annidato<br>";
$stud = explode(", ", $dati[3]);
foreach ($stud as $studente) {
    echo $studente . "<br>";
}
