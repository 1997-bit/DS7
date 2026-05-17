<?php
// controller/AuthController.php

class AuthController {

    public function mostrarLogin(): void {
        require BASE_PATH . 'view/aspirante/login.php';
    }

    public function mostrarRegistro(): void {
        require BASE_PATH . 'view/aspirante/registro.php';
    }

    public function cerrarSesion(): void {
        header('Location: /login'); exit;
    }
}