<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
            $nome = $_POST['nome'];
            $colore = $_POST['colore'];

            try {
                $stmt = $db->prepare("INSERT INTO casa (nome, colore_livrea) VALUES (?, ?)");
                $stmt->execute([$nome, $colore]);
                $message = "Casa automobilistica inserita con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        } elseif ($_POST['action'] === 'delete') {
            $nome = $_POST['nome'];

            try {
                $stmt = $db->prepare("DELETE FROM casa WHERE nome = ?");
                $stmt->execute([$nome]);
                $message = "Casa eliminata con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}

$case = $db->query("SELECT * FROM casa ORDER BY nome")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Case Automobilistiche</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Gestione Case Automobilistiche</h1>
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
        <h2>Inserisci Nuova Casa Automobilistica</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="max-width: 500px; margin-bottom: 40px;">
            <input type="hidden" name="action" value="insert">

            <div class="form-group">
                <label for="nome">Nome Casa:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="colore">Colore Livrea:</label>
                <input type="color" id="colore" name="colore" value="#ff0000" required>
            </div>

            <button type="submit" class="btn">Inserisci Casa</button>
        </form>

        <h2>Case Registrate</h2>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Colore</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($case as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c->nome); ?></td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: <?php echo $c->colore_livrea; ?>; border-radius: 5px;"></div>
                    </td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="nome" value="<?php echo htmlspecialchars($c->nome); ?>">
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sei sicuro di voler eliminare questa casa?')">Elimina
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