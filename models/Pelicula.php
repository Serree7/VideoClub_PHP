<?php
class Pelicula {
    private $conn;
    private $table_name = "peliculas";


    public $id;
    public $titulo;
    public $genero;
    public $pais;
    public $anyo;
    public $cartel;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function obtenerTodasConActores() {
        try {
           
            $query = "SELECT p.*, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellidos) SEPARATOR ', ') AS reparto 
                      FROM " . $this->table_name . " p
                      LEFT JOIN actuan ac ON p.id = ac.idPelicula
                      LEFT JOIN actores a ON ac.idActor = a.id
                      GROUP BY p.id";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
             
            throw new Exception("Error al obtener películas: " . $e->getMessage());
        }
    }
    
    public function borrar($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al borrar la película: " . $e->getMessage());
        }
    }
}
?>