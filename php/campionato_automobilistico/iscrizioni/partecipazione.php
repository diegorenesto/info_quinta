<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$message = '';
$messageType = '';

$gare = $db->query("
    SELECT g.*, c.nome as campionato_nome 
    FROM gara g 
    JOIN campionato c ON g.nome_campionato = c.nome 
    ORDER BY g.anno DESC, g.mese DESC, g.giorno DESC
")->fetchAll();

$piloti = $db->query("
    SELECT p.*, c.nome as casa_nome 
    FROM pilota p 
    JOIN casa c ON p.nome_casa = c.nome 
    ORDER BY p.cognome, p.nome
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
            $cf_pilota = $_POST['cf_pilota'];
            $nome_campionato = $_POST['nome_campionato'];
            $giorno = $_POST['giorno'];
            $mese = $_POST['mese'];
            $anno = $_POST['anno'];
            $posizione = $_POST['posizione'];
            $punti = $_POST['punti'];
            $tempo = $_POST['tempo'];

            try {
                $stmt = $db->prepare("INSERT INTO partecipazione (cf_pilota, nome_campionato, giorno, mese, anno, posizione, punti, tempo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$cf_pilota, $nome_campionato, $giorno, $mese, $anno, $posizione, $punti, $tempo]);
                $message = "Risultato inserito con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        } elseif ($_POST['action'] === 'delete') {
            $cf_pilota = $_POST['cf_pilota'];
            $nome_campionato = $_POST['nome_campionato'];
            $giorno = $_POST['giorno'];
            $mese = $_POST['mese'];
            $anno = $_POST['anno'];

            try {
                $stmt = $db->prepare("DELETE FROM partecipazione WHERE cf_pilota = ? AND nome_campionato = ? AND giorno = ? AND mese = ? AND anno = ?");
                $stmt->execute([$cf_pilota, $nome_campionato, $giorno, $mese, $anno]);
                $message = "Risultato eliminato con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}

$risultati = $db->query("
    SELECT p.*, pi.nome, pi.cognome, pi.numero, g.nome_gara
    FROM partecipazione p
    JOIN pilota pi ON p.cf_pilota = pi.cf
    JOIN gara g ON p.nome_campionato = g.nome_campionato 
        AND p.giorno = g.giorno AND p.mese = g.mese AND p.anno = g.anno
    ORDER BY p.anno DESC, p.mese DESC, p.giorno DESC, p.posizione
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Risultati Gare</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Gestione Risultati Gare</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="campionato.php">Campionati</a></li>
            <li><a href="casa.php">Case</a></li>
            <li><a href="pilota.php">Piloti</a></li>
            <li><a href="gara.php">Gare</a></li>
            <li><a href="partecipazione.php">Risultati</a></li>
            <li><a href="../classifiche/piloti.php">Classifica Piloti</a></li>
            <li><a href="../classifiche/squadre.php">Classifica Squadre</a></li>
        </ul>
    </nav>

    <main>
        <h2>Inserisci Risultato Gara</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($gare) || empty($piloti)): ?>
            <div class="alert alert-error">
                Devi prima inserire almeno una gara e almeno un pilota!
            </div>
        <?php else: ?>
            <form method="POST" style="max-width: 500px; margin-bottom: 40px;">
                <input type="hidden" name="action" value="insert">

                <div class="form-group">
                    <label for="gara_select">Seleziona Gara:</label>
                    <select id="gara_select" required onchange="updateGaraFields()">
                        <option value="">Seleziona una gara</option>
                        <?php foreach ($gare as $g): ?>
                            <option value="<?php echo htmlspecialchars($g->nome_campionato) . '|' . $g->giorno . '|' . $g->mese . '|' . $g->anno; ?>">
                                <?php echo htmlspecialchars($g->nome_gara) . ' - ' . sprintf("%02d/%02d/%d", $g->giorno, $g->mese, $g->anno); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cf_pilota">Pilota:</label>
                    <select id="cf_pilota" name="cf_pilota" required>
                        <option value="">Seleziona un pilota</option>
                        <?php foreach ($piloti as $p): ?>
                            <option value="<?php echo htmlspecialchars($p->cf); ?>">
                                <?php echo htmlspecialchars($p->nome . ' ' . $p->cognome . ' (#' . $p->numero . ' - ' . $p->casa_nome . ')'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nome_campionato">Campionato:</label>
                    <input type="text" id="nome_campionato" name="nome_campionato" readonly required>
                </div>

                <div class="form-group">
                    <label for="giorno">Giorno:</label>
                    <input type="number" id="giorno" name="giorno" readonly required>
                </div>

                <div class="form-group">
                    <label for="mese">Mese:</label>
                    <input type="number" id="mese" name="mese" readonly required>
                </div>

                <div class="form-group">
                    <label for="anno">Anno:</label>
                    <input type="number" id="anno" name="anno" readonly required>
                </div>

                <div class="form-group">
                    <label for="posizione">Posizione:</label>
                    <input type="number" id="posizione" name="posizione" min="1" required>
                </div>

                <div class="form-group">
                    <label for="punti">Punti:</label>
                    <input type="number" id="punti" name="punti" min="0" required>
                </div>

                <div class="form-group">
                    <label for="tempo">Tempo (HH:MM:SS):</label>
                    <input type="time" id="tempo" name="tempo" step="1" required>
                </div>

                <button type="submit" class="btn">Inserisci Risultato</button>
            </form>
        <?php endif; ?>

        <h2>Risultati Registrati</h2>

        <table>
            <thead>
            <tr>
                <th>Gara</th>
                <th>Pilota</th>
                <th>Posizione</th>
                <th>Punti</th>
                <th>Tempo</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($risultati as $r): ?>
                <tr>
                    <td><?php echo htmlspecialchars($r->nome_gara) . ' (' . sprintf("%02d/%02d/%d", $r->giorno, $r->mese, $r->anno) . ')'; ?></td>
                    <td><?php echo htmlspecialchars($r->nome . ' ' . $r->cognome) . ' (#' . $r->numero . ')'; ?></td>
                    <td><?php echo $r->posizione; ?>°</td>
                    <td><?php echo $r->punti; ?></td>
                    <td><?php echo $r->tempo; ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="cf_pilota"
                                   value="<?php echo htmlspecialchars($r->cf_pilota); ?>">
                            <input type="hidden" name="nome_campionato"
                                   value="<?php echo htmlspecialchars($r->nome_campionato); ?>">
                            <input type="hidden" name="giorno" value="<?php echo $r->giorno; ?>">
                            <input type="hidden" name="mese" value="<?php echo $r->mese; ?>">
                            <input type="hidden" name="anno" value="<?php echo $r->anno; ?>">
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo risultato?')">Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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
</script>
</body>
</html>