<?php

$allowed = ["jpg", "png", "pdf", "php"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_FILES["documento"]["error"] === UPLOAD_ERR_OK) {

        $tmp_path = $_FILES["documento"]["tmp_name"];
//        echo $tmp_path . "<br>";
        $original_name = basename($_FILES["documento"]["name"]);
//        echo $original_name . "<br>";
        $username = $_POST["nome"];
//        echo $username . "<br>";

        //extension check
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            http_response_code(403);
            $msg = "estensione non autorizzata";
            include "message.php";
            exit();
        }

        $max_size = 2 * 1024 * 1024;
        $size = $_FILES["documento"]["size"];
        if ($size > $max_size) {
            http_response_code(413);
            $msg = "file troppo grande";
            include "message.php";
            exit();
        }

        $user_dir = "uploads/" . $username;
        if (!is_dir($user_dir)) {
            mkdir($user_dir, 0755);
        }

        $destination = $user_dir . "/" . $original_name;
        move_uploaded_file($tmp_path, $destination);
        $msg = "File caricato correttamente";
        include "message.php";
    } else {
        http_response_code(500);
        $msg = "Errore nel caricamento";
        include "message.php";
    }
}