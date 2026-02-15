<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca Comunale</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Biblioteca Comunale</h1>
        <div class="datetime">
            <p id="data-ora">
                <?php echo date("d/m/Y"); ?>
                <?php echo date("H:i:s"); ?>
            </p>
        </div>
    </header>

    <main>
        <div class="welcome-card">
            <a href="registrazione.php" class="btn">Registra nuovo utente</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Biblioteca Comunale</p>
    </footer>
</div>

</body>
</html>
