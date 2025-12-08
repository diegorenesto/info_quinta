<?php
echo getcwd() . "<br>";
echo "Dir separator: " . DIRECTORY_SEPARATOR . "<br>";

$path = getcwd();
echo "Il file prova.txt esiste? " . is_file($path.DIRECTORY_SEPARATOR."prova.txt") ? "true" : "false";
echo "<br>La directory dir esiste? " . is_dir($path.DIRECTORY_SEPARATOR."dir") ? "true" : "false";

$items = scandir($path.DIRECTORY_SEPARATOR."dir");
echo "<h1>File nella dir: </h1>";
echo "<ul>";
foreach ($items as $item) {
    echo "<li>$item</li>";
}
echo "</ul>";

echo "<br><br>";
$file1 = fopen("prova.txt", "w");
fwrite($file1, "diegorenesto, fwrite da file.php");
fclose($file1);