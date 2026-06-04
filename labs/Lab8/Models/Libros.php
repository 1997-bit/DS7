<?php
class Libro {
    public $id;
    public $titulo;
    public $autor;
    public $añoPub;
    public $genero;

    public function __construct($id, $titulo, $autor, $añoPub, $genero) {
        $this->id     = $id;
        $this->titulo = $titulo;
        $this->autor  = $autor;
        $this->añoPub = $añoPub;
        $this->genero = $genero;
    }
}
?>