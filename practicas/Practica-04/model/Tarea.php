<?php

class Tarea
{
    public $id;
    public $usuarioId;
    public $titulo;
    public $descripcion;
    public $estado;
    public $fechaCreacion;

    public function __construct($id, $usuarioId, $titulo, $descripcion, $estado = "por hacer")
    {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->fechaCreacion = date('Y-m-d H:i:s');
    }
}
