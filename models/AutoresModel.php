<?php

class AutoresModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getAutores() {
        $query = "SELECT DISTINCT codigo_autor, nombre_autor, activo FROM autores";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAutorId($codigo_autor) {
        $query = "SELECT  codigo_autor, nombre_autor, activo FROM autores WHERE codigo_autor = :codigo_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_autor', $codigo_autor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function obtenerAutor($id) {
        $query = "SELECT codigo_autor, nombre_autor, activo FROM autores WHERE codigo_autor = :codigo_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_autor', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna la obra como un array asociativo
    }

    public function actualizarAutores($codigo_autor, $nombre_autor) {
        $query = "UPDATE autores SET nombre_autor = :nombre_autor WHERE codigo_autor = :codigo_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_autor', $nombre_autor, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_autor', $codigo_autor, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function crearAutores($codigo_autor, $nombre_autor) {
        $query = "INSERT INTO autores (codigo_autor, nombre_autor) VALUES (:codigo_autor, :nombre_autor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_autor', $codigo_autor, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_autor', $nombre_autor, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deshabilitarAutores($codigo_autor) {
        $query = "UPDATE autores SET activo = 0 WHERE codigo_autor = :codigo_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_autor', $codigo_autor, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function habilitarAutores($codigo_autor) {
        $query = "UPDATE autores SET activo = 1 WHERE codigo_autor = :codigo_autor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_autor', $codigo_autor, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>