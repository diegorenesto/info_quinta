<?php

$db = new PDO(
    "mysql:host=192.168.60.144;dbname=diego_renesto_itis;charset=utf8mb4",
    "diego_renesto",
    "principiano.disonori.",
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
);

// READ 1
$query = 'SELECT * FROM studenti';

try {
    $smtp = $db->prepare($query);
    $smtp->execute();

    while ($user = $smtp->fetch()) {
        echo "Nome: " . $user->nome . "<br>";
        echo "Cognome: " . $user->cognome . "<br>";
        echo "Media: " . $user->media . "<br>";
        echo "Data iscrizione: " . $user->data_iscrizione . "<br>";
        echo "<hr>";
    }
    $smtp->closeCursor();
} catch (PDOException $e) {
    echo "A DB error occured. Please try again later";
    // non metto il getMessage perché interessano a me programmer e non all'utente
}


/*
// READ 2
$student_name = "Antonio";
$query = 'SELECT media, cognome FROM studenti WHERE nome = :name';

try {
    $stat = $db->prepare($query);
    $stat->bindValue(":name", $student_name, PDO::PARAM_STR);
    $stat->execute();

    while ($user = $stat->fetch()) {
        echo "Cognome: " . $user->cognome . "<br>";
        echo "Media: " . $user->media . "<br>";
        echo "<hr>";
    }
    $stat->closeCursor();
} catch (PDOException $e) {
    echo "A DB error occured. Please try again later";
}
*/


// CREATE
$query = 'INSERT INTO studenti(nome, cognome, media, data_iscrizione)
          VALUES(:nome, :cognome, :media, NOW())';

try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(":nome", "Lucy", PDO::PARAM_STR);
    $stmt->bindValue(":cognome", "Taylor", PDO::PARAM_STR);
    $stmt->bindValue(":media", 8, PDO::PARAM_INT);

    $stmt->execute();
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "A DB error occured. Please try again later";
}