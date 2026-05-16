<?php
require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../model/usuario.php";
require_once __DIR__ . "/../model/Recordarme.php";

//sesion llamada
require_once __DIR__ . "/../config/session.php";
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

// LOGIN
if ($accion === "login") {

    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($usuario === "" || $contrasena === "") exit("Campos vacíos");

    try {
        $model = new Usuario();
        $data = $model->login($usuario, $contrasena);

        if (!$data){
            header("location: ../view/Login.php?error=credenciales");
            exit();
        }

        // sesión normal
        $_SESSION["id"] = $data["id"];
        $_SESSION["usuario"] = $data["usuario"];

        //recuerdame
        if(isset($_POST["recordarme"])){

            $token = bin2hex(random_bytes(32));

            $rec = new Recordarme();
            $rec->crear($data["id"], $token);

            setcookie("remember",$token,time()+60*60*24*30,"/");
        }

        header("Location: ../view/Formulario.php");
        exit;

    } catch (PDOException $e) {
        exit("ERROR");
    }
}



if ($accion === "orden") {

if (!isset($_SESSION["usuario"])) {
        header("Location: ../view/Login.php?error=sesion");
        exit;
    }




 header("Location: ../view/Salida.php");
    exit;
    //TODO: orden
}

?>