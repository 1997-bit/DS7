<?php
// public/index.php

define('BASE_PATH', __DIR__ . '/../');

require_once BASE_PATH . 'config/Conexion.php';

// aliases
$aliases = [
    ''         => 'auth/mostrarLogin',
    'login'    => 'auth/mostrarLogin',
    'registro' => 'auth/mostrarRegistro',
    'logout'   => 'auth/cerrarSesion',
    'rh'       => 'rh/index',
    'rh/login' => 'rhAuth/mostrarLogin',
    'rh/logout'=> 'rhAuth/cerrarSesion',
];

$url = trim($_GET['url'] ?? '', '/');
$url = $aliases[$url] ?? $url;
$partes = explode('/', $url);

$nombreController = ucfirst($partes[0]) . 'Controller';
$metodo = $partes[1] ?? 'index';
$params = array_slice($partes, 2);

$archivo = BASE_PATH . "controller/{$nombreController}.php";


require_once $archivo;

if (!method_exists($nombreController, $metodo)) {
    http_response_code(404);
    $error404 = BASE_PATH . 'view/errors/404.php';
    if (file_exists($error404)) {
        require $error404;
    } else {
        echo '404 - Metodo no encontrado';
    }
    exit;
}

$controller = new $nombreController();
call_user_func_array([$controller, $metodo], $params);