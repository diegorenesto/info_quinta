<?php

require "db_conn_biblioteca.php";

$db_config = require "config/db_config_biblioteca.php";
$db = db_conn_biblioteca::getDB($db_config);

//if (is_null($db)) {
//    exit("Errore col DB");
//}

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $cognome = trim($_POST["cognome"]);
    $numero_tessera = trim($_POST["numero_tessera"]);
    $data_iscrizione = $_POST["data_iscrizione"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (empty($nome) || empty($cognome) || empty($numero_tessera) || empty($password)) {
        $messaggio = '<div class="alert error">Tutti i campi sono obbligatori</div>';
    } else {
        try {
            $sql = "INSERT INTO utenti (nome, cognome, numero_tessera, data_iscrizione, password)
            VALUES (:nome, :cognome, :numero_tessera, :data_iscrizione, :password)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ":nome" => $nome,
                ":cognome" => $cognome,
                ":numero_tessera" => $numero_tessera,
                ":data_iscrizione" => $data_iscrizione,
                ":password" => $password
            ]);

            $messaggio = '<div class="alert success">Utente registrato con successo</div>';

        } catch (PDOException $e) {
            $messaggio = '<div class="alert error">Errore durante la registrazione: ' . $e->getMessage() . '</div>';
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrazione Utente</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Registrazione Nuovo Utente</h1>
        <a href="index.php" class="btn-back">Torna alla home</a>
    </header>

    <main>
        <?php echo $messaggio; ?>

        <div class="form-container">
            <form method="POST" action="" class="registration-form">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required
                           value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" required
                           value="<?php echo isset($_POST['cognome']) ? htmlspecialchars($_POST['cognome']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="numero_tessera">Numero Tessera:</label>
                    <input type="number" id="numero_tessera" name="numero_tessera" required
                           value="<?php echo isset($_POST['numero_tessera']) ? htmlspecialchars($_POST['numero_tessera']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="data_iscrizione">Data Iscrizione:</label>
                    <input type="date" id="data_iscrizione" name="data_iscrizione" required
                           value="<?php echo isset($_POST['data_iscrizione']) ? htmlspecialchars($_POST['data_iscrizione']) : date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-submit">Registra Utente</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
