<?php

class Producto
{
    private $id;
    private $nombre;
    private $marca;
    private $precio;
    private $stock;
    private $tipo;

    public function __construct(
        $id,
        $nombre,
        $marca,
        $precio,
        $stock,
        $tipo
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->tipo = $tipo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "marca" => $this->marca,
            "precio" => $this->precio,
            "stock" => $this->stock,
            "tipo" => $this->tipo
        ];
    }
}
