<?php
$n_corsi = $_POST["numero_corsi"];
$professori = [
        "Prof_1" => [
                "nome" => "Filippo",
                "cognome" => "Gasparini"
        ],
        "Prof_2" => [
                "nome" => "Emiliano",
                "cognome" => "Spiller"
        ],
        "Prof_3" => [
                "nome" => "Alessandro",
                "cognome" => "Mazzullo"
        ],
        "Prof_4" => [
                "nome" => "Cristiano",
                "cognome" => "Gregnanin"
        ],
        "Prof_5" => [
                "nome" => "Giulia",
                "cognome" => "Pierlorenzi"
        ]
];
$corsi = ["Sistemi e reti", "Robotica", "Contabilità", "Meccatronica", "Chimica", "Statistica", "Matematica", "Informatica", "Marketing", "Economia Politica"];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seleziona Corsi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="tabella.php">
    <input type="hidden" name="numero_corsi" value="<?= $n_corsi ?>">

    <?php for ($i = 1; $i <= $n_corsi; $i++): ?>
        <div class="corso-box">
            <h3>Corso <?= $i ?></h3>

            <div class="campo">
                <label>Professore:</label><br>
                <select name="professore[<?= $i ?>]">
                    <?php foreach ($professori as $key => $prof): ?>
                        <option value="<?= $key ?>">
                            <?= $prof["nome"] . " " . $prof["cognome"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo">
                <label>Corsi:</label><br>
                <select name="corsi[<?= $i ?>][]" multiple size="5">
                    <?php foreach ($corsi as $corso): ?>
                        <option value="<?= $corso ?>"><?= $corso ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endfor; ?>

    <button type="submit">Invia</button>
</form>
</body>
</html>
