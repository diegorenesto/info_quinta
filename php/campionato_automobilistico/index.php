<?php
require_once 'config/db.php';
$config = require_once 'config/db_config_casa.php';
$db = db::getDB($config);

// query per stats
$stats = [
        'campionati' => $db->query("SELECT COUNT(*) as count FROM campionato")->fetch()->count,
        'case' => $db->query("SELECT COUNT(*) as count FROM casa")->fetch()->count,
        'piloti' => $db->query("SELECT COUNT(*) as count FROM pilota")->fetch()->count,
        'gare' => $db->query("SELECT COUNT(*) as count FROM gara")->fetch()->count
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campionato Automobilistico</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Campionato Automobilistico</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="iscrizioni/campionato.php">Campionati</a></li>
            <li><a href="iscrizioni/casa.php">Case Automobilistiche</a></li>
            <li><a href="iscrizioni/pilota.php">Piloti</a></li>
            <li><a href="iscrizioni/gara.php">Gare</a></li>
            <li><a href="iscrizioni/partecipazione.php">Risultati Gare</a></li>
            <li><a href="classifiche/piloti.php">Classifica Piloti</a></li>
            <li><a href="classifiche/squadre.php">Classifica Squadre</a></li>
            <li><a href="risultati/gara.php">Risultati Gara</a></li>
        </ul>
    </nav>

    <main>
        <h2>Dashboard</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div style="background: #3498db; color: white; padding: 20px; border-radius: 10px; text-align: center;">
                <h3 style="margin-bottom: 10px;">Campionati</h3>
                <p style="font-size: 2.5em; font-weight: bold;"><?php echo $stats['campionati']; ?></p>
            </div>
            <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 10px; text-align: center;">
                <h3 style="margin-bottom: 10px;">Case</h3>
                <p style="font-size: 2.5em; font-weight: bold;"><?php echo $stats['case']; ?></p>
            </div>
            <div style="background: #27ae60; color: white; padding: 20px; border-radius: 10px; text-align: center;">
                <h3 style="margin-bottom: 10px;">Piloti</h3>
                <p style="font-size: 2.5em; font-weight: bold;"><?php echo $stats['piloti']; ?></p>
            </div>
            <div style="background: #f39c12; color: white; padding: 20px; border-radius: 10px; text-align: center;">
                <h3 style="margin-bottom: 10px;">Gare</h3>
                <p style="font-size: 2.5em; font-weight: bold;"><?php echo $stats['gare']; ?></p>
            </div>
        </div>

        <h3>Ultimi Risultati</h3>
        <?php
        $ultime_gare = $db->query("
                SELECT g.nome_gara, g.giorno, g.mese, g.anno, 
                       COUNT(p.cf_pilota) as partecipanti
                FROM gara g
                LEFT JOIN partecipazione p ON g.nome_campionato = p.nome_campionato 
                    AND g.giorno = p.giorno AND g.mese = p.mese AND g.anno = p.anno
                GROUP BY g.nome_campionato, g.giorno, g.mese, g.anno, g.nome_gara
                ORDER BY g.anno DESC, g.mese DESC, g.giorno DESC
                LIMIT 5
            ")->fetchAll();

        if ($ultime_gare): ?>
            <table>
                <thead>
                <tr>
                    <th>Gara</th>
                    <th>Data</th>
                    <th>Partecipanti</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ultime_gare as $gara): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($gara->nome_gara); ?></td>
                        <td><?php echo sprintf("%02d/%02d/%d", $gara->giorno, $gara->mese, $gara->anno); ?></td>
                        <td><?php echo $gara->partecipanti; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nessuna gara registrata</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 - Progetto Campionato Automobilistico</p>
    </footer>
</div>
</body>
</html>