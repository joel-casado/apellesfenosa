<?php

class tecnicaModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function gettecnicas() {
        $query = "SELECT DISTINCT codigo_getty_tecnica, texto_tecnica FROM tecnicas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gettecnicaPorId($codigo_getty_tecnica) {
        $query = "SELECT codigo_getty_tecnica, texto_tecnica FROM tecnicas WHERE codigo_getty_tecnica = :codigo_getty_tecnica";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_tecnica', $codigo_getty_tecnica, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch para un solo resultado
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