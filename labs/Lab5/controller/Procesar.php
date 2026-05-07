<?php
require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../model/usuario.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Método no permitido");
}

$accion = $_POST["accion"] ?? "";

  // ROUTER
if ($accion === "registro") {

    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($usuario === "" || $contrasena === "") {
        exit("Campos vacíos");
    }

    if (strlen($usuario) < 3 || strlen($usuario) > 10) {
        exit("Usuario inválido");
    }

    if (strlen($contrasena) < 5) {
        exit("Password muy corta");
    }

  

    header("Location: ../view/Login.php");
    exit;
}

// LONGIN
if ($accion === "login") {

    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($usuario === "" || $contrasena === "") {
        exit("Campos vacíos");
    }

    header("Location: ../view/Formulario.php");
    exit;
}


if ($accion === "orden") {

    //TODO: orden
}

?>