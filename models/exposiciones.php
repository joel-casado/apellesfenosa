<?php

class Exposiciones {
    private $db;

    public function __construct() {
        $database = new Database(); // Instancia de la clase Database
        $this->db = $database->conectar(); // Conexión a la base de datos
    }

    public function getExposiciones() {
        $query = "SELECT * FROM exposiciones";
        try {
            $stmt = $this->db->query($query); // Usamos el método query de PDO
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve resultados como array asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al obtener exposiciones: " . $e->getMessage();
            return [];
        }
    }

    public function getExposicionById($id) {
        $query = "SELECT * FROM exposiciones WHERE id_exposicion = :id";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el resultado como array asociativo
        } catch (PDOException $e) {
            echo "Error al obtener la exposición: " . $e->getMessage();
            return null; // Devuelve null si ocurre un error
        }
    }

    public function updateExposicion($id, $expo) {
        $query = "UPDATE exposiciones SET
                    fecha_inicio_expo = :fecha_inicio,
                    fecha_fin_expo = :fecha_fin,
                    tipo_exposicion = :tipo,
                    sitio_exposicion = :sitio
                WHERE id_exposicion = :id";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_inicio', $expo['inicio']);
            $stmt->bindParam(':fecha_fin', $expo['fin']);
            $stmt->bindParam(':tipo', $expo['tipo']);
            $stmt->bindParam(':sitio', $expo['lugar']);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la exposición: " . $e->getMessage();
        }
    }
    public function getMaxId() {
        $query = "SELECT MAX(id_exposicion) as max_id FROM exposiciones";
        try {
            $stmt = $this->db->query($query);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['max_id'];
        } catch (PDOException $e) {
            echo "Error al obtener el máximo ID: " . $e->getMessage();
            return null;
        }
    }

    public function createExposicion($expo) {
        $maxId = $this->getMaxId(); // Obtiene el ID más alto actual
        $nextId = $maxId + 1; // Suma 1 para obtener el siguiente ID disponible
        
        $query = "INSERT INTO exposiciones (id_exposicion, exposicion, fecha_inicio_expo, fecha_fin_expo, tipo_exposicion, sitio_exposicion) 
                VALUES (:id, :exposicion, :fecha_inicio, :fecha_fin, :tipo, :sitio)";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $nextId, PDO::PARAM_INT); // Asigna el siguiente ID disponible
            $stmt->bindParam(':exposicion', $expo['exposicion']);
            $stmt->bindParam(':fecha_inicio', $expo['inicio']);
            $stmt->bindParam(':fecha_fin', $expo['fin']);
            $stmt->bindParam(':tipo', $expo['tipo']);
            $stmt->bindParam(':sitio', $expo['lugar']);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al crear la exposición: " . $e->getMessage();
        }
    }
    

    // Opcional: Método para cerrar la conexión
    public function __destruct() {
        $this->db = null; // Cierra la conexión al final
    }
}
?>