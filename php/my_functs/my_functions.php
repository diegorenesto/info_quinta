<?php

// impostazione che permette all'operatore di conoscere il tipo di dato in ingresso e uscita (riuscendo anche a dare più tipi di dato ai parametri)
function somma(int|float $a, int|float $b): int|float
{
    return $a + $b;
}


function stampa(int|string $var): void
{
    echo "Hai passato " . $var;
}


function saluta(?string $nome): string //accetta o null o string
{
    return "Ciao " . ($nome ?? "Ospite") . "<br>"; // se null restituisce "Ospite"
}


$var = 10;
function funct(&$var)
{
    $var = $var + 1;
}


function somma_totale(...$numeri): int|float
{
    return array_sum($numeri);
}


// TEST FUNZIONI
echo "somma()<br>";
echo "Somma tra 51 e 46.3 = " . somma(51, 46.3) . "<br><br>";

echo "stampa()<br>";
stampa(2356);
echo "<br><br>";

echo "saluta()<br>";
echo saluta("Otto");
echo saluta(null) . "<br>";

echo "funct()<br>";
echo "var prima: " . $var . "<br>";
funct($var);
echo "var dopo: " . $var . "<br><br>";

echo "somma_totale()<br>";
echo "Somma totale tra 1, 4, 2, 3, 7 = " . somma_totale(1, 4, 2, 3, 7);