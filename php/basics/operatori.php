<?php
echo "Operatore ternario (o condizionale)<br>";
$x = 5;

$risultato = $x > 6 ? "vabien" : "mal";
echo $risultato;

// OPERATORE COALESCING
echo "<br><br>Operatore coalescing<br>";
$risultato2 = $nome ?? "defualt"; // se è NULL da default
echo $risultato2;

// OPERATORE SPACESHIP
echo "<br><br>Operatore spaceship<br>";
$y = 7;
$z = 4;
echo $y <=> $z;
echo "<br><br><br>";