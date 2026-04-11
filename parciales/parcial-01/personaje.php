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

        //Metodo usarHabilidad()
        public function usarHabilidad(string $nombreHab, Personaje $objetivo) {
            if (!isset($this->habilidades[$nombreHab])) {
                throw new Exception("Error: El personaje no conoce la habilidad '$nombreHab'.");
            }

            $habilidad = $this->habilidades[$nombreHab];

            // 2. Validar mana suficiente [1]
            if ($this->mana < $habilidad->getCosteMana()) {
                throw new Exception("Error: Mana insuficiente para usar " . $habilidad->getNombre() . ".");
            }

            $this->mana -= $habilidad->getCosteMana();

            $danio = $habilidad->calcularDanio();
            $objetivo->recibirDanio($danio);
        }



        //Metodo aprenderHabilidad() o agregarHabilidad() al personaje
        public function aprenderHabilidad(Habilidad $habilidad) {
            $this->habilidades[$habilidad->getNombre()] = $habilidad;
            echo "- {$this->nombre} aprendió: " . $habilidad->getNombre() . "<br>";
        }
    }
?>