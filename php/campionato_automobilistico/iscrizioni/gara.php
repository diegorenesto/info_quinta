<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$message = '';
$messageType = '';

$campionati = $db->query("SELECT nome FROM campionato ORDER BY anno DESC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
            $nome_campionato = $_POST['nome_campionato'];
            $giorno = $_POST['giorno'];
            $mese = $_POST['mese'];
            $anno = $_POST['anno'];
            $nome_gara = $_POST['nome_gara'];

            try {
                $stmt = $db->prepare("INSERT INTO gara (nome_campionato, giorno, mese, anno, nome_gara) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nome_campionato, $giorno, $mese, $anno, $nome_gara]);
                $message = "Gara inserita con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        } elseif ($_POST['action'] === 'delete') {
            $nome_campionato = $_POST['nome_campionato'];
            $giorno = $_POST['giorno'];
            $mese = $_POST['mese'];
            $anno = $_POST['anno'];

            try {
                $stmt = $db->prepare("DELETE FROM gara WHERE nome_campionato = ? AND giorno = ? AND mese = ? AND anno = ?");
                $stmt->execute([$nome_campionato, $giorno, $mese, $anno]);
                $message = "Gara eliminata con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}

$gare = $db->query("
    SELECT g.*, c.nome as campionato_nome 
    FROM gara g 
    JOIN campionato c ON g.nome_campionato = c.nome 
    ORDER BY g.anno DESC, g.mese DESC, g.giorno DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Gare</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Gestione Gare</h1>
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
        <h2>Inserisci Nuova Gara</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($campionati)): ?>
            <div class="alert alert-error">
                Devi prima inserire almeno un campionato!
            </div>
        <?php else: ?>
            <form method="POST" style="max-width: 500px; margin-bottom: 40px;">
                <input type="hidden" name="action" value="insert">

                <div class="form-group">
                    <label for="nome_campionato">Campionato:</label>
                    <select id="nome_campionato" name="nome_campionato" required>
                        <option value="">Seleziona un campionato</option>
                        <?php foreach ($campionati as $c): ?>
                            <option value="<?php echo htmlspecialchars($c->nome); ?>">
                                <?php echo htmlspecialchars($c->nome); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nome_gara">Nome Gara:</label>
                    <input type="text" id="nome_gara" name="nome_gara" required>
                </div>

                <div class="form-group">
                    <label for="giorno">Giorno:</label>
                    <input type="number" id="giorno" name="giorno" min="1" max="31" required>
                </div>

                <div class="form-group">
                    <label for="mese">Mese:</label>
                    <input type="number" id="mese" name="mese" min="1" max="12" required>
                </div>

                <div class="form-group">
                    <label for="anno">Anno:</label>
                    <input type="number" id="anno" name="anno" min="1900" max="2100" value="<?php echo date('Y'); ?>"
                           required>
                </div>

                <button type="submit" class="btn">Inserisci Gara</button>
            </form>
        <?php endif; ?>

        <h2>Gare Registrate</h2>

        <table>
            <thead>
            <tr>
                <th>Campionato</th>
                <th>Nome Gara</th>
                <th>Data</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($gare as $g): ?>
                <tr>
                    <td><?php echo htmlspecialchars($g->nome_campionato); ?></td>
                    <td><?php echo htmlspecialchars($g->nome_gara); ?></td>
                    <td><?php echo sprintf("%02d/%02d/%d", $g->giorno, $g->mese, $g->anno); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="nome_campionato"
                                   value="<?php echo htmlspecialchars($g->nome_campionato); ?>">
                            <input type="hidden" name="giorno" value="<?php echo $g->giorno; ?>">
                            <input type="hidden" name="mese" value="<?php echo $g->mese; ?>">
                            <input type="hidden" name="anno" value="<?php echo $g->anno; ?>">
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sei sicuro di voler eliminare questa gara?')">Elimina
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
</body>
</html>