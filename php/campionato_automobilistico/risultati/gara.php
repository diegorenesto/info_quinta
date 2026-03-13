<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$risultati_gara = null;
$gara_selezionata = null;
$tempo_veloce = null;

$gare = $db->query("
    SELECT g.*, c.nome as campionato_nome 
    FROM gara g 
    JOIN campionato c ON g.nome_campionato = c.nome 
    ORDER BY g.anno DESC, g.mese DESC, g.giorno DESC
")->fetchAll();

if (isset($_GET['visualizza']) && isset($_GET['nome_campionato']) && isset($_GET['giorno']) && isset($_GET['mese']) && isset($_GET['anno'])) {
    $nome_campionato = $_GET['nome_campionato'];
    $giorno = $_GET['giorno'];
    $mese = $_GET['mese'];
    $anno = $_GET['anno'];

    $stmt = $db->prepare("
        SELECT g.*, c.nome as campionato_nome
        FROM gara g
        JOIN campionato c ON g.nome_campionato = c.nome
        WHERE g.nome_campionato = ? AND g.giorno = ? AND g.mese = ? AND g.anno = ?
    ");
    $stmt->execute([$nome_campionato, $giorno, $mese, $anno]);
    $gara_selezionata = $stmt->fetch();

    if ($gara_selezionata) {
        $stmt = $db->prepare("
            SELECT 
                p.cf,
                p.nome,
                p.cognome,
                p.numero,
                c.nome as casa_nome,
                c.colore_livrea,
                part.posizione,
                part.punti,
                part.tempo
            FROM partecipazione part
            JOIN pilota p ON part.cf_pilota = p.cf
            JOIN casa c ON p.nome_casa = c.nome
            WHERE part.nome_campionato = ? AND part.giorno = ? AND part.mese = ? AND part.anno = ?
            ORDER BY part.posizione
        ");
        $stmt->execute([$nome_campionato, $giorno, $mese, $anno]);
        $risultati_gara = $stmt->fetchAll();

        if (!empty($risultati_gara)) {
            $tempi = array_column($risultati_gara, 'tempo');
            $tempo_veloce = min($tempi);
        }
    }
}

// Funzione per ottenere i valori dal GET o impostarli a vuoto
function getValue($key) {
    return isset($_GET[$key]) ? $_GET[$key] : '';
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultati Gara</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Risultati Gara</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../iscrizioni/campionato.php">Campionati</a></li>
            <li><a href="../iscrizioni/casa.php">Case</a></li>
            <li><a href="../iscrizioni/pilota.php">Piloti</a></li>
            <li><a href="../iscrizioni/gara.php">Gare</a></li>
            <li><a href="../iscrizioni/partecipazione.php">Risultati</a></li>
            <li><a href="../classifiche/piloti.php">Classifica Piloti</a></li>
            <li><a href="../classifiche/squadre.php">Classifica Squadre</a></li>
            <li><a href="gara.php">Risultati Gara</a></li>
        </ul>
    </nav>

    <main>
        <h2>Seleziona Gara</h2>

        <form method="GET" action="gara.php" style="max-width: 500px; margin-bottom: 40px;">
            <div class="form-group">
                <label for="gara_select">Gara:</label>
                <select id="gara_select" name="gara_select" required onchange="updateGaraFields()">
                    <option value="">Seleziona una gara</option>
                    <?php foreach ($gare as $g):
                        $selected = '';
                        if (isset($_GET['gara_select']) && $_GET['gara_select'] == $g->nome_campionato . '|' . $g->giorno . '|' . $g->mese . '|' . $g->anno) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="<?php echo htmlspecialchars($g->nome_campionato) . '|' . $g->giorno . '|' . $g->mese . '|' . $g->anno; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($g->nome_gara) . ' - ' . sprintf("%02d/%02d/%d", $g->giorno, $g->mese, $g->anno); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="nome_campionato" id="nome_campionato" value="<?php echo getValue('nome_campionato'); ?>">
            <input type="hidden" name="giorno" id="giorno" value="<?php echo getValue('giorno'); ?>">
            <input type="hidden" name="mese" id="mese" value="<?php echo getValue('mese'); ?>">
            <input type="hidden" name="anno" id="anno" value="<?php echo getValue('anno'); ?>">
            <input type="hidden" name="visualizza" value="1">

            <button type="submit" class="btn">Visualizza Risultati</button>
        </form>

        <?php if ($gara_selezionata && $risultati_gara && !empty($risultati_gara)): ?>
            <div class="gara-header">
                <h2><?php echo htmlspecialchars($gara_selezionata->nome_gara); ?></h2>
                <p>Campionato: <?php echo htmlspecialchars($gara_selezionata->campionato_nome); ?></p>
                <p>Data: <?php echo sprintf("%02d/%02d/%d", $gara_selezionata->giorno, $gara_selezionata->mese, $gara_selezionata->anno); ?></p>
            </div>

            <table>
                <thead>
                <tr>
                    <th>Posizione</th>
                    <th>Pilota</th>
                    <th>Numero</th>
                    <th>Squadra</th>
                    <th>Tempo</th>
                    <th>Punti</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($risultati_gara as $r): ?>
                    <tr <?php echo ($r->tempo == $tempo_veloce) ? 'style="background-color: #fff3cd;"' : ''; ?>>
                        <td><strong><?php echo $r->posizione; ?>°</strong></td>
                        <td>
                            <?php echo htmlspecialchars($r->nome . ' ' . $r->cognome); ?>
                            <?php if ($r->posizione == 1): ?>
                                🏆
                            <?php endif; ?>
                        </td>
                        <td>#<?php echo $r->numero; ?></td>
                        <td style="border-left: 5px solid <?php echo $r->colore_livrea; ?>">
                            <?php echo htmlspecialchars($r->casa_nome); ?>
                        </td>
                        <td><?php echo $r->tempo; ?></td>
                        <td><?php echo $r->punti; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($tempo_veloce): ?>
                <div class="tempo-veloce">
                    Tempo più veloce in gara: <?php echo $tempo_veloce; ?>
                    (realizzato da
                    <?php
                    $pilota_veloce = array_filter($risultati_gara, function($r) use ($tempo_veloce) {
                        return $r->tempo == $tempo_veloce;
                    });
                    $pilota_veloce = reset($pilota_veloce);
                    echo htmlspecialchars($pilota_veloce->nome . ' ' . $pilota_veloce->cognome);
                    ?>)
                </div>
            <?php endif; ?>

        <?php elseif (isset($_GET['visualizza'])): ?>
            <div class="alert alert-error">
                Nessun risultato disponibile per questa gara.
                <?php if ($gara_selezionata): ?>
                    La gara è stata trovata ma non ci sono risultati registrati.
                <?php else: ?>
                    Gara non trovata.
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($gare)): ?>
            <div class="alert alert-error">
                Non ci sono gare registrate nel sistema.
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 - Progetto Campionato Automobilistico</p>
    </footer>
</div>

<script>
    function updateGaraFields() {
        const select = document.getElementById('gara_select');
        const value = select.value;

        if (value) {
            const parts = value.split('|');
            document.getElementById('nome_campionato').value = parts[0];
            document.getElementById('giorno').value = parts[1];
            document.getElementById('mese').value = parts[2];
            document.getElementById('anno').value = parts[3];
        } else {
            document.getElementById('nome_campionato').value = '';
            document.getElementById('giorno').value = '';
            document.getElementById('mese').value = '';
            document.getElementById('anno').value = '';
        }
    }

    // Esegui all'avvio per assicurarsi che i campi siano sincronizzati
    window.addEventListener('load', function() {
        updateGaraFields();
    });
</script>
</body>
</html>