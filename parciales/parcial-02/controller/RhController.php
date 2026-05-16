<?php
// RhController.php

class RhController {
/*
  public function index(): void {
        require BASE_PATH . '/../view/rh/home.php';
    }
*/
    public function solicitudes(): void {
        require __DIR__ . '/../view/rh/aplicantes.php';
    }

    public function aplicante(): void {
        require __DIR__ . '/../view/rh/detalle_aplicante.php';
    }

    public function estado(): void {
        // TODO: cambiar estado
        header('Location: ?url=rh/solicitudes'); exit;
    }
}