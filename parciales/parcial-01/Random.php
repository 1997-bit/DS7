<?php
class RandomPool{
    public function rVida(){
        return rand(100,125);
    }

    public function rVidaEne(){
        return rand(100,300);
    }
    
    public function rDaño(){
        return rand(10,32);
    }

    public function rCostMana(){
        return rand(7,20);
    }
    
    public function rMana(){
        return rand(75,100);
    }

    public function rDañoEne(){
        return rand(15,23);
    }
}
?>