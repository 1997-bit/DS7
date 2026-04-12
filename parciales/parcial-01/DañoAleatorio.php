<?php
require_once 'Interface.php';
 class DañoAleatorio implements interDaño {
    public function calcularDaño($daño) {
        $aleatorio = mt_rand(0,1); //si da 0 no es critico si da 1 es daño critico
        if($aleatorio == 1){
            return $daño * 1.5; //multiplicador de daño critico
        }
        return $daño;
    }
 }
    /*
    DanioCritico.php debe generar un valor aleatorio (por ejemplo entre 0 y 1) 
    para decidir si el ataque es crítico. Si el ataque es crítico, el daño debe multiplicarse por 1.5; 
    de lo contrario, debe devolver el daño base.
    */
?>