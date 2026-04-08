<?php

require_once 'Colaborador.php';
require_once 'ColaboradorTiempoCompleto.php';
require_once 'ColaboradorPorComision.php';
require_once 'ColaboradorPorHora.php';

$colaboradores = [
    new ColaboradorTiempoCompleto("Juan Perez", 3000, "12345"),
    new ColaboradorPorComision("Maria Gomez", 2000, "67890", 500),
    new ColaboradorPorHora("Carlos Sanchez", 0, "54321", 15, 160)
];

foreach ($colaboradores as $colaborador) {
    
    $colaborador->mostrarInformacion();
}
?>