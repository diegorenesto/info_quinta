<?php
/* Prima parte:
Progettare una struttura dati con le seguenti tre caratteristiche:
- Deve contenere le discipline INFORMATICA, SISTEMI, e TPS.
- A ciascuna disciplina devono essere associati uno o più percorsi nel file system (ad esempio: C:\Utenti\Bob\Documenti);
- Ogni percorso deve contenere il nome di un argomento (ad esempio: Socket per la materia TPS) e il mese dell'anno in formato numerico in cui l'argomento è stato (o sarà) trattato.
*/


$materie = [
    "Informatica" => [
        "C:\\Users\\diego\\Desktop\\info_quinta" => [
            "argomento" => "Ripasso HTML, CSS e JS",
            "mese" => 9
        ]
    ],
    "Sistemi" => [
        "C:\\Users\\diego\\Desktop\\sistemi" => [
            "argomento" => "NAT",
            "mese" => 1
        ]
    ],
    "TPSIT" => [
        "C:\\Users\\diego\\Desktop\\tpsit_quinta" => [
            "argomento" => "Socket in C",
            "mese" => 11
        ]
    ]
];

echo $materie["TPSIT"]["C:\\Users\\diego\\Desktop\\tpsit_quinta"]["argomento"];
echo "<br>";


// PARTE DUE (PHP-2.2)
/* Seconda parte:
1- Creare una funzione che consenta di estrarre dalla struttura dati il nome dell'argomento e il mese di studio, partendo dalla materia e dal percorso specificato.
2- Creare una funzione che possa inserire, per qualunque delle tre discipline, tutti gli altri dati come indicati sopra; questa funzione deve
    a) controllare che la disciplina che si vuole inserire sia tra le tre permesse;
    b) evitare di sovrascrivere un percorso già esistente nella stessa disciplina;
    c) controllare che il mese sia compreso nell'intervallo 1 - 12.

P.S. per PHP-2 creare prima la struttura dati e popolarla con dei dati a piacere(Prima parte); proseguire quindi con l'implementazione delle funzioni (Seconda parte).
*/
// 1-
function get_argomento_mese(array $materie, string $materia, string $percorso): ?array
{
    return [
        "argomento" => $materie[$materia][$percorso]["argomento"],
        "mese" => $materie[$materia][$percorso]["mese"]
    ];
}

$prova = get_argomento_mese(
    $materie,
    "Informatica",
    "C:\\Users\\diego\\Desktop\\info_quinta"
);

if ($prova !== null) {
    echo "Argomento: {$prova['argomento']} - Mese: {$prova['mese']}" . "<br>";
} else {
    echo "Dati non trovati<br>";
}


// 2-
function inserisci_percorso(array $materie, string $materia, string $percorso, string $argomento, int $mese): bool
{
    // a
    if (!isset($materie[$materia])) {
        return false;
    }
    // b
    if (isset($materie[$materia][$percorso])) {
        return false;
    }
    // c
    if ($mese < 1 || $mese > 12) {
        return false;
    }
    $materie[$materia][$percorso] = [
        "argomento" => $argomento,
        "mese" => $mese
    ];
    return true;
}

if (inserisci_percorso(
    $materie,
    "TPSIT",
    "C:\\Users\\diego\\Desktop\\prova_inserimento",
    "Struct",
    10
)) {
    echo "Inserito correttamente";
} else {
    echo "Errore";
}