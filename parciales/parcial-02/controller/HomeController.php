<?php
// HomeController.php — todo lo del aspirante autenticado

class HomeController {

    public function index(): void {
        require __DIR__ . '/../view/aspirante/home.php';
    }

    public function perfil(): void {
        require __DIR__ . '/../view/aspirante/perfil.php';
    }

    public function formulario(): void {
        require __DIR__ . '/../view/aspirante/formulario.php';
    }
}