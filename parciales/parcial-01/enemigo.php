<?php
    Class Enemigo{
        
        public $vida = 0.0;


        public function __construct($vida){ 
            $this->vida=$vida;
        }
        public function getVida(){
            return $this->vida;
        }
    }
    
?>