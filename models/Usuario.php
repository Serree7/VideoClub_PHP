<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $username;
    public $password;
    public $rol;

    public function __construct($db){
        $this->conn = $db; 
    }

    public function login($user, $pass) {
        $consulta = "SELECT id, username, password, rol FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($consulta); 
        $stmt->bindParam(":username", $user);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if(password_verify($pass, $row['password'])){
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->rol = $row['rol'];
                return true; 
            }
        }
        return false;
    }

    public function registrar($user, $pass) { 
        try {

            $passHash = password_hash($pass, PASSWORD_DEFAULT);

            $query = "INSERT INTO " . $this->table_name . " (username, password, rol) VALUES (:user, :pass, 0)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':pass', $passHash); 
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al registrar: " . $e->getMessage()); 
        }
    }
}
?>