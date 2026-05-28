<?php
session_start();
require_once("../model/Usuario.php");
require_once("../config/Json.php");

$json = new Json();
$accion = $_POST['accion'] ?? null;

if ($accion == "registrar") {
    $usuarios = $json->leerUsuarios();
    $email = $_POST['email'];
    
    foreach ($usuarios as $u) {
        if ($u['email'] === $email) {
            header("Location: ../view/Registro.php");
            exit;
        }
    }
    
    $id = count($usuarios) > 0 ? max(array_column($usuarios, 'id')) + 1 : 1;
    $usuario = new Usuario($id, $_POST['nombre'], $email, $_POST['contrasena']);
    
    $usuarios[] = [
        "id" => $usuario->id,
        "nombre" => $usuario->nombre,
        "email" => $usuario->email,
        "contrasena" => $usuario->contrasena
    ];
    
    $json->guardarUsuarios($usuarios);
    header("Location: ../view/Login.php");
    exit;
}

if ($accion == "login") {
    $usuarios = $json->leerUsuarios();
    
    foreach ($usuarios as $u) {
        if ($u['email'] === $_POST['email']) {
            if (password_verify($_POST['contrasena'], $u['contrasena'])) {
                $_SESSION['usuario_id'] = $u['id'];
                $_SESSION['usuario_nombre'] = $u['nombre'];
                header("Location: ../view/Tareas.php");
                exit;
            }
        }
    }
    
    header("Location: ../view/Login.php");
    exit;
}

if ($accion == "logout") {
    session_destroy();
    header("Location: ../view/Login.php");
    exit;
}
