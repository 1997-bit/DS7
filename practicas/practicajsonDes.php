<?php
$practicajson = file_get_contents("practicajson.json");
$productos = json_decode($practicajson);

foreach($productos as $producto) {
    echo $producto->nombre . " - $".
        $producto->precio . "\n";    
}
?>
