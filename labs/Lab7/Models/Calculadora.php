<?php
// Define la lógica de negocio. Es la clase que el servidor "mapeará" para exponer sus métodos.
    
class Calculadora {
    public function sumar($n1, $n2) { return $n1 + $n2; }
    public function restar($n1, $n2) { return $n1 - $n2; }
    public function multiplicar($n1, $n2) { return $n1 * $n2; }
    
    public function dividir($n1, $n2) {
        if ($n2 == 0) {
            //Falla mediante SoapFault
            throw new SoapFault("Server", "Error: División por cero.");
        }
        return $n1 / $n2;
    }
}
?>