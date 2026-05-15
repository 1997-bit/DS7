<?php
// controller/RhAuthController.php

class RhAuthController {

    public function mostrarLogin(): void {
        require BASE_PATH . 'view/rh/login.php';
    }
    
    public function index(): void {
        require BASE_PATH . '/../view/rh/home.php';
    }


    public function cerrarSesion(): void {
        header('Location: /rh/login'); exit;
    }
}