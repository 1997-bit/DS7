<?php

class Json
{
    private $archivoUsuarios = "../assets/usuarios.json";
    private $archivoTareas = "../assets/tareas.json";

    public function leerUsuarios()
    {
        if (!file_exists($this->archivoUsuarios)) {
            file_put_contents($this->archivoUsuarios, "[]");
        }

        $json = file_get_contents($this->archivoUsuarios);
        return json_decode($json, true);
    }

    public function leerTareas()
    {
        if (!file_exists($this->archivoTareas)) {
            file_put_contents($this->archivoTareas, "[]");
        }

        $json = file_get_contents($this->archivoTareas);
        return json_decode($json, true);
    }

    public function guardarUsuarios($usuarios)
    {
        file_put_contents(
            $this->archivoUsuarios,
            json_encode($usuarios, JSON_PRETTY_PRINT)
        );
    }

    public function guardarTareas($tareas)
    {
        file_put_contents(
            $this->archivoTareas,
            json_encode($tareas, JSON_PRETTY_PRINT)
        );
    }
}
