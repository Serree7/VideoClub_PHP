<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    // Atributos según el esquema de la BD [cite: 14-17]
    public $id;
    public $username;
    public $password;
    public $rol;

    public function __construct($db){
        $this->conn = $db; // Corregido: $this y punto y coma
    }

    public function login ($user, $pass){
        // Corregido: Espacios en la cadena para que no se peguen las palabras
        $consulta = "SELECT id, username, password, rol FROM " . 
                    $this->table_name . " WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($consulta); // Consulta preparada [cite: 64]
        $stmt->bindParam(":username", $user);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($pass == $row['password']){
                // Corregido: Añadido $ a row y corregido 'true'
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->rol = $row['rol'];
                return true; 
            }
        }
        return false;
    }

    public function registrar($user, $pass) { // Corregido: nombre de variable $user
        try {
            // El rol 0 es para usuario normal según el enunciado [cite: 32]
            $query = "INSERT INTO " . $this->table_name . " (username, password, rol) VALUES (:user, :pass, 0)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':pass', $pass);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores con excepciones [cite: 62]
            throw new Exception("Error al registrar: " . $e->getMessage()); 
        }
    }
}
?>