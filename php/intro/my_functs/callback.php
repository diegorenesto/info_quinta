<?php

/* funzioni di callback:
 * passata per argomento
 * chiamata da un'altra funzione che può essere utilizzata in 2 momenti
 * quando si verifica un evento
 * Sono utili perchè possono eseguire funzioni intere quando si vuole */

function esegui($nome_funct): void
{
    $nome_funct();
}

function saluta(): void
{
    echo "buenos dia";
}

function applica($callback, $par) // aggiunta di un parametro
{
    return $callback($par);
}

function doppio($val): int
{
    return $val * 2;
}

// inline
$doppio = fn($x) => $x * 2;

// Callback con funzione anonima
echo "Callback con funzione anonima (n+2): " . applica(function ($x) {
        return $x + 2;
    }, 10) . "<br>";


// la prima usata perché la userò di nuovo nel codice (funzione con nome definito)
// la seconda è più veloce (funzioni momentanee e senza nome)
// STAMPA FUNZIONI
echo "<br>";
esegui("saluta");

echo "<br>";
echo applica("doppio", 5);

echo "<br>";
echo doppio(4);