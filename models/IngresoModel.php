<?php

class IngresoModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getIngresos() {
        $query = "SELECT DISTINCT id_forma_ingreso, texto_forma_ingreso, activo FROM formas_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIngresoPorId($id_forma_ingreso) {
        $query = "SELECT id_forma_ingreso, texto_forma_ingreso, activo FROM formas_ingreso WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function actualizarIngreso($id_forma_ingreso, $texto_forma_ingreso) {
        $query = "UPDATE formas_ingreso SET texto_forma_ingreso = :texto_forma_ingreso WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_forma_ingreso', $texto_forma_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function crearIngreso($id_forma_ingreso, $texto_forma_ingreso) {
        $query = "INSERT INTO formas_ingreso (id_forma_ingreso, texto_forma_ingreso) VALUES (:id_forma_ingreso, :texto_forma_ingreso)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':texto_forma_ingreso', $texto_forma_ingreso, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deshabilitarIngreso($id_forma_ingreso) {
        $query = "UPDATE formas_ingreso SET activo = 0 WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function habilitarIngreso($id_forma_ingreso) {
        $query = "UPDATE formas_ingreso SET activo = 1 WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>