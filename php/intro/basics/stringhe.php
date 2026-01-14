<?php
echo "<h2>STRINGHE</h2>";
$str = "ciao stringa di prova";
echo $str . "<br>";
echo "strlen: " . strlen($str) . "<br>";
echo "strrev: " . strrev($str) . "<br>";
echo "strtoupper: " . strtoupper($str) . "<br>";
echo "strtolower: " . strtolower($str) . "<br>";
echo "ucfirst: " . ucfirst($str) . "<br>"; // mette in uppercase la prima lettera della prima parola
echo "ucwords: " . ucwords($str) . "<br>"; // mette in uppercase ogni prima lettera di ogni parola della stringa

echo "<pre>"; // messo per mostrare gli spazi prima e dopo str2
$str2 = "   ciao stringa due      ";
echo "Stringa: " . $str2 . "<br>";
echo "trim: " . trim($str2) . "<br>"; // rimuove spazi o caratteri speciali (da specificare come secondo argomento)
echo "ltrim: " . ltrim($str2) . "<br>"; // left trim
echo "rtrim: " . rtrim($str2). "<br>"; // right trim
echo "</pre>";


echo "explode<br>";
$elementi = "elemento1 elemento2 elemento3";
var_dump($elementi);
$elemento = explode(" ", $elementi); // separa delle stringhe da una stringa
echo "<br>explode: ";
var_dump($elemento);

echo "<br><br>implode<br>";
$arr = array("lastname", "email", "phone");
var_dump($arr);
$comma_separated = implode(", ", $arr); // unisce elementi di un array in una stringa
echo "<br>implode: " . $comma_separated . "<br><br>";

echo "str_replace: " . str_replace("ciao", "arrivederci", $str) . "<br>"; // cosa cercare, con cosa sostituire, da dove cercare
echo substr($str, 5) . "<br>"; // restituisce una porzione di stringa (-10 restituisce gli ultimi 10 caratteri)
echo strpos($str, "a") . "<br>"; // restituisce la posizione di un carattere/stringa (il primo specificato)
echo strrpos($str, "a") . "<br>"; // restituisce la posizione di un carattere/stringa (l'ultimo specificato)
echo strstr($str, "a") . "<br>"; // trova la prima occorrenza in una stringa e restituisce il resto
echo stristr($str, "a") . "<br>"; // versione insensibile alle maiuscole

$isodate = sprintf("%04d-%02d-%02d", date("Y"), date("m"), date("d")) . "<br>"; // stampa formattata salvabile in una variabile
echo "sprintf: " . $isodate;
echo "printf: ";
printf("nome: %s, cognome: %s", "diego", "renesto"); // stampa formattata NON salvabile in una variabile

echo "<br>";
$num = 1234.56;
$format_ita = number_format($num, 2, ',', '.'); // modifica il formato di un numero
echo "number_format: " . $format_ita . "<br>";

/* addslashes() mette il backslash prima dei caratteri:
 * virgoletta singola (')
 * doppia virgoletta (")
 * backslash (\)
 * NUL (il byte NUL)
 */
$str3 = "ciao nicolo'";
echo $str3 . "<br>";
echo "addslashes: " .addslashes($str3) . "<br>"; // mette il backslash
echo "stripslashes: " . stripslashes($str3) . "<br>"; // toglie il backslash
