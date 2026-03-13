<?php
require_once '../config/db.php';
$config = require_once '../config/db_config_casa.php';
$db = db::getDB($config);

$message = '';
$messageType = '';

$case = $db->query("SELECT nome FROM casa ORDER BY nome")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
            $cf = $_POST['cf'];
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $nazionalita = $_POST['nazionalita'];
            $numero = $_POST['numero'];
            $nome_casa = $_POST['nome_casa'];

            try {
                $stmt = $db->prepare("INSERT INTO pilota (cf, nome, cognome, nazionalita, numero, nome_casa) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$cf, $nome, $cognome, $nazionalita, $numero, $nome_casa]);
                $message = "Pilota inserito con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        } elseif ($_POST['action'] === 'delete') {
            $cf = $_POST['cf'];

            try {
                $stmt = $db->prepare("DELETE FROM pilota WHERE cf = ?");
                $stmt->execute([$cf]);
                $message = "Pilota eliminato con successo!";
                $messageType = "success";
            } catch (PDOException $e) {
                $message = "Errore: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}

$piloti = $db->query("
    SELECT p.*, c.colore_livrea 
    FROM pilota p 
    JOIN casa c ON p.nome_casa = c.nome 
    ORDER BY p.cognome, p.nome
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Piloti</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Gestione Piloti</h1>
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
        <h2>Inserisci Nuovo Pilota</h2>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($case)): ?>
            <div class="alert alert-error">
                Devi prima inserire almeno una casa automobilistica!
            </div>
        <?php else: ?>
            <form method="POST" style="max-width: 500px; margin-bottom: 40px;">
                <input type="hidden" name="action" value="insert">

                <div class="form-group">
                    <label for="cf">Codice Fiscale:</label>
                    <input type="text" id="cf" name="cf" maxlength="16" required>
                </div>

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" required>
                </div>

                <div class="form-group">
                    <label for="nazionalita">Nazionalità:</label>
                    <input type="text" id="nazionalita" name="nazionalita" required>
                </div>

                <div class="form-group">
                    <label for="numero">Numero Pilota:</label>
                    <input type="number" id="numero" name="numero" min="1" max="99" required>
                </div>

                <div class="form-group">
                    <label for="nome_casa">Casa Automobilistica:</label>
                    <select id="nome_casa" name="nome_casa" required>
                        <option value="">Seleziona una casa</option>
                        <?php foreach ($case as $c): ?>
                            <option value="<?php echo htmlspecialchars($c->nome); ?>">
                                <?php echo htmlspecialchars($c->nome); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn">Inserisci Pilota</button>
            </form>
        <?php endif; ?>

        <h2>Piloti Registrati</h2>

        <table>
            <thead>
            <tr>
                <th>CF</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Nazionalità</th>
                <th>Numero</th>
                <th>Casa</th>
                <th>Colore</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($piloti as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p->cf); ?></td>
                    <td><?php echo htmlspecialchars($p->nome); ?></td>
                    <td><?php echo htmlspecialchars($p->cognome); ?></td>
                    <td><?php echo htmlspecialchars($p->nazionalita); ?></td>
                    <td><?php echo $p->numero; ?></td>
                    <td><?php echo htmlspecialchars($p->nome_casa); ?></td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: <?php echo $p->colore_livrea; ?>; border-radius: 5px;"></div>
                    </td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="cf" value="<?php echo htmlspecialchars($p->cf); ?>">
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo pilota?')">Elimina
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