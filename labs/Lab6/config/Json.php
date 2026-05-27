<?php

class Json
{
    private $archivo = "../assets/productos.json";

    public function leer()
    {
        if (!file_exists($this->archivo)) {
            file_put_contents($this->archivo, "[]");
        }

        $json = file_get_contents($this->archivo);

        return json_decode($json, true);
    }

    public function guardar($productos)
    {
        file_put_contents(
            $this->archivo,
            json_encode($productos, JSON_PRETTY_PRINT)
        );
    }
}
