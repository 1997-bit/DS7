<?php

require_once __DIR__ . "/../config/conexion.php";

class Usuario extends Conexion {

    public function insertar($id_usuario, $contrasena, $id_cliente) {

        $conexion = Conexion::Conectar();

        $consulta = $conexion->prepare(
            "INSERT INTO usuario
            (id_usuario, contrasena, id_cliente)
            VALUES
            (:id_usuario, :contrasena, :id_cliente)"
        );

        $consulta->bindParam(':id_usuario', $id_usuario);
        $consulta->bindParam(':contrasena', $contrasena);
        $consulta->bindParam(':id_cliente', $id_cliente);

        $consulta->execute();
    }

    public function obtenerPorUsuario($id_usuario) {

        $conexion = Conexion::Conectar();

        $consulta = $conexion->prepare(
            "SELECT * FROM usuario
             WHERE id_usuario = :id_usuario"
        );

        $consulta->bindParam(':id_usuario', $id_usuario);

        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }


}