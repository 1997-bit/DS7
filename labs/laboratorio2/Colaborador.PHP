<?php

/*

Desarrollor un sistema que modele diferentes tipos de empleados y calcule su salario, aplicando:
Clases y objetos
Atributos publicos y protegidos
Constructores
Herencia
Abstraccion
Polimorfismo
No se permite input del usuario
Los datos deben estar definidos en el código 


Estructura: 

Clase abstracta "Colaborador" con atributos para nombre, el salario base, y su identificacion.
Constructor para inicializar los atributos.
Metodo abstracto
Clases hijas para los colaboradore tiempo completo, colaboradores por comision (Salario = salario base + comision), colaboradores por hora (Salario = tarifa * hora).
Aplique polimorfismo para calcular los salarios de los colaboradores.

Mostrar el nombre, identificacion y salario de cada colaborador.

*/

abstract class Colaborador {
    protected $nombre;
    protected $salarioBase;
    protected $identificacion;

    public function __construct($nombre, $salarioBase, $identificacion) {
        $this->nombre = $nombre;
        $this->salarioBase = $salarioBase;
        $this->identificacion = $identificacion;
    }

    abstract public function calcularSalario();

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdentificacion(){
        return $this->identificacion;
    }

    public function getSalarioBase(){
        return $this->salarioBase;
    }

    public function mostrarInformacion() {
        echo "<strong>Información del Colaborador:</strong><br> <br>     ";
        echo "Nombre: " . $this->getNombre() . "<br>";
        echo "Identificación: " . $this->getIdentificacion() . "<br>";
        echo "Salario: $" . $this->calcularSalario() . "<br><br>";
    }
}
?>


