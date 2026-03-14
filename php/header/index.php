<?php

$num = -10;

if ($num < 0) {
//    die("Numero negativo non consentito");
//        header("Location: error_page.php?msg=Numero negativo");
    $message = "Numero Negativo";
    http_response_code(413);
    include "error_page.php"; //cosi fa una richiesta e una risposta, non due
}