<?php
require "db_conn.php";
$db_config = require "config/db_config_scuola.php";

$db = db_conn::getDB($db_config);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<form method="POST" action="esito_POST.php">
    Nome: <br>
    <input type="text" name="nome"><br>
    Cognome: <br>
    <input type="text" name="cognome"><br>
    Numero Tessera: <br>
    <input type="number" name="numero_tessera"><br>
    Data Iscrizione: <br>
    <input type="date" name="data_iscrizione"><br>
    Password: <br>
    <input type="password" name="password"><br>
    <input type="submit" value="Registra">
</form>
</body>
</html>