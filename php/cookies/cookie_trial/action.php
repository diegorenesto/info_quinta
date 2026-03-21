<?php
if (isset($_POST['nome'])) {
    setcookie(
        "user", $_POST['nome'],
        [
            "expires" => time() + 36000,
            "path" => "/",
            "secure" => false,
            "httponly" => true,
            "samesite" => "Lax"
        ]
    );
    $user = $_POST['nome'];
} else {
    $user = $_COOKIE['nome'];
}

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
<p>Ciao <?= $user ?>, questa è la pagina action</p>

<p><a href="show.php">Questo è il link per la pagina show</a></p>
</body>
</html>
