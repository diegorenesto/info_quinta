<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$classifica = $db->query("
    SELECT 
        c.nome as casa_nome,
        c.colore_livrea,
        COUNT(DISTINCT p.cf) as numero_piloti,
        SUM(part.punti) as totale_punti,
        COUNT(part.cf_pilota) as gare_disputate,
        COUNT(CASE WHEN part.posizione = 1 THEN 1 END) as vittorie,
        MIN(part.posizione) as miglior_posizione
    FROM casa c
    LEFT JOIN pilota p ON c.nome = p.nome_casa
    LEFT JOIN partecipazione part ON p.cf = part.cf_pilota
    GROUP BY c.nome, c.colore_livrea
    HAVING gare_disputate > 0
    ORDER BY totale_punti DESC, vittorie DESC, miglior_posizione ASC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Squadre</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Classifica Squadre</h1>
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
        <h2>Classifica Generale Squadre</h2>

        <?php if (empty($classifica)): ?>
            <div class="alert alert-error">
                Nessun dato disponibile per la classifica.
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 20px; margin-bottom: 30px;">
                <?php foreach ($classifica as $index => $s): ?>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 10px solid <?php echo $s->colore_livrea; ?>">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h3 style="font-size: 1.5em; margin-bottom: 10px;">
                                    <?php echo $index + 1; ?>° - <?php echo htmlspecialchars($s->casa_nome); ?>
                                </h3>
                                <p>
                                    <strong>Piloti:</strong> <?php echo $s->numero_piloti; ?> |
                                    <strong>Gare disputate:</strong> <?php echo $s->gare_disputate; ?> |
                                    <strong>Vittorie:</strong> <?php echo $s->vittorie; ?> |
                                    <strong>Miglior posizione:</strong> <?php echo $s->miglior_posizione; ?>°
                                </p>
                            </div>
                            <div style="font-size: 2.5em; font-weight: bold; color: <?php echo $s->colore_livrea; ?>">
                                <?php echo $s->totale_punti; ?> pts
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <table>
                <thead>
                <tr>
                    <th>Pos</th>
                    <th>Squadra</th>
                    <th>Colore</th>
                    <th>Piloti</th>
                    <th>Gare</th>
                    <th>Vittorie</th>
                    <th>Miglior Pos</th>
                    <th>Punti</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classifica as $index => $s): ?>
                    <tr>
                        <td><strong><?php echo $index + 1; ?>°</strong></td>
                        <td><?php echo htmlspecialchars($s->casa_nome); ?></td>
                        <td>
                            <div style="width: 30px; height: 30px; background-color: <?php echo $s->colore_livrea; ?>; border-radius: 5px;"></div>
                        </td>
                        <td><?php echo $s->numero_piloti; ?></td>
                        <td><?php echo $s->gare_disputate; ?></td>
                        <td><?php echo $s->vittorie; ?></td>
                        <td><?php echo $s->miglior_posizione; ?>°</td>
                        <td><strong><?php echo $s->totale_punti; ?></strong></td>
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