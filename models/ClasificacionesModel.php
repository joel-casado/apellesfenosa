<?php

class ClasificacionesModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getClasificaciones() {
        $query = "SELECT DISTINCT id_clasificacion, texto_clasificacion FROM Clasificaciones_genericas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getclasificaionId($id_clasificacion) {
        $query = "SELECT  id_clasificacion, texto_clasificacion FROM Clasificaciones_genericas WHERE id_clasificacion = :id_clasificacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_clasificacion', $id_clasificacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    // Método para actualizar un autor en la base de datos
    public function actualizarClasificaciones($id_clasificacion, $texto_clasificacion) {
        $query = "UPDATE Clasificaciones_genericas SET texto_clasificacion = :texto_clasificacion WHERE id_clasificacion = :id_clasificacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_clasificacion', $texto_clasificacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_clasificacion', $id_clasificacion, PDO::PARAM_STR);

        // Ejecutar la consulta
        return $stmt->execute();
    }


    public function crearClasificaciones($id_clasificacion, $texto_clasificacion) {
        $query = "INSERT INTO Clasificaciones_genericas (id_clasificacion, texto_clasificacion) VALUES (:id_clasificacion, :texto_clasificacion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_clasificacion', $id_clasificacion, PDO::PARAM_STR);
        $stmt->bindParam(':texto_clasificacion', $texto_clasificacion, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitarClasificaciones($id_clasificacion) {
        $query = "UPDATE Clasificaciones_genericas SET activo = 0 WHERE id_clasificacion = :id_clasificacion";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_clasificacion', $id_clasificacion, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    
}







?>