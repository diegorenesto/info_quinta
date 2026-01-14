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
echo "<hr>";

// ================= ARRAY ASSOCIATIVO ================= //
echo "<h2>Array associativi</h2>";
$associativo = [
    "nome" => "Diego",
    "cognome" => "Renesto",
    "eta" => 18
];

echo "<strong>Nome array associativo: </strong>" . $associativo["nome"] . "<br><br>";
echo "<p><strong>Stampa array associativo:</strong></p>";
foreach ($associativo as $chiave => $valore) {
    echo "<strong>$chiave</strong>: $valore<br>";
}
echo "<hr>";

// ================= ARRAY ASSOCIATIVO ANNIDATO ================= //
echo "<h2>Array associativo annidato</h2>";

$annidato = [
    "persona1" => [
        "nome" => "Otto",
        "cognome" => "Bismarck"
    ],
    "persona2" => [
        "nome" => "Camillo",
        "cognome" => "Benso"
    ]
];

echo "<p><strong>Stampa array annidato (print_r):</strong></p><pre>";
print_r($annidato);
echo "</pre>";
echo "<hr>";


// ================= CONTROLLO CHIAVI ================= //
echo "<h2>Controllo chiavi array associativo</h2>";

//if (array_key_exists("nome", $associativo)) {
//    echo "<p><span style='color: green;'>La chiave 'nome' è presente</span></p>";
//} else {
//    echo "<p><span style='color: red;'>La chiave 'nome' NON è presente</span></p>";
//}
if (array_key_exists("nome", $associativo)) {
    echo "<p><span style='color: green;'>La chiave 'nome' è presente</span></p>";
} else {
    echo "<p><span style='color: red;'>La chiave 'nome' NON è presente</span></p>";
}

echo "<p><strong>Elenco chiavi dell'array:</strong></p><pre>";
print_r(array_keys($associativo));
echo "</pre>";

echo "<p><strong>Elenco valori dell'array:</strong></p>";
echo "<pre>";
print_r(array_values($associativo));
echo "</pre>";

echo "<p><strong>Valore della chiave 'eta':</strong> " . $associativo["eta"] . "</p>";

if (array_key_exists("eta", $associativo)) {
    echo "<p><span style='color: green;'>La chiave 'eta' è presente</span></p>";
} else {
    echo "<p><span style='color: red;'>La chiave 'eta' NON è presente</span></p>";
}
echo "<p><strong>Funzione next: </strong>" . next($associativo) . "</p>";
echo "<hr>";


// ================= CONFRONTI (== E ===) ================= //
echo "<h2>CONFRONTI (== E ===)</h2>";

$var3 = 5;
$var4 = "5";

echo "<p><br>$var3 e $var4 (==): ";
if ($var3 == $var4)
    echo "<span style='color: green'>Sono uguali</span>";
else
    echo "<span style='color: red'>NON sono uguali</span>";

echo "<br>$var3 e $var4 (===): ";
if ($var3 === $var4)
    echo "<span style='color: green'>Sono uguali</span>";
else
    echo "<span style='color: red'>NON sono uguali</span>";
echo "</p><hr>";

// ================= ISSET ================= //
$a = 0;
$b = NULL;
echo "<p>a = 0<br>b = NULL</p>";

echo "<h2>ISSET</h2>"; // ritorna vero se

echo "a isset: ";
if (isset($a))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";
echo "<br>b isset: ";
if (isset($b))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";

echo "<br><br>";
// ================= IS_NULL ================= //
echo "<h2>IS_NULL</h2>"; // ritorna vero se la variabile è NULL

echo "a is_null: ";
if (is_null($a))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";
echo "<br>b is_null: ";
if (is_null($b))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";

echo "<br><br>";
// ================= EMPTY ================= //
echo "<h2>EMPTY</h2>"; // ritorna vero se è 0 o NULL
echo "a empty: ";
if (empty($a))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";
echo "<br>b empty: ";
if (empty($b))
    echo "<span style='color: green'>true</span>";
else
    echo "<span style='color: red'>false</span>";
