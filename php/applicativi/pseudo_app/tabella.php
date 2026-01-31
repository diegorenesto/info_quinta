<?php
$professori_selezionati = $_POST["professore"] ?? [];
$corsi_selezionati = $_POST["corsi"] ?? [];
$n_corsi = $_POST["numero_corsi"] ?? 0;

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

$risultati = [];
$assegnazioni = [];

for ($i = 1; $i <= $n_corsi; $i++) {
    if (isset($professori_selezionati[$i]) && isset($corsi_selezionati[$i])) {
        $prof_key = $professori_selezionati[$i];

        if (isset($professori[$prof_key])) {
            $nome_prof = $professori[$prof_key]["nome"];
            $cognome_prof = $professori[$prof_key]["cognome"];

            foreach ($corsi_selezionati[$i] as $corso) {
                $chiave = $nome_prof . "|" . $cognome_prof . "|" . $corso;

                if (isset($assegnazioni[$chiave])) {
                    $assegnazioni[$chiave]["duplicato"] = true;
                } else {
                    $assegnazioni[$chiave] = [
                            "nome" => $nome_prof,
                            "cognome" => $cognome_prof,
                            "corso" => $corso,
                            "duplicato" => false
                    ];
                    $risultati[] = $assegnazioni[$chiave];
                }
            }
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
    <title>Riepilogo Iscrizioni Corsi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Riepilogo Iscrizioni Corsi</h1>

<?php if (empty($risultati)): ?>
    <div class="info warning">Nessun corso selezionato. Torna indietro e compila il form</div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Corso</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($risultati as $riga): ?>
            <tr class="<?= $riga['duplicato'] ? 'duplicato' : '' ?>">
                <td><?= htmlspecialchars($riga['nome']) ?></td>
                <td><?= htmlspecialchars($riga['cognome']) ?></td>
                <td><?= htmlspecialchars($riga['corso']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><a href="numero_corsi.php">Torna alla pagina iniziale</a></p>
</body>
</html>