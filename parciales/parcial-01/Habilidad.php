<?php
    class Habilidad{
        /*
        La clase Habilidad debe tener como atributos básicos: nombre, costoMana, danñoBase y tipoDaño. 
        Este último será el objeto que implementa el tipo de daño usando las clases de daño. 
        Debe incluir los getters y el método calcularDanio(), 
        que será el encargado de delegar el cálculo del daño a la clase correspondiente.

        */
        protected $nombre
        protected $costoMana
        protected $dañoBase
        
        public function __construct($nombre, $costoMana, $dañoBase){
            $this->nombre=$nombre;
            $this->costoMana=$costoMana;
            $this->dañoBase=$dañoBase;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getCostoMana(){
            return $this->costoMana;
        }

        public function getDañoBase(){
            return $this->dañoBase;
        }

    }
?>