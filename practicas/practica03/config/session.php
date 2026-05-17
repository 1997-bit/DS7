<?php
session_start();

require_once __DIR__ . "/conexion.php";
require_once __DIR__ . "/../model/Recordarme.php";
require_once __DIR__ . "/../model/Usuario.php";


if(isset($_SESSION["id"])) return;


if(!isset($_COOKIE["recuerdame"])) return;

$token = $_COOKIE["recuerdame"];

$rec = new Recordarme();
$row = $rec->buscar($token);

if(!$row){
    setcookie("recuerdame","",time()-3600,"/");
    return;
}

/* token válido → crear sesión automática */
$userModel = new Usuario();
$user = $userModel->obtenerPorId($row["id_usuario"]);

if(!$user){
    setcookie("recuerdame","",time()-3600,"/");
    return;
}

$_SESSION["id"] = $user["id"];
$_SESSION["usuario"] = $user["id_usuario"];