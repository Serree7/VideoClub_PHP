<?php
class Pelicula {
    private $conn;
    private $table_name = "peliculas";

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
            throw new Exception("Error al borrar: " . $e->getMessage());
        }
    }

    public function crear($datos) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (titulo, genero, pais, anyo) 
                      VALUES (:titulo, :genero, :pais, :anyo)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titulo', $datos['titulo']);
            $stmt->bindParam(':genero', $datos['genero']);
            $stmt->bindParam(':pais', $datos['pais']);
            $stmt->bindParam(':anyo', $datos['anyo']);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); 
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error al insertar: " . $e->getMessage());
        }
    }

    public function obtenerPorId($id) {
        // Traemos también el reparto actual concatenado para el formulario
        $query = "SELECT p.*, GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellidos) SEPARATOR ', ') AS reparto 
                  FROM " . $this->table_name . " p
                  LEFT JOIN actuan ac ON p.id = ac.idPelicula
                  LEFT JOIN actores a ON ac.idActor = a.id
                  WHERE p.id = :id
                  GROUP BY p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($datos) {
        $query = "UPDATE " . $this->table_name . " 
                  SET titulo = :titulo, genero = :genero, anyo = :anyo, pais = :pais
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':genero', $datos['genero']);
        $stmt->bindParam(':anyo', $datos['anyo']);
        $stmt->bindParam(':pais', $datos['pais']);
        $stmt->bindParam(':id', $datos['id']);
        return $stmt->execute();
    }
}