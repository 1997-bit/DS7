<?php

require_once __DIR__ . "/../Models/Libros.php";
class LibroController {
private $archivo = __DIR__ . "/../Models/libros.json";
    private function leer() {
        return json_decode(file_get_contents($this->archivo), true);
    }

   private function guardar($datos) {
    file_put_contents($this->archivo, json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

   public function getAll() {
    echo json_encode($this->leer(), JSON_UNESCAPED_UNICODE);
}

    public function create() {
        $data   = json_decode(file_get_contents("php://input"), true);
        $libros = $this->leer();
        $nuevo  = new Libro(
            count($libros) + 1,
            $data['titulo'],
            $data['autor'],
            $data['añoPub'],
            $data['genero']
        );
        $libros[] = (array) $nuevo;
        $this->guardar($libros);
        echo json_encode(["mensaje" => "Libro registrado", "libro" => $nuevo]);
    }

    public function update() {
        $data   = json_decode(file_get_contents("php://input"), true);
        $libros = $this->leer();
        foreach ($libros as &$l) {
            if ($l['id'] == $data['id']) {
                $l['titulo'] = $data['titulo'];
                $l['autor']  = $data['autor'];
                $l['añoPub'] = $data['añoPub'];
                $l['genero'] = $data['genero'];
                break;
            }
        }
        $this->guardar($libros);
        echo json_encode(["mensaje" => "Libro actualizado"]);
    }

    public function delete() {
        $data   = json_decode(file_get_contents("php://input"), true);
        $libros = $this->leer();
        $libros = array_values(array_filter($libros, fn($l) => $l['id'] != $data['id']));
        $this->guardar($libros);
        echo json_encode(["mensaje" => "Libro eliminado"]);
    }
}
?>