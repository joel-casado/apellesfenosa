<?php

class UbicacionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add this method to get the database connection
    public function getConnection() {
        return $this->conn;
    }

    public function getUbicaciones() {
        $query = "SELECT id_ubicacion, nombre_ubicacion, ubicacion_padre FROM ubicaciones";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUbicacionById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM ubicaciones WHERE id_ubicacion = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function crearUbicacion($fecha_inicio_ubi, $fecha_fin_ubi, $comentario_ubicacion, $ubicacion_padre, $nombre_ubicacion) {
        $query = $this->conn->prepare("SELECT MAX(id_ubicacion) AS max_id FROM ubicaciones");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $new_id = $result['max_id'] + 1;

        $query = $this->conn->prepare(
            "INSERT INTO ubicaciones (id_ubicacion, fecha_inicio_ubi, fecha_fin_ubi, comentario_ubicacion, ubicacion_padre, nombre_ubicacion)
             VALUES (:id_ubicacion, :fecha_inicio_ubi, :fecha_fin_ubi, :comentario_ubicacion, :ubicacion_padre, :nombre_ubicacion)"
        );
        $query->bindParam(':id_ubicacion', $new_id);
        $query->bindParam(':fecha_inicio_ubi', $fecha_inicio_ubi);
        $query->bindParam(':fecha_fin_ubi', $fecha_fin_ubi);
        $query->bindParam(':comentario_ubicacion', $comentario_ubicacion);
        if ($ubicacion_padre === null) {
            $query->bindValue(':ubicacion_padre', null, PDO::PARAM_NULL);
        } else {
            $query->bindParam(':ubicacion_padre', $ubicacion_padre, PDO::PARAM_INT);
        }
        $query->bindParam(':nombre_ubicacion', $nombre_ubicacion);

        return $query->execute();
    }
    
    public function updateUbicacion($id, $nombreUbicacion, $fechaInicio, $fechaFin, $comentario) {
        $query = $this->conn->prepare(
            "UPDATE ubicaciones 
             SET nombre_ubicacion = :nombre_ubicacion, 
                 fecha_inicio_ubi = :fecha_inicio_ubi, 
                 fecha_fin_ubi = :fecha_fin_ubi, 
                 comentario_ubicacion = :comentario_ubicacion 
             WHERE id_ubicacion = :id"
        );
    
        $query->bindParam(':nombre_ubicacion', $nombreUbicacion);
        $query->bindParam(':fecha_inicio_ubi', $fechaInicio);
        $query->bindParam(':fecha_fin_ubi', $fechaFin);
        $query->bindParam(':comentario_ubicacion', $comentario);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $query->execute();
    }

    public function eliminarUbicacion($id) {
        // Get all child ubicaciones
        $ubicaciones = $this->getUbicaciones();
        $idsToDelete = $this->getAllChildIds($ubicaciones, $id);
        $idsToDelete[] = $id;

        // Set obras ubicacion to null
        $query = $this->conn->prepare("UPDATE obras SET ubicacion = NULL WHERE ubicacion IN (" . implode(',', $idsToDelete) . ")");
        $query->execute();

        // Delete child ubicaciones first
        foreach ($idsToDelete as $childId) {
            $query = $this->conn->prepare("DELETE FROM ubicaciones WHERE id_ubicacion = :id");
            $query->bindParam(':id', $childId, PDO::PARAM_INT);
            $query->execute();
        }

        return true;
    }

    private function getAllChildIds($ubicaciones, $parentId) {
        $ids = [];
        foreach ($ubicaciones as $ubicacion) {
            if ($ubicacion['ubicacion_padre'] == $parentId) {
                $ids[] = $ubicacion['id_ubicacion'];
                $ids = array_merge($ids, $this->getAllChildIds($ubicaciones, $ubicacion['id_ubicacion']));
            }
        }
        return $ids;
    }
    
}
?>