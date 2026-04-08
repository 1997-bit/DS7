<?php
class Personaje{
    public $nombre = "";
    public $vida = 0;
    public $mana;
    public $habilidades = []; // Nombre Coste | Daño base
    
    //--------------Extra
    public $nivel = 1; //extra
    public $exp = 0.0; //extra
    public $inventario = []; //extra
    public $efectos = []; //extra
    
    public function __construct($nombre,$vida,$mana){
        $this->nombre=$nombre;
        $this->vida=$vida;
        $this->mana=$mana;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getVida(){
        return $this->vida;
    }
    
    public function getMana(){
        return $this->mana;
    }
    
    public function setVida($vida){
        $this->vida=$vida;
    }

    public function validadMana($mana){

    }

    public function dañoCritico(){
        return rand();
    }
}


?>