<?php
require_once "Claseprincipal.php";

$obj = new Claseprincipal();

$nombre = $_GET["nombre"];
$peso   = $_GET["peso"];
$altura = $_GET["altura"];
?>

<h2>Resultado IMC (GET)</h2>

<?php
$obj->calcularIMC($nombre,$peso,$altura);
?>

<h2>Datos del servidor</h2>

<?php
$obj->mostrarServidor();
?>