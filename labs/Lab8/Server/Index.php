<?php
header("Content-Type: application/json");
require_once "../Controllers/LibroController.php";


ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");
require_once "../Controllers/LibroController.php";

$controller = new LibroController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':    $controller->getAll();  break;
    case 'POST':   $controller->create();  break;
    case 'PUT':    $controller->update();  break;
    case 'DELETE': $controller->delete();  break;
}
?>

