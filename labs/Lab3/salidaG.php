<?php
require_once "Claseprincipal.php";

$obj = new ClasePrincipal();
$datos = $obj->calcularIMCGET();
$server = $obj->serverData();
?>

<h2>Resultado IMC (GET)</h2>

Nombre: <?= $datos["nombre"] ?><br>
Peso: <?= $datos["peso"] ?> kg<br>
Altura: <?= $datos["altura"] ?> m<br>
IMC: <?= number_format($datos["imc"],2) ?><br>

<h2>Datos del servidor</h2>

<?php
foreach($server as $k=>$v){
    echo $k . " : " . $v . "<br>";
}
?>