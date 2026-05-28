<?php

class Json
{
    public function leer($archivo)
    {
        if (!file_exists($archivo)) {
            file_put_contents($archivo, "[]");
        }

        $json = file_get_contents($archivo);

        return json_decode($json, true);
    }

    public function guardar($archivo, $datos)
    {
        file_put_contents(
            $archivo,
            json_encode($datos, JSON_PRETTY_PRINT)
        );
    }
}
