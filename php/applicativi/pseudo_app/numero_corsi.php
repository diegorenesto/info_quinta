<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Attivazione Corsi</title>
</head>
<body>
<form method="post" action="seleziona_corso.php">
    <label for="quantity">Quanti corsi vuoi attivare (1-10):</label>
    <input type="number" id="numero_corsi" name="numero_corsi" min="1" max="10"><br>
    <button type="submit">Invia</button>
</form>
</body>
</html>
