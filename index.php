<?php
session_start(); 
require_once 'config/Database.php';
require_once 'controllers/UserController.php';

$error_msg = "";

if (isset($_POST['login'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $uController = new UsuarioController($db);
        $resultado = $uController->login($_POST['username'], $_POST['password']);

        if ($resultado !== false) {

            if ($resultado == 1) {
                header("Location: views/admin_listado.php");
            } else {
                header("Location: views/panel_usuario.php"); 
            }
            exit();
        } else {
            $error_msg = "Nombre y Clave no válidos."; 
        }
    } catch (Exception $e) {
        $error_msg = "Error en el sistema: " . $e->getMessage();
    }
}

include 'views/login_view.php';