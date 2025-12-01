<?php
echo "Funzioni Array Associativi PHP<br>";
$arr = [5, 10, 2, 8, 40];
$arr2 = [1, 2, 3, 4];

echo "<pre>";
// array_keys() stampa gli indici dell'array
$keys = array_keys($arr);
print_r($keys);

echo "==================<br>array_values<br>";
// array_values stampa i valori dell'array
$values = array_values($arr);
print_r($values);


echo "==================<br>array_key_exist<br>";
// array_key_exists controlla se la chiave inserita esiste, ritorna un booleano
if (array_key_exists(3, $values))
    echo "esiste<br>";
else
    echo "NON esiste<br>";

echo "==================<br>isset<br>";
// isset ritorna vero se NON è null
if (isset($arr[3]))
    echo "NON NULL<br>";
else
    echo "NULL<br>";

echo "==================<br>in_array<br>";
// in_array controlla che un valore sia contenuto in un array
if (in_array(5, $arr))
    echo "è presente<br>";
else
    echo "NON è presente<br>";

echo "==================<br>array_search<br>";
// array_search cerca un valore e ne ritorna l'indice
$search = array_search(8, $arr);
print_r($search);
echo "<br>";

echo "==================<br>unset<br>";
// unset elimina un valore (indice) da un array
unset($arr[3]);
print_r($arr);

echo "==================<br>array_merge<br>";
// array_merge fa il merge di due array
$merged = array_merge($arr, $arr2);
print_r($merged);

echo "==================<br>asort<br>";
// asort ordina un'array mantenendo gli indici
asort($arr);
print_r($arr);

echo "==================<br>arsort<br>";
// arsort reverse di asort, mantiene a sua volta gli indici
arsort($arr);
print_r($arr);

echo "==================<br>ksort<br>";
// ksort ordina in maniera crescente gli indici di un'array, e ne elenca i corrispondenti valori
ksort($arr);
print_r($arr);

echo "==================<br>krsort<br>";
// krsort reverse ksort
krsort($arr);
print_r($arr);

echo "==================<br>array_map<br>";
// array_map applica una funzione di callback
$mapped = array_map(function ($n) {
    return $n * 2;
}, $arr);
print_r($mapped);

echo "==================<br>array_filter<br>";
// array_filter filtra gli elementi di un array tramite una funzione di callback
$filter = array_filter($arr, function ($n) {
    return $n > 20;
});
print_r($filter);

echo "==================<br>array_walk<br>";
// array_walk applica una funzione a ogni elemento dell array
array_walk($arr, function (&$n) {
    $n = $n * 10;
});
print_r($arr);

echo "==================<br>array_slice<br>";
// array_slice prende degli elementi dell'array da offset a length (e riassegna gli indici)
$slice = array_slice($arr, 0, 2);
print_r($slice);

echo "==================<br>array_splice<br>";
// array_splice rimuove una porzione dell'array e la sostituisce con altro
array_splice($arr, 2, 5, 22);
print_r($arr);

echo "</pre>";