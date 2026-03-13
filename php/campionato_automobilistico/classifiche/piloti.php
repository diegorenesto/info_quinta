<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$classifica = $db->query("
    SELECT 
        p.cf,
        p.nome,
        p.cognome,
        p.nazionalita,
        p.numero,
        c.nome as casa_nome,
        c.colore_livrea,
        SUM(part.punti) as totale_punti,
        COUNT(part.cf_pilota) as gare_disputate,
        MIN(part.posizione) as miglior_posizione,
        COUNT(CASE WHEN part.posizione = 1 THEN 1 END) as vittorie
    FROM pilota p
    JOIN casa c ON p.nome_casa = c.nome
    LEFT JOIN partecipazione part ON p.cf = part.cf_pilota
    GROUP BY p.cf, p.nome, p.cognome, p.nazionalita, p.numero, c.nome, c.colore_livrea
    HAVING gare_disputate > 0
    ORDER BY totale_punti DESC, miglior_posizione ASC, vittorie DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Piloti</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Classifica Piloti</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../iscrizioni/campionato.php">Campionati</a></li>
            <li><a href="../iscrizioni/casa.php">Case</a></li>
            <li><a href="../iscrizioni/pilota.php">Piloti</a></li>
            <li><a href="../iscrizioni/gara.php">Gare</a></li>
            <li><a href="../iscrizioni/partecipazione.php">Risultati</a></li>
            <li><a href="piloti.php">Classifica Piloti</a></li>
            <li><a href="squadre.php">Classifica Squadre</a></li>
            <li><a href="../risultati/gara.php">Risultati Gara</a></li>
        </ul>
    </nav>

    <main>
        <h2>Classifica Generale Piloti</h2>

        <?php if (empty($classifica)): ?>
            <div class="alert alert-error">
                Nessun dato disponibile per la classifica.
            </div>
        <?php else: ?>
            <div class="classifica-piloti">
                <?php foreach ($classifica as $index => $p): ?>
                    <div class="pilota-card">
                        <div class="posizione"><?php echo $index + 1; ?></div>
                        <div style="width: 30px; height: 30px; background-color: <?php echo $p->colore_livrea; ?>; border-radius: 5px;"></div>
                        <div class="info">
                            <h3><?php echo htmlspecialchars($p->nome . ' ' . $p->cognome); ?></h3>
                            <p>
                                #<?php echo $p->numero; ?> |
                                <?php echo htmlspecialchars($p->nazionalita); ?> |
                                <?php echo htmlspecialchars($p->casa_nome); ?>
                            </p>
                            <p>
                                <strong>Gare disputate:</strong> <?php echo $p->gare_disputate; ?> |
                                <strong>Vittorie:</strong> <?php echo $p->vittorie; ?> |
                                <strong>Miglior posizione:</strong> <?php echo $p->miglior_posizione; ?>°
                            </p>
                        </div>
                        <div class="punti">
                            <?php echo $p->totale_punti; ?> punti
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <table style="margin-top: 40px;">
                <thead>
                <tr>
                    <th>Pos</th>
                    <th>Pilota</th>
                    <th>Nazionalità</th>
                    <th>Numero</th>
                    <th>Casa</th>
                    <th>Gare</th>
                    <th>Vittorie</th>
                    <th>Miglior Pos</th>
                    <th>Punti</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classifica as $index => $p): ?>
                    <tr>
                        <td><strong><?php echo $index + 1; ?>°</strong></td>
                        <td><?php echo htmlspecialchars($p->nome . ' ' . $p->cognome); ?></td>
                        <td><?php echo htmlspecialchars($p->nazionalita); ?></td>
                        <td>#<?php echo $p->numero; ?></td>
                        <td style="border-left: 5px solid <?php echo $p->colore_livrea; ?>">
                            <?php echo htmlspecialchars($p->casa_nome); ?>
                        </td>
                        <td><?php echo $p->gare_disputate; ?></td>
                        <td><?php echo $p->vittorie; ?></td>
                        <td><?php echo $p->miglior_posizione; ?>°</td>
                        <td><strong><?php echo $p->totale_punti; ?></strong></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 - Progetto Campionato Automobilistico</p>
    </footer>
</div>
</body>
</html>