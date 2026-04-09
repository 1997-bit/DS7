<?php
class ColaboradorPorHora extends Colaborador {
    private $tarifa;
    private $horasTrabajadas;

    public function __construct($nombre, $salarioBase, $identificacion, $tarifa, $horasTrabajadas) {
        parent::__construct($nombre, $salarioBase, $identificacion);
        $this->tarifa = $tarifa;
        $this->horasTrabajadas = $horasTrabajadas;
    }

    public function calcularSalario() {
        return $this ->salarioBase + ($this->tarifa * $this->horasTrabajadas);
    }
}
?>