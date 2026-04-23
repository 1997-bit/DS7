<?php
/*
    Gloria Moreno       8-924-2038
    Jonathan Gómez      8-1002-785
    Juan García         8-1016-228
    Miguel Caballero    8-957-2172
*/


// Buena prac = Asignar valor inicial
$nombre = "Juan";
echo ("hola mundo");
echo "hola mundo";
echo "hola" , $nombre, "!";

print("Hola ,Mundo");
$r = print("holaMundo");
echo $r;

echo "<br></br>";

$nombre = "mundo";
$n = 42;
printf("hola, %s! N°: %d", $nombre, $n);

$p = 1234.5678;


echo "\n";
$entero = 1;
$flotante = 3.12;

$n = 123;
$s = "El número es " . $n;
$s = 100;

echo "<br></br>";

$r = $s + 50; //150
$r = 10 +true; // Igual 11
echo $r;

$s =123.45;
$i = (int) $s; 
echo $i;
echo "\n";

$n = 150;
$s = (string) $n;
echo $s;

//-----

echo "<br></br>" . "<h2>Operadores</h2>". "<br></br>";
echo $a = 2 + $b =3;
echo "<br></br>";
echo $a = 10 * $b =6;
echo "<br></br>";
echo $a = 20 / $b =4;
echo "<br></br>";
echo $a = 10 % $b =3;
echo "<br></br>";
echo $a = 2 ** $b =3;


// ===  != == !== < >   

// Nave espacial <=>

//XOR devuelve true si UNO y SOLO UNO es verdadero
// true xor false = true
// true xor true = flase

echo "<br></br>" . "<h2>Funciones</h2>". "<br></br>";
function saludar(){
    echo "hola mundo";

}
saludar();

echo "<br></br>";

//Función con Parámetros
function sumar($a,$b){
    return $a+ $b;
}
$res = sumar(5,3);
echo $res;
echo "<br></br>";

function saludar2($nombre = "JUAN"){
    echo "hola," . $nombre;
}
saludar2();
echo "<br></br>";

function multiplicar(int $a, int $b){
    return $a * $b;
}
$res = multiplicar(32432,3);
echo $res;


/*
Comentario
*/
#Shell
//Comentario
?>