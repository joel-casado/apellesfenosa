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
                    exposicion = :exposicion,
                    fecha_inicio_expo = :fecha_inicio,
                    fecha_fin_expo = :fecha_fin,
                    tipo_exposicion = :tipo,
                    sitio_exposicion = :sitio
                WHERE id_exposicion = :id";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':exposicion', $expo['exposicion']);
            $stmt->bindParam(':fecha_inicio', $expo['inicio']);
            $stmt->bindParam(':fecha_fin', $expo['fin']);
            $stmt->bindParam(':tipo', $expo['tipo']);
            $stmt->bindParam(':sitio', $expo['lugar']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Asegúrate de enlazar el ID aquí
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

    public function deshabilitarExposicion($id_exposicion) {
        $query = "UPDATE exposiciones SET activo = 0 WHERE id_exposicion = :id_exposicion";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al deshabilitar la exposición: " . $e->getMessage();
        }
    }

    public function ver_obras($id_exposicion) {
        $query = "SELECT numero_registro, nombre_objeto, titulo, ubicacion FROM obras WHERE id_exposicion = :id_exposicion";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener las obras: " . $e->getMessage();
            return [];
        }
    }

    public function addObraToExposicion($numero_registro, $id_exposicion) {
        // Primero, obtenemos las fechas de la exposición destino
        $expo = $this->getExposicionById($id_exposicion);
        
        // Verifica que la exposición existe
        if (!$expo) {
            echo "La exposición no existe.";
            return;
        }
    
        // Procede a añadir la obra si no hay conflicto
        $query = "UPDATE obras SET id_exposicion = :id_exposicion WHERE numero_registro = :numero_registro";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT);
            $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al añadir la obra a la exposición: " . $e->getMessage();
        }
    }

    public function getObrasSinExposicion() {
        $query = "SELECT * FROM obras WHERE id_exposicion IS NULL"; // Ajusta según tu esquema de base de datos
        try {
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve las obras como un array asociativo
        } catch (PDOException $e) {
            echo "Error al obtener las obras sin exposición: " . $e->getMessage();
            return [];
        }
    }

    public function removeObraFromExposicion($numero_registro) {
        $query = "UPDATE obras SET id_exposicion = NULL WHERE numero_registro = :numero_registro";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la obra de la exposición: " . $e->getMessage();
        }
    }

    public function existeConflictoFechas($numero_registro, $fecha_inicio, $fecha_fin) {
        $query = "SELECT 1 FROM exposiciones e
                INNER JOIN obras o ON e.id_exposicion = o.id_exposicion
                WHERE o.numero_registro = :numero_registro
                    AND (
                        (e.fecha_inicio_expo <= :fecha_fin AND e.fecha_fin_expo >= :fecha_inicio)
                    )";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
            $stmt->execute();
            return $stmt->fetch() !== false; // Retorna verdadero si hay conflicto
        } catch (PDOException $e) {
            echo "Error al verificar conflicto de fechas: " . $e->getMessage();
            return true;
        }
    }

    public function toggleActivo($id_exposicion) {
        // Get the current value of the activo field
        $query = "SELECT activo FROM exposiciones WHERE id_exposicion = :id_exposicion";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT);
        $stmt->execute();
        $current = $stmt->fetch(PDO::FETCH_ASSOC)['activo'];

        // Toggle the value
        $new_value = $current == 1 ? 0 : 1;

        // Update the activo field
        $query = "UPDATE exposiciones SET activo = :new_value WHERE id_exposicion = :id_exposicion";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':new_value', $new_value, PDO::PARAM_INT);
        $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Opcional: Método para cerrar la conexión
    public function __destruct() {
        $this->db = null; // Cierra la conexión al final
    }
}
?>