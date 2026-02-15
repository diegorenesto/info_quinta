<?php

return [
    "dsn" => "mysql:host=localhost;dbname=diego_renesto_itis;charset=utf8mb4",
    "username" => "root",
    "password" => "",
    "options" => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];
