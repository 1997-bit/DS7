<?php
 class Claseprincipal
 {

 public $Nombre;
 public $CorreoElectronico;
 public $Cedula;
 public $Edad;

public function __construct($nombre=null,$CorreoElectronico=null,$cedula=null,$edad=null)
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

   public function calcularIMC($nombre,$peso,$altura) {
      $imc = ($peso)/ ($altura * $altura)    
      if ($imc < 18.5) {
         $estado = "Bajo peso";
      } elseif ($imc < 25) {
         $estado = "Normal";
      } elseif ($imc < 30) {
         $estado = "Sobrepeso";
      } else {
         $estado = "Obesidad";
      }     
      echo "Nombre: $nombre <br>";
      echo "IMC: ".round($imc,2)."<br>";
      echo "Estado: $estado <br>";
   }
?>


