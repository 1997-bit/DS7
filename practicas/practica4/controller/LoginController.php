<?php

session_start();

require_once("../config/Json.php");

$json = new Json();

$usuarios = $json->leer("../assets/usuarios.json");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

foreach ($usuarios as $user) {

    if (
        $user['usuario'] == $usuario &&
        $user['password'] == $password
    ) {

        $_SESSION['usuario'] = $usuario;

        header("Location: ../view/Tareas.php");
        exit();
    }
}

echo "Usuario o contraseña incorrectos";
