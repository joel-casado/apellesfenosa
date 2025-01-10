<?php

class UbicacionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
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

    public function ubicacionExists($id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM ubicaciones WHERE id_ubicacion = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function crearUbicacion($fecha_inicio_ubi, $fecha_fin_ubi, $comentario_ubicacion, $ubicacion_padre, $nombre_ubicacion) {
        $query = $this->conn->prepare("SELECT MAX(id_ubicacion) AS max_id FROM ubicaciones");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $new_id = $result['max_id'] + 1;

        $ubicacion_padre = $ubicacion_padre ?? null;

        $query = $this->conn->prepare(
            "INSERT INTO ubicaciones (id_ubicacion, fecha_inicio_ubi, fecha_fin_ubi, comentario_ubicacion, ubicacion_padre, nombre_ubicacion)
             VALUES (:id_ubicacion, :fecha_inicio_ubi, :fecha_fin_ubi, :comentario_ubicacion, :ubicacion_padre, :nombre_ubicacion)"
        );
        $query->bindParam(':id_ubicacion', $new_id);
        $query->bindParam(':fecha_inicio_ubi', $fecha_inicio_ubi);
        $query->bindParam(':fecha_fin_ubi', $fecha_fin_ubi);
        $query->bindParam(':comentario_ubicacion', $comentario_ubicacion);
        $query->bindParam(':ubicacion_padre', $ubicacion_padre, PDO::PARAM_INT);
        $query->bindParam(':nombre_ubicacion', $nombre_ubicacion);

        return $query->execute();
    }
}

?>
