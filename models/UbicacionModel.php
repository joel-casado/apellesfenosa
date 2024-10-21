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
}
?>
