<?php

class TecnicasModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getTecnicas() {
        $query = "SELECT DISTINCT codigo_getty_tecnica, texto_tecnica, activo FROM tecnicas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTecnicaPorId($codigo_getty_tecnica) {
        $query = "SELECT codigo_getty_tecnica, texto_tecnica, activo FROM tecnicas WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function actualizarTecnica($codigo_getty_tecnica, $texto_tecnica) {
        $query = "UPDATE tecnicas SET texto_tecnica = :texto_tecnica WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_tecnica', $texto_tecnica, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function crearTecnica($codigo_getty_tecnica, $texto_tecnica) {
        $query = "INSERT INTO tecnicas (codigo_getty_tecnica, texto_tecnica) VALUES (:codigo_getty_tecnica, :texto_tecnica)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        $stmt->bindParam(':texto_tecnica', $texto_tecnica, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deshabilitarTecnica($codigo_getty_tecnica) {
        $query = "UPDATE tecnicas SET activo = 0 WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function habilitarTecnica($codigo_getty_tecnica) {
        $query = "UPDATE tecnicas SET activo = 1 WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>