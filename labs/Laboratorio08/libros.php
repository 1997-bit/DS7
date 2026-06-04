<?php
// Garantiza el formato de intercambio de datos JSON 
header("Content-Type: application/json");

$archivo = "libros.json";
$metodo = $_SERVER['REQUEST_METHOD']; // Identifica la operación REST

// Lee la "base de datos estática" 
$contenido = file_get_contents($archivo);
$libros = json_decode($contenido, true);

switch ($metodo) {
    case 'GET':
        // Operación: Obtiene libros
        echo json_encode($libros);
        break;

    case 'POST':
        // Operación: Registra libros
        $nuevoLibro = json_decode(file_get_contents('php://input'), true);
        $nuevoLibro['id'] = end($libros)['id'] + 1; // Genera ID automático
        $libros[] = $nuevoLibro;
        
        file_put_contents($archivo, json_encode($libros)); // Persistencia en archivo
        echo json_encode(["mensaje" => "Libro registrado con éxito"]);
        break;

    case 'PUT':
        // Operación: Modifica libros
        $id = $_GET['id'];
        $datosEditados = json_decode(file_get_contents('php://input'), true);
        
        foreach ($libros as $key => $libro) {
            if ($libro['id'] == $id) {
                $libros[$key] = array_merge($libro, $datosEditados);
            }
        }
        file_put_contents($archivo, json_encode($libros));
        echo json_encode(["mensaje" => "Libro actualizado"]);
        break;

    case 'DELETE':
        // Operación: Elimina libros
        $id = $_GET['id'];
        $libros = array_filter($libros, function($l) use ($id) {
            return $l['id'] != $id;
        });
        
        file_put_contents($archivo, json_encode(array_values($libros)));
        echo json_encode(["mensaje" => "Libro eliminado"]);
        break;

    default:
        http_response_code(405); // Error: Método no permitido 
        echo json_encode(["error" => "Método no soportado"]);
        break;
}
?>