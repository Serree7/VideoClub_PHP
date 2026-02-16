<?php
require_once '../models/Pelicula.php';
require_once '../models/Actor.php';

class PeliculaController {
    private $peliculaModel;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->peliculaModel = new Pelicula($db);
    }

    public function obtenerCatalogo() {
        return $this->peliculaModel->obtenerTodasConActores();
    }

    public function borrar($id) {
        if ($this->peliculaModel->borrar($id)) {
            header("Location: ../views/admin_listado.php?res=deleted");
        } else {
            header("Location: ../views/admin_listado.php?res=error");
        }
        exit();
    }

    public function guardar($datos, $repartoTexto) {
        $idPelicula = $this->peliculaModel->crear($datos);
        if ($idPelicula) {
            $this->procesarActores($idPelicula, $repartoTexto);
            header("Location: ../views/admin_listado.php?res=success");
        } else {
            header("Location: ../views/form_nueva_pelicula.php?res=error");
        }
        exit();
    }

    public function actualizar($datos, $repartoTexto) {
        if ($this->peliculaModel->actualizar($datos)) {
            // 1. Borrar vínculos antiguos de actores para esta película
            $query = "DELETE FROM actuan WHERE idPelicula = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id' => $datos['id']]);

            // 2. Insertar los nuevos actores del formulario
            $this->procesarActores($datos['id'], $repartoTexto);

            header("Location: ../views/admin_listado.php?res=updated");
        } else {
            header("Location: ../views/form_editar_pelicula.php?id=" . $datos['id'] . "&res=error");
        }
        exit();
    }

    // Función privada para no repetir código de procesar nombres de actores
    private function procesarActores($idPelicula, $repartoTexto) {
        if (!empty(trim($repartoTexto))) {
            $actorModel = new Actor($this->db);
            $nombres = explode(',', $repartoTexto);
            foreach ($nombres as $n) {
                $nombreLimpio = trim($n);
                if ($nombreLimpio !== "") {
                    $idActor = $actorModel->obtenerOCrear($nombreLimpio);
                    $actorModel->vincularConPelicula($idActor, $idPelicula);
                }
            }
        }
    }
}

// LÓGICA DE ACTIVACIÓN
if (isset($_GET['action'])) {
    require_once '../config/Database.php';
    $db = (new Database())->getConnection();
    $controller = new PeliculaController($db);

    if ($_GET['action'] == 'guardar') {
        $datos = ['titulo' => $_POST['titulo'], 'genero' => $_POST['genero'], 'pais' => $_POST['pais'], 'anyo' => $_POST['anyo']];
        $reparto = isset($_POST['reparto']) ? $_POST['reparto'] : '';
        $controller->guardar($datos, $reparto);
    }

    if ($_GET['action'] == 'eliminar' && isset($_GET['id'])) {
        $controller->borrar($_GET['id']);
    }

    if ($_GET['action'] == 'actualizar') {
        $datos = ['id' => $_POST['id'], 'titulo' => $_POST['titulo'], 'genero' => $_POST['genero'], 'anyo' => $_POST['anyo'], 'pais' => $_POST['pais']];
        $reparto = isset($_POST['reparto']) ? $_POST['reparto'] : '';
        $controller->actualizar($datos, $reparto);
    }
}