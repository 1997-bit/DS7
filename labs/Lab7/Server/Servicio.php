<?php
//Actúa como el punto de acceso (endpoint). 
require_once "../Models/Calculadora.php";

// El servidor delega su estructura al contrato WSDL
$wsdl = "servicio.wsdl";
$server = new SoapServer($wsdl);
$server->setClass('Calculadora');
$server->handle(); 
?>