<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php Form</title>
</head>
<body>

<form method="post" action="new_form.php"> <!--method e action obbligatori-->
    <h1>Informasjon</h1>
    <label for="nome">Nome </label><input id="nome" type="text" name="nome"><br>
    <label for="cognome">Cognome </label><input id="nome" type="text" name="cognome"><br>
    <label for="email">Email </label><input id="email" type="email" name="email"><br>
    <label for="password">Password </label><input id="password" type="password" name="password"><br>
    <label for="eta">Eta </label><input id="eta" type="number" name="eta"><br>
    <br>
    <!-- RADIO -->
    <label for="sesso">Sesso</label><br>
    <label for="sessoM">M</label>
    <input id="sessoM" type="radio" name="sesso" value="M">
    <label for="sessoF">F</label>
    <input id="sessoF" type="radio" name="sesso" value="F"><br>
    <br>
    <!-- CHECKBOX -->
    <label for="corsi[]">Corsi: </label><br>
    <label for="corsoPHP">PHP</label>
    <input id="corsoPHP" type="checkbox" name="corsi[]" value="php"><br>
    <label for="corsoJava">Java</label>
    <input id="corsoJava" type="checkbox" name="corsi[]" value="java"><br>
    <label for="corsoHTML">HTML</label>
    <input id="corsoHTML" type="checkbox" name="corsi[]" value="html"><br>
    <br>
    <!-- DROPDOWN LIST-->
    <label for="citta">Città di Residenza</label>
    <select name="citta" id="citta">
        <option value="seleziona">--Seleziona--</option>
        <option value="Rovigo">Rovigo</option>
        <option value="Padova">Padova</option>
        <option value="Ferrara">Ferrara</option>
        <option value="Verona">Verona</option>
    </select><br><br>
    <!-- LIST BOX MULTIPLA -->
    <label for="lingua[]">Lingue Conosciute</label><br>
    <select name="lingua[]" id="lingua" multiple>
        <option value="Inglese">Inglese</option>
        <option value="Francese">Francese</option>
        <option value="Spagnolo">Spagnolo</option>
        <option value="Tedesco">Tedesco</option>
    </select><br><br>

    <label for="area">Parlaci di te...</label><br>
    <textarea name="area" id="area"></textarea><br><br>
    <button type="submit">invia</button>
</form>
</body>
</html>
