<?php
require_once '../models/Pelicula.php';

class PeliculaController {
    private $peliculaModel;

    public function __construct($db) {
        $this->peliculaModel = new Pelicula($db);
    }

    public function obtenerCatalogo() {
        return $this->peliculaModel->obtenerTodasConActores();
    }

    public function borrar($id) {
        return $this->peliculaModel->borrar($id);
    }
}