<?php

// separazione degli ambiti => uso questo file e NON quello con le query

return [
    "dsn" => "mysql:host=192.168.60.144;dbname=diego_renesto_itis;charset=utf8mb4",
    "username" => "diego_renesto",
    "password" => "principiano.disonori.",
    "options" => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];