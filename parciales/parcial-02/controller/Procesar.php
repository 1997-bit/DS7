<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../core/Security.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("NO POST");
}

$accion = $_POST["accion"] ?? "";

if ($accion === "login") {

    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    $model = new Usuario();
    $data = $model->login($usuario, $contrasena);

    if (!$data) {
        header("Location: /login?error=credenciales");
        exit;
    }

    session_regenerate_id(true);

    $_SESSION["aspirante_id"] = $data["id"];
    $_SESSION["usuario"] = $data["usuario"];

    if ((int)$data["perfil_completo"] === 0) {
        header("Location: /formulario");
        exit;
    }

    header("Location: /home");
    exit;
}

if ($accion === "registro") {

    $usuario = $_POST["usuario"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if ($usuario === '' || $contrasena === '') {
        header("Location: /login?error=empty");
        exit;
    }

    $model = new Usuario();
    $model->registrar($usuario, $contrasena);

    header("Location: /login?registro=ok");
    exit;
}

if ($accion === "perfil") {

    $idUsuario = $_SESSION["aspirante_id"] ?? null;

    if (!$idUsuario) {
        header("Location: /login");
        exit;
    }

    require_once __DIR__ . "/../models/Perfil.php";

    $model = new Perfil();

    $datos = [
        'cedula' => $_POST['documento'],
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'estado_civil' => $_POST['estado_civil'] ?? null,
        'genero' => $_POST['genero'],
        'tipo_sangre' => $_POST['sangre'] ?? null,
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'nacionalidad' => $_POST['nacionalidad'],
        'telefono' => $_POST['telefono'],
        'residencia' => $_POST['residencia'],
        'correo' => $_POST['correo'],
    ];

    if ($model->existe($idUsuario)) {
        $model->actualizar($idUsuario, $datos);
    } else {
        $model->crear($idUsuario, $datos);
    }

    $pdo = Conexion::Conectar();
    $pdo->prepare("UPDATE usuario SET perfil_completo = 1 WHERE id = ?")
        ->execute([$idUsuario]);

    $_SESSION["perfil_completo"] = true;

    header("Location: /home");
    exit;
}