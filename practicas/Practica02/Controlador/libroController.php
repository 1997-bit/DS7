<?php
require_once __DIR__ . "/../Models/Libro.php";

class LibroController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Libro();
    }

    public function procesarAccion() {
        $accion = $_GET['action'] ?? 'listar';

        switch ($accion) {
            case 'guardar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Se recomienda trim() para limpiar espacios [14]
                    $this->modelo->insertar(trim($_POST['nombre']), trim($_POST['autor']), trim($_POST['categoria']), $_POST['anio']);
                    header("Location: ../Index.php");
                }
                break;
            case 'editar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->modelo->actualizar($_POST['id'], $_POST['nombre'], $_POST['autor'], $_POST['categoria'], $_POST['anio']);
                    header("Location: ../Index.php");
                }
                break;
            case 'eliminar':
                $this->modelo->eliminar($_GET['id']);
                header("Location: ../Index.php");
                break;
        }
    }
}

// Inicializar el controlador para capturar la petición
$controller = new LibroController();
$controller->procesarAccion();
?>