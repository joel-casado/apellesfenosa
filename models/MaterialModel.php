<?php

class MaterialModel {
    private $db;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getMateriales() {
        $query = "SELECT DISTINCT codigo_getty_material, texto_material, activo FROM materiales";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaterialPorId($codigo_getty_material) {
        $query = "SELECT codigo_getty_material, texto_material, activo FROM materiales WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch para un solo resultado
    }
    
    public function obtenerMaterial($id) {
        $query = "SELECT codigo_getty_material, texto_material, activo FROM materiales WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna la obra como un array asociativo
    }

    // Método para actualizar un material en la base de datos
    public function actualizarMaterial($codigo_getty_material, $texto_material) {
        $query = "UPDATE materiales SET texto_material = :texto_material WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_material', $texto_material, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function crearMaterial($codigo_getty_material, $texto_material) {
        $query = "INSERT INTO materiales (codigo_getty_material, texto_material) VALUES (:codigo_getty_material, :texto_material)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);
        $stmt->bindParam(':texto_material', $texto_material, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitarMaterial($codigo_getty_material) {
        $query = "UPDATE materiales SET activo = 0 WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function habilitarMaterial($codigo_getty_material) {
        $query = "UPDATE materiales SET activo = 1 WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Método para verificar si un ID de material ya existe
    public function existeMaterial($codigo_getty_material) {
        $query = "SELECT COUNT(*) FROM materiales WHERE codigo_getty_material = :codigo_getty_material";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo_getty_material', $codigo_getty_material, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
?>