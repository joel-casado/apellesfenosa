<?php

class tecnicasModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    
    public function gettecnicas() {
        $query = "SELECT DISTINCT codigo_getty_tecnica, texto_tecnica FROM tecnicas WHERE activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    // Método para actualizar un tecnica en la base de datos
    public function actualizartecnica($codigo_getty_tecnica, $texto_tecnica) {
        $query = "UPDATE tecnicas SET texto_tecnica = :texto_tecnica WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_tecnica', $texto_tecnica, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);

        // Ejecutar la consulta
        return $stmt->execute();
    }


    public function creartecnica($codigo_getty_tecnica, $texto_tecnica) {
        $query = "INSERT INTO tecnicas (codigo_getty_tecnica, texto_tecnica) VALUES (:codigo_getty_tecnica, :texto_tecnica)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        $stmt->bindParam(':texto_tecnica', $texto_tecnica, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitartecnica($codigo_getty_tecnica) {
        $query = "UPDATE tecnicas SET activo = 0 WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    
    
}







?>