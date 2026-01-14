<?php
echo "<h2>NUMERI</h2>";
$n_pos = 5;
$n_neg = -5;
$n_frat = 2/3;

echo "abs: " . abs($n_neg) . "<br>"; // valore assoluto
echo "ceil: " . ceil($n_frat) . "<br>"; // arrotonda le frazioni all'intero superiore
echo "floor: " . floor($n_frat) . "<br>"; // arrotonda le frazioni all'intero inferiore
echo "round: " . round($n_frat) . "<br>"; // arrotonda un float
echo "mt_rand: " . mt_rand(1, 10) . "<br>"; // genera un numero casuale tramite Mersenne Twister Random Number Generator
echo "rand: " . rand(0, 10) . "<br>"; // genera un numero intero casuale
echo "min: " . min($n_pos, $n_neg) . "<br>";
echo "max: " . max($n_pos, $n_neg) . "<br>";
echo "sqrt: " . sqrt($n_pos) . "<br>"; // radice quadrata
echo "pow: " . pow($n_pos, 2) . "<br>"; // potenza
echo "intdiv: " . intdiv($n_pos, $n_neg) . "<br>"; // integer division
echo "number_format: " . number_format($n_pos, 2) . "<br>"; // formato del numero
echo "is_numeric: " . is_numeric($n_pos) . "<br>"; // controlla che la variabile sia numerica
echo "is_int: " . is_int($n_pos) . "<br>";
echo "is_float: " . is_float($n_pos) . "<br>";
echo "intval: " . intval($n_frat) . "<br>"; // prende il valore intero di una variabile
echo "floatval: " . floatval($n_frat) . "<br>"; // prende il valore float di una variabile
echo "pi: " . pi() . "<br>"; // pi greco
echo "log: " . log($n_pos) . "<br>"; // logaritmo naturale
echo "exp: " . exp($n_pos) . "<br>"; // esponente di e