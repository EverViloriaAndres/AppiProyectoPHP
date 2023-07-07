<?php
require_once "../assets/headers.php";

require_once  "../Clclientes/login.php";



$cliente= new login();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents('php://input'), true);
    $usr = $datos['usr'];
    $passw = $datos['passw'];
    $resultado = $cliente->Loguear($usr, $passw);

    echo json_encode($resultado, JSON_PRETTY_PRINT);
} else {
    echo 'Nada Por POST';
}
?>
