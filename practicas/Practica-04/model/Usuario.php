<?php

class Usuario
{
    public $id;
    public $nombre;
    public $email;
    public $contrasena;

    public function __construct($id, $nombre, $email, $contrasena)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    }
}
