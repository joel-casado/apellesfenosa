<?php

class exposicionesModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getexposiciones() {
        $query = "SELECT DISTINCT id_exposicion, tipo_exposicion, fecha_inicio_expo, fecha_fin_expo, sitio_exposicion FROM exposiciones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getexposicionPorId($id_exposicion) {
        $query = "SELECT id_exposicion, tipo_exposicion, fecha_inicio_expo, fecha_fin_expo, sitio_exposicion FROM exposiciones WHERE id_exposicion = :id_exposicion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch para un solo resultado
    }
    
    // Método para actualizar un exposicion en la base de datos
    public function actualizarexposicion($id_exposicion, $tipo_exposicion, $fecha_inicio_expo, $fecha_fin_expo, $sitio_exposicion) {
        $query = "UPDATE exposiciones SET id_exposicion = :id_exposicion, tipo_exposicion = :tipo_exposicion, fecha_inicio_expo = :fecha_inicio_expo, fecha_fin_expo = :fecha_fin_expo, sitio_exposicion = :sitio_exposicion WHERE id_exposicion = :id_exposicion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tipo_exposicion', $tipo_exposicion, PDO::PARAM_STR);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio_expo', $fecha_inicio_expo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin_expo', $fecha_fin_expo, PDO::PARAM_STR);
        $stmt->bindParam(':sitio_exposicion', $sitio_exposicion, PDO::PARAM_STR);
        // Ejecutar la consulta
        return $stmt->execute();
    }


    public function crearexposicion($id_exposicion, $tipo_exposicion, $fecha_inicio_expo, $fecha_fin_expo, $sitio_exposicion) {
        $query = "INSERT INTO exposiciones (id_exposicion, tipo_exposicion, fecha_inicio_expo, fecha_fin_expo, sitio_exposicion) VALUES (:id_exposicion, :tipo_exposicion, :fecha_inicio_expo, :fecha_fin_expo, :sitio_exposicion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_exposicion', $tipo_exposicion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio_expo', $fecha_inicio_expo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin_expo', $fecha_fin_expo, PDO::PARAM_STR);
        $stmt->bindParam(':sitio_exposicion', $sitio_exposicion, PDO::PARAM_STR);
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitarexposicion($id_exposicion) {
        $query = "UPDATE exposiciones SET activo = 0 WHERE id_exposicion = :id_exposicion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    
}







?>