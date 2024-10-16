<?php

class prestamosModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getprestamos() {
        $query = "SELECT DISTINCT id_prestamo, numero_registro, fecha_prestacion, fecha_devolucion FROM prestamos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getprestamoPorId($id_prestamo) {
        $query = "SELECT id_prestamo, numero_registro, fecha_prestacion, fecha_devolucion FROM prestamos WHERE id_prestamo = :id_prestamo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch para un solo resultado
    }
    
    // Método para actualizar un prestamo en la base de datos
    public function actualizarprestamo($id_prestamo, $numero_registro, $fecha_prestacion, $fecha_devolucion,) {
        $query = "UPDATE prestamos SET id_prestamo = :id_prestamo, numero_registro = :numero_registro, fecha_prestacion = :fecha_prestacion, fecha_devolucion = :fecha_devolucion WHERE id_prestamo = :id_prestamo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_STR);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_prestacion', $fecha_prestacion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_devolucion', $fecha_devolucion, PDO::PARAM_STR);
        // Ejecutar la consulta
        return $stmt->execute();
    }


    public function crearprestamo($id_prestamo, $numero_registro, $fecha_prestacion, $fecha_devolucion) {
        $query = "INSERT INTO prestamos (id_prestamo, numero_registro, fecha_prestacion, fecha_devolucion) VALUES (:id_prestamo, :numero_registro, :fecha_prestacion, :fecha_devolucion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
        $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_prestacion', $fecha_prestacion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_devolucion', $fecha_devolucion, PDO::PARAM_STR);
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitarprestamo($id_prestamo) {
        $query = "UPDATE prestamos SET activo = 0 WHERE id_prestamo = :id_prestamo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    
}







?>