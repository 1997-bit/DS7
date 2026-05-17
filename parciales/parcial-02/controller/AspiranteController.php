<?php

class AspiranteController {

    public function index(): void {
        $this->inicio();
    }

    public function inicio(): void {
        require __DIR__ . '/../view/aspirante/home.php';
    }

    public function formulario(): void {
        require __DIR__ . '/../view/aspirante/formulario.php';
    }

    public function mostrarPerfil(): void {
        require __DIR__ . '/../view/aspirante/perfil.php';
    }
}