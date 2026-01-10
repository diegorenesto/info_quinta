<?php
// PHP-1
// Ripasso degli operatori, delle strutture dati e delle funzioni fondamentali (scelta personale tra quelli visti a lezione).

//$a = 5; $b = 2; echo $a + $b;
//isset ritorna vero se NON è null; is_null ritorna vero se è null; empty ritorna vero se è 0 o null

$str = "ripasso in itinere";
echo $str . "<br>";
//strlen, strrev, strtoupper, strtolower, ucfirst (upper case), ucwords (ucfirst di tutte le parole)
//trim rimuove spazi o caratteri speciali
//explode separa delle stringhe da una stringa
//implode unisce elementi di un'array in una stringa

echo "operatori, ";
//operatore condizionale condition ? opz1 : opz2
//operatore coalescing condition ?? default -> se è NULL restituisce default
//operatore spaceship a <=> b ritorna: 1 a>b, 0 a=b, -1 a<b

echo "numeri, ";
//abs valore assoluto
//ceil arrotonda le frazioni all'intero superiore; floor all'inferiore
//round arrotonda un float
//mt_rand, rand, min, max, sqrt, pow, pi, log, exp
//is_numeric, is_int, is_float

echo "date_time, ";
$date = new DateTime();
//data di oggi $data->format("d/m/y")
//ora di adesso $data->format("H:i:s")
//data +2 giorni $data->modify("+2 days")
$intervallo = new DateInterval("P1Y3M4DT2H3M4S"); //1 anno 3 mesi 4 giorni, 2h 3m 4s

echo "array_functions, ";
$arr = [1, 2, 3, 4, 5];
//array_values, array_key_exists, in_array, array_search
//isset torna vero se NON è null
//unset elimina un valore
//asort ordina mantenendo gli indici; arsort reverse asort
//ksort ordina in maniera crescente; krsort reverse ksort
//array_filter filtra gli elementi di un array tramite una funzione

echo "file, ";
$pat = getcwd();
//is_file, is_dir
//fopen, fwrite, fclose, fgets
//file_put_contents, file_get_contents

echo "array associativi, ";
$associativo = [
    "nome" => "Diego",
    "cognome" => "Renesto",
    "eta" => 18
];

echo "array associativi annidati, ";
$annidato = [
    "persona1" => [
        "nome" => "Diego",
        "cognome" => "Renesto"
    ],
    "persona2" => [
        "nome" => "Camillo",
        "cognome" => "Benso"
    ]
];

echo "regex, ";
// https://regex101.com
//preg_match: ^ $ [num] [char] [^num] (?) (*) (+) (char|num, *) (#ignore)

echo "my_functs";
//function somma(int|float $a, int|float $b) : int|float
//function funct(?string $nome): sting acetta o null o string (nullable)
//function funct(...$numeri): int|float variadic