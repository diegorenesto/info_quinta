<?php
$nome = $_POST["nome"] ?? ""; // variabile SUPERGLOBAL che contiene i dati inseriti nel form, se usato il metodo post
$cognome = $_POST["cognome"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$eta = $_POST["eta"] ?? "";
$sesso = $_POST["sesso"] ?? "";
$corsi = $_POST["corsi"] ?? [];
$citta = $_POST["citta"] ?? "";
$lingua = $_POST["lingua"] ?? [];
$area = $_POST["area"] ?? "";

//$a = [$nome, $cognome, $email, $password, $eta];
//var_dump($a);
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
<p><strong>Nome: </strong><?= $nome ?></p>
<p><strong>Cognome: </strong><?= $cognome ?></p>
<p><strong>Email: </strong><?= $email ?></p>
<p><strong>Password: </strong><?= $password ?></p>
<p><strong>Età: </strong><?= $eta ?></p>
<p><strong>Sesso: </strong><?= $sesso ?></p>
<p><strong>Corsi: </strong>
    <?php
    foreach ($corsi as $c) { ?>
        <p>- <?= ($c)?></p>
    <?php } ?>
</p>
<p><strong>Città: </strong><?= $citta ?></p>
<p><strong>Lingua: </strong>
    <?php
    foreach ($lingua as $l) { ?>
        <p>- <?= ($l)?></p>
    <?php } ?> <!-- la } chiude il php -->
</p>
<p><strong>Area: </strong><?= $area ?></p>
</body>
</html>