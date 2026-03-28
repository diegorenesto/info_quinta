<?php   //parametri di configurazione per la connessione al database creato con DBeaver
return [
    'dns' => 'mysql:host=localhost;dbname=emiliano_spiller_itis_users_26',   //Data Source Name
    'username' => 'root',
    'password' => '',
    'options' => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
];
