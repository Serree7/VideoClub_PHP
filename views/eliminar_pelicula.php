<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    require_once '../config/Database.php';
    require_once '../controllers/PeliculaController.php';

    $db = (new Database())->getConnection();
    $pController = new PeliculaController($db);

    try {
        if ($pController->borrar($_GET['id'])) {
            header("Location: admin_listado.php?msg=borrado_ok");
        }
    } catch (Exception $e) {
        echo "Error al borrar: " . $e->getMessage();
    }
}
?>