<?php

require_once __DIR__ . "/../config/conexion.php";

class Cliente
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function crear(
        $nombre,
        $apellido,
        $fecha,
        $genero,
        $nacionalidad,
        $direccion,
        $email
    ) {

        $sql = "INSERT INTO cliente
        (
            nombre,
            apellido,
            fecha_nacimiento,
            genero,
            nacionalidad,
            direccion,
            email
        )
        VALUES
        (
            :nombre,
            :apellido,
            :fecha,
            :genero,
            :nacionalidad,
            :direccion,
            :email
        )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':fecha' => $fecha,
            ':genero' => $genero,
            ':nacionalidad' => $nacionalidad,
            ':direccion' => $direccion,
            ':email' => $email
        ]);

        return $this->pdo->lastInsertId();
    }
}
