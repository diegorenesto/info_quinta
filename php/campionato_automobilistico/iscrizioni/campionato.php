<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$message = '';
$messageType = '';

// gestione inserimento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // inserimento nuovo campionato
        if ($_POST['action'] === 'insert') {
            $nome = $_POST['nome'];
            $anno = $_POST['anno'];

            try {
                $stmt = $db->prepare("INSERT INTO campionato (nome, anno) VALUES (?, ?)");
                $stmt->execute([$nome, $anno]);
                $message = "Campionato inserito con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        } // eliminazione campionato
        elseif ($_POST['action'] === 'delete') {
            $nome = $_POST['nome'];

            try {
                $stmt = $db->prepare("DELETE FROM campionato WHERE nome = ?");
                $stmt->execute([$nome]);
                $message = "Campionato eliminato con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}

$campionati = $db->query("SELECT * FROM campionato ORDER BY anno DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Campionati</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Gestione Campionati</h1>
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
        <h2>Inserisci Nuovo Campionato</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="max-width: 500px; margin-bottom: 40px;">
            <input type="hidden" name="action" value="insert">

            <div class="form-group">
                <label for="nome">Nome Campionato:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="anno">Anno:</label>
                <input type="number" id="anno" name="anno" min="1900" max="2100" value="<?php echo date('Y'); ?>"
                       required>
            </div>

            <button type="submit" class="btn">Inserisci Campionato</button>
        </form>

        <h2>Campionati Registrati</h2>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Anno</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($campionati as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c->nome); ?></td>
                    <td><?php echo $c->anno; ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="nome" value="<?php echo htmlspecialchars($c->nome); ?>">
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo campionato?')">Elimina
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