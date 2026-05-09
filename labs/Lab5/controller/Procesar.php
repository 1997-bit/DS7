<?php
require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../model/usuario.php";
//sesion llamada
require_once __DIR__ . "/../config/session.php";

require_once __DIR__ . "/../model/Cliente.php";
require_once __DIR__ . "/../model/Orden.php";
require_once __DIR__ . "/../model/OrdenServicio.php";
require_once __DIR__ . "/../model/Servicio.php";

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

        if (!$data) {
            header("location: ../view/Login.php?error=credenciales");
            exit();
        }

        $_SESSION["id"] = $data["id"];
        $_SESSION["usuario"] = $data["usuario"];

        header("Location: ../view/Formulario.php");
        exit;
    } catch (PDOException $e) {
        exit("ERROR");
    }
}



if ($accion === "orden") {

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $fecha = $_POST["fecha_nacimiento"];
    $genero = $_POST["genero"];
    $nacionalidad = trim($_POST["nacionalidad"]);
    $direccion = trim($_POST["direccion"]);
    $email = trim($_POST["email"]);

    $cantidades = $_POST["cantidad"] ?? [];

    $servicioModel = new Servicio();

    $serviciosDB = $servicioModel->obtenerTodos();

    $precios = [];

    foreach ($serviciosDB as $servicio) {

        $precios[$servicio["id"]] =
            $servicio["precio"];
    }

    $precios = [
        1 => 25,
        2 => 15,
        3 => 10,
        4 => 20,
        5 => 30
    ];

    $totalGeneral = 0;

    foreach ($cantidades as $idServicio => $cantidad) {

        $cantidad = (int)$cantidad;

        if ($cantidad <= 0) {
            continue;
        }

        $subtotal = $cantidad * $precios[$idServicio];

        $totalGeneral += $subtotal;
    }

    try {

        // CLIENTE

        $clienteModel = new Cliente();

        $idCliente = $clienteModel->crear(
            $nombre,
            $apellido,
            $fecha,
            $genero,
            $nacionalidad,
            $direccion,
            $email
        );

        // ORDEN

        $ordenModel = new Orden();

        $idOrden = $ordenModel->crear(
            $idCliente,
            $totalGeneral
        );

        // DETALLE

        $ordenServicioModel = new OrdenServicio();

        foreach ($cantidades as $idServicio => $cantidad) {

            $cantidad = (int)$cantidad;

            if ($cantidad <= 0) {
                continue;
            }

            $subtotal = $cantidad * $precios[$idServicio];

            $ordenServicioModel->crear(
                $idOrden,
                $idServicio,
                $cantidad,
                $subtotal
            );
        }

        $_SESSION["cliente"] = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "fecha_nacimiento" => $fecha,
            "genero" => $genero,
            "nacionalidad" => $nacionalidad,
            "direccion" => $direccion,
            "email" => $email
        ];

        $_SESSION["cantidad"] = $cantidades;

        header("Location: ../view/Salida.php");
        exit;
    } catch (PDOException $e) {

        exit($e->getMessage());
    }
}
