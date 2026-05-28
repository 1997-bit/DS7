<?php

class Tarea
{
    private $id;
    private $usuario;
    private $descripcion;
    private $estado;

    public function __construct(
        $id,
        $usuario,
        $descripcion,
        $estado = "por hacer"
    ) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "usuario" => $this->usuario,
            "descripcion" => $this->descripcion,
            "estado" => $this->estado
        ];
    }
}
