<?php
session_start(); 
require_once 'config/Database.php';
require_once 'models/Usuario.php';

$error_msg = "";


if (isset($_POST['login'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        $userModel = new Usuario($db);

 
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($userModel->login($username, $password)) {

            $_SESSION['usuario'] = $userModel->username;
            $_SESSION['rol'] = $userModel->rol;

            setcookie("ultima_conexion", date("d-m-Y H:i:s"), time() + (86400 * 30), "/");


            $log = "[" . date("Y-m-d H:i:s") . "] Usuario: $username - Estado: ÉXITO\n";
            file_put_contents("logs/accesos.log", $log, FILE_APPEND);

           
            if ($userModel->rol == 1) {
                header("Location: views/admin_dashboard.php");
            } else {
                header("Location: views/user_dashboard.php"); 
            }
            exit();
        } else {

            $log = "[" . date("Y-m-d H:i:s") . "] Usuario: $username - Estado: FALLO\n";
            file_put_contents("logs/accesos.log", $log, FILE_APPEND);
            
            $error_msg = "Nombre y Clave no válidos."; 
        }
    } catch (Exception $e) {
        $error_msg = "Error en el sistema: " . $e->getMessage();
    }
}

include 'views/login_view.php';
?>