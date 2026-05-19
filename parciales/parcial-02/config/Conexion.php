<?php
class Conexion
{
    public static function Conectar()
    {

        //Datos de conexion
        $host = 'localhost';
        $baseDeDatos = 'rh_aspirantes';
        $usuario = 'root';
        $contrasena = '';

        //Crear conexion PDO
        $conexion = new PDO(
            "mysql:host=$host;dbname=$baseDeDatos;charset=utf8",
            $usuario,
            $contrasena
        );

        //Lanzar excepciones en errores
        $conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        return $conexion;
    }
}
