<?php

    /*
        Gloria Moreno       8-924-2038
        Jonathan Gómez      8-1002-785
        Juan García         8-1016-228
        Miguel Caballero    8-957-2172
    */
    $cel = 86.0;
    $fah = 0.0;

    $fah = $cel * 1.6;  
    $fah = 49.0;
    
    echo $fah;
    if ($fah < 50){
        echo "frio";
    } else if($fah>= 50 && $fah <= 86){
            /*
                
            */
        echo "templado";

    } else {
        echo "caliente";
    }

    /*
        Algoritmo que pase de cel a farenheit y que decida 
        frio menos de 50F
        temprado 50-86f
        caliente 86f    
        return $peso / $altura **2;
    */

   //------------

        //PROBLEMA 2:
        //Con PHP, realizar una calculadora de IMC(indice de masa corporal), para calcularlo se utiliza la siguiente formula IMC = peso en kg / altura en metros al cuadrado.
        //Si el resultado es menor a 18.5 debe indicar que esta bajo de peso, el rango saludable es cuando el resultado esta entre 18.5 y 24.9, alguien sobrepeso tiene un indice entre 25 y 29.9; y si el resultado da 30 o mas entonces es obesidad.
    
    function Calculadora_IMC(int $peso, float $altura): int
    {
        return $peso / $altura **2;
    
    }
    
    echo 'El resultado de IMC es:' .$res = Calculadora_IMC(70, 1.75);
    
    echo "<br></br>";
    
    if ($res < 18.5) { echo 'Bajo peso';}
    elseif ($res > 25 && $res < 29.9) { echo 'Sobrepeso';}
    elseif ($res > 29) { echo 'Obesidad';}
    else {echo 'Saludable';}
    
    echo "<br></br>";
    

    //---------

        $numA = "6";
    $numb = 5;
    $operador = "+";
 
    switch ($operador) {
        case "+":
            if ($numA == (int)$numA && $numb == (int)$numb) {
                $resultado = $numA + $numb;
                echo "El resultado de la suma es: " . $resultado;
            } else {
                echo "Error: Debes ingresar numeros enteros";
            }
            break;
        case "-":
            if ($numA == (int)$numA && $numb == (int)$numb) {
                $resultado = $numA - $numb;
                echo "El resultado de la resta es: " . $resultado;
            } else {
                echo "Error: Debes ingresar numeros enteros";
            }
            break;
        case "*":
            if ($numA == (int)$numA && $numb == (int)$numb) {
                $resultado = $numA * $numb;
                echo "El resultado de la multiplicación es: " . $resultado;
            } else {
                echo "Error: Debes ingresar numeros enteros";
            }
            break;
        case "/":
            if ($numb != 0) {
                if($numA == (int)$numA && $numb == (int)$numb) {
                    $resultado = $numA / $numb;
                } else {
                    echo "Error: Debes ingresar numeros enteros";
                    break;
                }
                echo "El resultado de la división es: " . $resultado;
            } else {
                echo "Error: División por cero.";
            }
            break;
        default:
            echo "Operador no válido.";
           
    }
 

    
    


?>