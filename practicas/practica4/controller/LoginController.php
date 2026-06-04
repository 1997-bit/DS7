<?php

session_start();

require_once("../config/Json.php");

$json = new Json();

$usuarios = $json->leer("../assets/usuarios.json");

$usuario  = trim($_POST['usuario']  ?? '');
$password = trim($_POST['password'] ?? '');

foreach ($usuarios as $user) {
    if (
        $user['usuario'] === $usuario &&
        password_verify($password, $user['password'])  
    ) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../view/Tareas.php");
        exit();
    }
}

header("Location: ../view/login.php?error=invalido");
exit();