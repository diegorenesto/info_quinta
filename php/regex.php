<?php
// https://regex101.com/

$testo = "Hello, World!";
echo preg_match("#World#", $testo) ? "Pattern trovato" : "Pattern non trovato";

echo "<br>preg_match con ^: ";
echo preg_match("#^ciao#", "ciao a tutti") ? "Pattern trovato all'inizio" : "Pattern non trovato";

echo "<br>preg_match con $: ";
echo preg_match("#tutti$#", "ciao a tutti") ? "Pattern trovato alla fine" : "Pattern non trovato";

echo "<br>preg_match con [num]: ";
echo preg_match("#[0-9]#", "ciao5 a tutti") ? "Numero trovato" : "Numero non trovato";

echo "<br>preg_match con [char]: ";
echo preg_match("#[a-z]#", "CIAO A Tutti") ? "Pattern trovato" : "Pattern non trovato";
// || [A-Z] || [a-zA-Z]

echo "<br>preg_match con [^num]: ";
echo preg_match("#[^0-4]#", "16") ? "true" : "false"; // ricerca mancanza di numeri [0-4] (trova qualcos'altro?)
// se trova qualcosa che non sia 0-4 ritorna true
// se non trova qualcosa che non sia 0-4 ritorna false


echo "<br>preg_match Rovigo(?): ";
echo preg_match("#R[aeiou]?vigo#", "Rvigo") ? "true" : "false"; // ?, 0 o 1

echo "<br>preg_match Rovigo(*): ";
echo preg_match("#R[aeiou]*vigo#", "Roioaievigo") ? "true" : "false"; // *, indefinite

echo "<br>preg_match Rovigo(+): ";
echo preg_match("#R[aeiou]+vigo#", "Rvigo") ? "true" : "false"; // +, 1 o più

echo "<br>preg_match Rovigo(char|num, *): ";
echo preg_match("#R[aeiou0-9]*vigo#", "Roiae92vigo") ? "true" : "false";

echo "<br><br>Matches array:<br>";
echo preg_match("#R[aeiou]*vigo#", "Rovigo", $matches) ? "true" : "false"; // *, indefinite
var_dump($matches);

echo "<br>";
echo preg_match("#R[aeiou]#", "Rovigo", $matches_) ? "true" : "false"; // trovando delle altre vocali rompe la sequenza
var_dump($matches_);

echo "<br><br>Case Insensitive (#ignore): ";
echo preg_match("#CIAO#i", "CIAO") ? "Pattern trovato" : "Pattern non trovato";

$tel = "0123456789";
echo "<br>Conta occorrenze: ";
echo preg_match("#[0-9]{8}#", $tel, $matches__) ? "true" : "false";
echo "<br>";
var_dump($matches__);
// se metto [0-3] rompe tutto, ma se metto [0-3]{3,8} funziona {min,max}

echo "<br>preg_match con |: ";
echo preg_match("#verde|blu|rosso#", "rosso") ? "true" : "false";