<?php

require "db_conn_biblioteca.php";

$db_config = require "config/db_config_biblioteca.php";
$db = db_conn_biblioteca::getDB($db_config);

if (is_null($db)) {
    exit("Errore col DB");
}

$sql = "SELECT * FROM utenti";
$stmt = $db->query($sql);
$utenti = $stmt->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Debug</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Debug</h1>
        <a href="index.php" class="btn-back">Torna alla home</a>
    </header>

    <main>
        <?php if (count($utenti) > 0): ?>
            <div class="table-container">
                <table class="users-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Numero Tessera</th>
                        <th>Data Iscrizione</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($utenti as $utente): ?>
                        <tr>
                            <td><?php echo $utente->id ?></td>
                            <td><?php echo htmlspecialchars($utente->nome); ?></td>
                            <td><?php echo htmlspecialchars($utente->cognome); ?></td>
                            <td><?php echo $utente->numero_tessera; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($utente->data_iscrizione)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p class="totale-utenti">Totale utenti registrati: <strong><?php echo count($utenti); ?></strong></p>
        <?php else: ?>
            <div class="alert info">Nessun utente registrato</div>
        <?php endif; ?>
    </main>
</div>
</body>
</html>