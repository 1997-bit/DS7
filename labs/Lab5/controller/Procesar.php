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

    if ($usuario === "" || $contrasena === "") exit("Campos vacíos");
    if (strlen($usuario) < 3 || strlen($usuario) > 11) exit("Usuario 3–11");
    if (strlen($contrasena) < 5) exit("Pass min 5");

    try {
        $model = new Usuario();
        $model->registrar($usuario, $contrasena);

        header("Location: ../view/Login.php?registro=ok");
        exit;

    } catch (PDOException $e) {
       exit("ERROR");
    }
}

// LONGIN
if ($accion === "login") {

    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($usuario === "" || $contrasena === "") exit("Campos vacíos");

    try {
        $model = new Usuario();
        $data = $model->login($usuario, $contrasena);

        if (!$data) exit("Credenciales incorrectas");

        session_start();
        $_SESSION["id"] = $data["id"];
        $_SESSION["usuario"] = $data["usuario"];

        header("Location: ../view/Formulario.php");
        exit;

    } catch (PDOException $e) {
        exit("ERROR");
    }
}


if ($accion === "orden") {

    //TODO: orden
}

?>