<?php
class Actor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function obtenerOCrear($nombreCompleto) {

        $partes = explode(' ', trim($nombreCompleto), 2);
        $nombre = $partes[0];
        $apellidos = isset($partes[1]) ? $partes[1] : '';


        $query = "SELECT id FROM actores WHERE nombre = :nom AND apellidos = :ape";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':nom' => $nombre, ':ape' => $apellidos]);
        $actor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($actor) {
            return $actor['id'];
        }


        $queryInsert = "INSERT INTO actores (nombre, apellidos) VALUES (:nom, :ape)";
        $stmtInsert = $this->conn->prepare($queryInsert);
        $stmtInsert->execute([':nom' => $nombre, ':ape' => $apellidos]);
        
        return $this->conn->lastInsertId();
    }


    public function vincularConPelicula($idActor, $idPelicula) {
        $query = "INSERT IGNORE INTO actuan (idActor, idPelicula) VALUES (:idA, :idP)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':idA' => $idActor, ':idP' => $idPelicula]);
    }
}