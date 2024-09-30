<?php

class EditarController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db; // Almacena la conexión
    }

    public function obtenerObra($id) {
        $query = "SELECT * FROM obras WHERE numero_registro = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Usa bindParam
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarObra($data) {
        $query = "UPDATE obras SET titulo = :titulo, autor = :autor, descripcion = :descripcion WHERE numero_registro = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':autor', $data['autor']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':id', $data['numero_registro'], PDO::PARAM_INT); // Usa bindParam
        return $stmt->execute();
    }
}
?>
