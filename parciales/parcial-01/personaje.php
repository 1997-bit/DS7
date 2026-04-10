<?php
    class Personaje {

        /* Estrategia
        Personaje.php será la clase para crear todos los personajes so el ogro y Gandalf . 
        Los atributos básicos que debe tener son: nombre, vida, mana y habilidades (arreglo). 
        Debe incluir como mínimo los métodos 
        estaVivo(), usarHabilidad(), aprenderHabilidad() y recibirDanio().

        */
        protected $nombre;
        protected $vida;
        protected $mana;
        protected $habilidades = [];

        public function __construct($nombre,$vida,$mana){
            $this->nombre = $nombre;
            $this->vida = $vida;
            $this->mana = $mana;
        }
        
        public function getVida(){
            return $this->vida;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getMana(){
            return $this->mana;
        }

    }
?>