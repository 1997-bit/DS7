<?php

class Database
{
    private $host = "localhost";
    private $dbname = "veterinaria";
    private $username = "root";
    private $password = "";

    public function getConnection()
    {
        try {
            $conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexion;
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'error' => 'Error de conexion a la base de datos'
            ]);
            exit;
        }
    }
}
