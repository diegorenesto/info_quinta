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
$corsi = ["sistemi e reti", "informatica", "statistica", "contabilita", "marketing", "tecnologie", "meccatronica", "elettronica", "chimica organica", "robotica"];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seleziona Corsi</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .corso-box {
            width: 100%;
            border: 2px solid #333;
            padding: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: #f2f2f2;

            display: flex;
            justify-content: center; /* CENTRO ORIZZONTALE */
            align-items: center; /* CENTRO VERTICALE */
            gap: 40px;
        }
        .campo {
            display: flex;
            flex-direction: column;
            align-items: center; /* centra label + select */
        }
        select {
            min-width: 220px;
        }
    </style>
</head>
<body>
<!-- n_corsi -->
<form method="post" action="tabella.php">
    <?php for ($i = 1; $i <= $n_corsi; $i++): ?>
        <div class="corso-box">
            <h3>Corso <?= $i ?></h3>

            <!-- Dropdown professori -->
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

            <!-- List box multipla corsi -->
            <div class="campo">
                <label>Corsi:</label><br>
                <select name="corsi[<?= $i ?>][]" multiple size="5">
                    <?php foreach ($corsi as $corso): ?>
                        <option value="<?= $corso ?>"><?= ucfirst($corso) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endfor; ?>

    <button type="submit">Invia</button>
</form>
</body>
</html>
