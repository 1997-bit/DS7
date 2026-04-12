<?php
    require_once 'Interface.php';

class DañoFijo implements interDaño
{
    public function calcularDaño($daño)
    {
        return $daño;
    }
}

?>