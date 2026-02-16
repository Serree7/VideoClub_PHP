<?php
require_once 'models/Usuario.php';

class UsuarioController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new Usuario($db);
    }

    public function login($username, $password) {
        if ($this->userModel->login($username, $password)) {
            $_SESSION['usuario'] = $this->userModel->username;
            $_SESSION['rol'] = $this->userModel->rol;

            setcookie("ultima_conexion", date("d-m-Y H:i:s"), time() + (86400 * 30), "/");

            $this->escribirLog($username, "ÉXITO");
            return $this->userModel->rol;
        } else {
            $this->escribirLog($username, "FALLO");
            return false;
        }
    }

    private function escribirLog($user, $estado) {
        $log = "[" . date("Y-m-d H:i:s") . "] Usuario: $user - Estado: $estado\n";
        file_put_contents("logs/accesos.log", $log, FILE_APPEND);
    }
}