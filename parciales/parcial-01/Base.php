<?php
   abstract class Base{
        protected $nombre;
        protected $vida;
        protected $mana;
        protected $inventario; // esto es un arreglo btw

        public function __construct($nombre,$vida,$mana, $inventario=[]){
            $this->nombre = $nombre;
            $this->vida = $vida;
            $this->mana = $mana;
            $this->inventario = $inventario; // Pa inicializar vacio 
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

        public function dañoFijo($daño){
            $this->vida = $this->vida - $daño; 
        }

        public function dañoAleatorio($daño){
            $chance;
            $multiplicador = 1.5;
            $chance = rand(0,1);
            
            /*  Debug
            $chance = 1; 
            $multiplicador = 200
            */

            if($chance == 1){
                $this->vida = $this->vida - ($daño * $multiplicador);
            } else{
                $this->vida = dañoFijo($daño);
            }
        }
    }
?>