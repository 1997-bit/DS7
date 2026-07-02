<?php

require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../helpers/Token.php';

class LoginController
{
    public function login()
    {
        $datos = json_decode(
            file_get_contents("php://input"),
            true
        );

        if (
            !isset($datos['username']) ||
            !isset($datos['password']) ||
            trim($datos['username']) === '' ||
            trim($datos['password']) === ''
        ) {
            http_response_code(400);

            echo json_encode([
                'error' => 'Usuario y contraseña son obligatorios'
            ]);

            return;
        }

        $modelo = new UsuarioModel();
        $usuario = $modelo->obtenerPorUsername($datos['username']);

        if (!$usuario || !password_verify($datos['password'], $usuario['password'])) {
            http_response_code(401);

            echo json_encode([
                'error' => 'Usuario o contraseña incorrectos'
            ]);

            return;
        }

        $token = Token::generar([
            'id' => $usuario['id'],
            'username' => $usuario['username']
        ]);

        http_response_code(200);

        echo json_encode([
            'mensaje' => 'Login exitoso',
            'token' => $token,
            'usuario' => $usuario['username']
        ]);
    }
}
