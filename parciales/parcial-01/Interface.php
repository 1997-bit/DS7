<?php
    interface interDaño{
        /*
        Interface.php será la interfaz que heredará el método calcularDaño() 
        a DañoFijo.php y DanioCritico.php.
        */
        public function calcularDaño($daño);
    }
?>