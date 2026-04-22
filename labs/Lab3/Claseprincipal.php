<?php
 class Claseprincipal
 {

 public $Nombre;
 public $CorreoElectronico;
 public $Cedula;
 public $Edad;

 public function __construct($nombre, $CorreoElectronico, $cedula, $edad)
 {
    $this->Nombre = $nombre;
    $this->CorreoElectronico = $CorreoElectronico;
    $this->Cedula = $cedula;
    $this->Edad = $edad;
 }


 public function mostrarServidor()
 {
    echo "<div class='servidor'>";
    echo "<br><strong>Informacion del servidor:</strong><br>";
    echo "PHP_SELF: "       . $_SERVER['PHP_SELF']        . "<br>";
    echo "SERVER_NAME: "    . $_SERVER['SERVER_NAME']      . "<br>";
    echo "USER_AGENT: "     . $_SERVER['HTTP_USER_AGENT']  . "<br>";
    echo "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD']   . "<br>";
    echo "REMOTE_ADDR: "    . $_SERVER['REMOTE_ADDR']      . "<br>";
    echo "QUERY_STRING: "   . $_SERVER['QUERY_STRING']     . "<br>";
    echo "</div>";
 }

 }


?>