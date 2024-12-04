<?php

class Usuario extends Database {
    private $db;
    private $nombre;
    private $password;
    private $rol;

    public function __construct() {
        $this->db = $this->conectar();
    }

 
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        if (strlen($nombre) < 3 || strlen($nombre) > 50) {
            throw new Exception("Nombre debe tener entre 3 y 50 caracteres.");
        }
        $this->nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (strlen($password) < 6) {
            throw new Exception("La contraseña debe tener al menos 6 caracteres.");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setRol($rol) {
        $this->rol = htmlspecialchars($rol, ENT_QUOTES, 'UTF-8');
    }

    // CRUD Methods
    public function mostrarTodos() {
        $sql = "SELECT * FROM usuarios";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all users as an associative array
        } catch (PDOException $e) {
            error_log("Error fetching all users: " . $e->getMessage());
            return false;
        }
    }

    public function getByUsername($nombre) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :username";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $nombre);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Error fetching user by username: " . $e->getMessage());
            return false;
        }
    }

    public function insertar($nombre, $rol, $password) {
        $sql = "INSERT INTO usuarios (nombre_usuario, rol_usuario, password) VALUES (:nombre_usuario, :rol_usuario, :password)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre_usuario', $nombre);
            $stmt->bindParam(':rol_usuario', $rol);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error inserting user: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($nombreOriginal, $nombreNuevo, $rol, $activo, $hashedPassword = null) {
        // Base query
        $sql = "UPDATE usuarios SET nombre_usuario = :nombreNuevo, rol_usuario = :rol, estado = :activo";
        
        // Add password update if a new password is provided
        if ($hashedPassword) {
            $sql .= ", password = :hashedPassword";
        }
        
        $sql .= " WHERE nombre_usuario = :nombreOriginal";
    
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombreNuevo', $nombreNuevo);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':activo', $activo, PDO::PARAM_BOOL);
            $stmt->bindParam(':nombreOriginal', $nombreOriginal);
            if ($hashedPassword) {
                $stmt->bindParam(':hashedPassword', $hashedPassword);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating user: " . $e->getMessage());
            return false;
        }
    }
    
}
?>
