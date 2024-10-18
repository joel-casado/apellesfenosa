<?php

class ingresoModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getingresos() {
        $query = "SELECT DISTINCT id_forma_ingreso, texto_forma_ingreso FROM formas_ingreso WHERE activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getingresoPorId($id_forma_ingreso) {
        $query = "SELECT id_forma_ingreso, texto_forma_ingreso FROM formas_ingreso WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch para un solo resultado
    }
    
    public function obteneringreso($id) {
        $query = "SELECT id_forma_ingreso, texto_forma_ingreso FROM formas_ingreso WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna la obra como un array asociativo
    }

    // Método para actualizar un ingreso en la base de datos
    public function actualizaringreso($id_forma_ingreso, $texto_forma_ingreso) {
        $query = "UPDATE formas_ingreso SET texto_forma_ingreso = :texto_forma_ingreso WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':texto_forma_ingreso', $texto_forma_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);

        // Ejecutar la consulta
        return $stmt->execute();
    }


    public function crearingreso($id_forma_ingreso, $texto_forma_ingreso) {
        $query = "INSERT INTO formas_ingreso (id_forma_ingreso, texto_forma_ingreso) VALUES (:id_forma_ingreso, :texto_forma_ingreso)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(':texto_forma_ingreso', $texto_forma_ingreso, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function deshabilitaringreso($id_forma_ingreso) {
        $query = "UPDATE formas_ingreso SET activo = 0 WHERE id_forma_ingreso = :id_forma_ingreso";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_forma_ingreso', $id_forma_ingreso, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    
}







?>