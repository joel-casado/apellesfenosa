<?php

class DatacionesModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getDataciones() {
        $query = "SELECT DISTINCT id_datacion, nombre_datacion, ano_inicio, ano_final, activo FROM dataciones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDatacionId($id_datacion) {
        $query = "SELECT id_datacion, nombre_datacion, ano_inicio, ano_final, activo FROM dataciones WHERE id_datacion = :id_datacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_datacion', $id_datacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function actualizarDataciones($id_datacion, $nombre_datacion, $ano_inicio, $ano_final) {
        $query = "UPDATE dataciones SET nombre_datacion = :nombre_datacion, ano_inicio = :ano_inicio, ano_final = :ano_final WHERE id_datacion = :id_datacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_datacion', $nombre_datacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_datacion', $id_datacion, PDO::PARAM_STR);
        $stmt->bindParam(':ano_inicio', $ano_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':ano_final', $ano_final, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function crearDataciones($nombre_datacion, $ano_inicio, $ano_final) {
        $query = "INSERT INTO dataciones (nombre_datacion, ano_inicio, ano_final) VALUES (:nombre_datacion, :ano_inicio, :ano_final)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_datacion', $nombre_datacion, PDO::PARAM_STR);
        $stmt->bindParam(':ano_inicio', $ano_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':ano_final', $ano_final, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deshabilitarDatacion($id_datacion) {
        $query = "UPDATE dataciones SET activo = 0 WHERE id_datacion = :id_datacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_datacion', $id_datacion, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function habilitarDatacion($id_datacion) {
        $query = "UPDATE dataciones SET activo = 1 WHERE id_datacion = :id_datacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_datacion', $id_datacion, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>