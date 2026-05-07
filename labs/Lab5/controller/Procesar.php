<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $_SESSION["usuario"] = $usuario;
    $_SESSION["contraseña"] = $contraseña;

    header("Location: ../view/Salida.php");
    exit();
}