<?php
class Conexion {
    public static function Conectar() {
        $host = 'localhost';
        $db   = 'biblioteca';
        $user = 'root';
        $pass = '';

        try {
            // Se define el DSN con el charset para evitar problemas de caracteres [5]
            $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            // Se registra el error en el log del servidor en lugar de mostrarlo [6, 7]
            error_log($e->getMessage());
            die("Error crítico: No se pudo establecer la conexión con la base de datos.");
        }
    }
}
?>