<?php

header ("Content-Type: application/json");

$archivo = "usuarios.json";
$contenido = file_get_contents($archivo);

echo $contenido


?>