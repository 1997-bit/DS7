<?php

require_once "../config/Json.php";
require_once "../model/Usuario.php";

$archivo = "../assets/usuarios.json";
$json = new Json();

$accion = $_POST['accion'] ?? '';

if ($accion == "registro") {
    $usuario   = trim($_POST["usuario"]   ?? '');
    $contrasena = trim($_POST["contrasena"] ?? '');

    if (empty($usuario) || empty($contrasena)) {
        header("Location: ../view/registro.php?error=campos_vacios");
        exit();
    }

    $usuarios = $json->leer($archivo);

    foreach ($usuarios as $u) {
        if ($u['usuario'] === $usuario) {
            header("Location: ../view/registro.php?error=usuario_existe");
            exit();
        }
    }

    $nuevoUsuario = new Usuario($usuario, password_hash($contrasena, PASSWORD_DEFAULT));

    $usuarios[] = [
        "usuario"  => $nuevoUsuario->getUsuario(),
        "password" => $nuevoUsuario->getPassword()
    ];

    $json->guardar($archivo, $usuarios);

    header("Location: ../view/login.php?registro=exitoso");
    exit();
}