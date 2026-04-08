

<?php
    include_once("personaje.php");
    include_once("enemigo.php");

    $p1 = new Personaje("juan", 100, 100);
    $e1 = new Enemigo(100.0);
    $bucle = true;
    while($bucle == true){
        $input = 1;
        switch($input){
            case 1:

               echo $p1->nombre; 
                /*y
                $p1->habilidades[] = "Fuerza";
                $p1->habilidades[] = "Agua"; 

                for ($i=0; $i<2;$i++){
                    echo $p1->habilidades[$i];
                }
                    
                echo "vida: " 
                . $p1->getVida() 
                . " Nombre: " 
                . $p1->getNombre()
                . "Mana: "
                . $p1->getMana() 
                ;

                echo "\n" . $e1->getVida();

                */
                $bucle = false;
                break;
            case 2:
                
        }
    }
?>