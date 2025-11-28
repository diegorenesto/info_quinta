<?php
echo "<h1>Introduzione a PHP</h1>";
echo "<hr>";

// ================= VARIABILI ================= //
echo "<h2>Variabili</h2>";

$var = 10;
$var2 = 2.5;

echo "<p><strong>Prima variabile:</strong> $var</p>";
echo "<pre>";
var_dump($var);
echo "</pre>";

echo "<p><strong>Seconda variabile:</strong> $var2</p>";
echo "<pre>";
var_dump($var2);
echo "</pre>";

echo "<p><strong>Costante:</strong> Pi Greco = " . M_PI . "</p>";
echo "<hr>";

// ================= ARRAY ================= //
echo "<h2>Array</h2>";

$arr = [3, 6, 42];

echo "<p><strong>Primo elemento:</strong> $arr[0]</p>";

echo "<p><strong>Array completo (foreach):</strong></p><pre>";
foreach ($arr as $elemento) {
    echo $elemento . " ";
}
echo "</pre>";

echo "<p><strong>Array completo (implode):</strong> " . implode(", ", $arr) . "</p>";

echo "<p><strong>Array completo (print_r):</strong></p><pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";

// ================= AGGIUNGI ================= //
echo "<h2>Aggiungere elementi all'array</h2>";

array_push($arr, 105);
echo "<p>Aggiungo 105:</p>";
echo "<p>" . implode(", ", $arr) . "</p>";
echo "<hr>";

// ================= CANCELLA ================= //
echo "<h2>Cancellare elementi</h2>";

array_pop($arr);
echo "<p>Dopo la rimozione dell'ultimo elemento:</p>";
echo "<p>" . implode(", ", $arr) . "</p>";
echo "<hr>";

// ================= CONTROLLO ================= //
echo "<h2>Controllo valori</h2>";

if (in_array(3, $arr)) {
    echo "<p><span style='color: green;'>Il valore 3 è presente</span></p>";
} else {
    echo "<p><span style='color: red;'>Il valore 3 è assente</span></p>";
}
echo "<hr>";

// ================= ORDINAMENTO ================= //
echo "<h2>Ordinamento dell'array</h2>";

sort($arr);
echo "<p><strong>Array in ordine crescente:</strong> " . implode(", ", $arr) . "</p>";

rsort($arr);
echo "<p><strong>Array in ordine decrescente:</strong> " . implode(", ", $arr) . "</p>";