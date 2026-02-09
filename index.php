<?php
session_start();
require_once "config/Database.php";
require_once "models/Usuario.php";

$mensaje = "";

if(isset($_POST['login'])) {
    $database = new Database();
    $db =  $database->getConnection();
    $userModel = new Usuario($db);

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($userModel->login($username, $password)) {
        
    }
}
?>