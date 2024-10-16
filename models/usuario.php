<?php

class Usuario extends Database {
    private $nombre;
    private $password;
    private $rol;

    function getNombre() {
        return $this->nombre;
    }
    function setRol($rol) {
        $this->rol = $rol;
    }
    
    function getPassword() {
        return $this->password;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function mostrarTodos() {
        $sql = "SELECT * FROM usuarios";
        $db = $this->conectar();
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver resultados como un arreglo asociativo
    }
    public function getByUsername($nombre) {
        $db = $this->conectar();
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $nombre);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : null; // Devuelve el usuario encontrado o null si no existe
    }
    
    function insertar($nombre, $rol, $password) {
        $db = $this->conectar();
        $sql = "INSERT INTO usuarios (nombre_usuario, rol_usuario, password) VALUES (:nombre_usuario, :rol_usuario, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre);
        $stmt->bindParam(':rol_usuario', $rol);
        $stmt->bindParam(':password', $password);
                        
        // Ejecuta la consulta
        try {
            $stmt->execute(); // Ejecutar la inserción
            echo "Usuario creado exitosamente."; // Mensaje de éxito
            return true; // Retornar verdadero si se ejecutó correctamente
        } catch (PDOException $e) {
            // Manejo de errores de inserción
            echo "Error al insertar el usuario: " . $e->getMessage();
            return false; // Retornar falso si hubo un error
        }
    }
    public function actualizar($nombreOriginal, $nombreNuevo, $rol, $activo) {
        $sql = "UPDATE usuarios SET nombre_usuario = :nombreNuevo, rol_usuario = :rol, estado = :activo WHERE nombre_usuario = :nombreOriginal";
        $db = $this->conectar();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombreNuevo', $nombreNuevo);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':activo', $activo);
        $stmt->bindParam(':nombreOriginal', $nombreOriginal); // Este es el nombre con el que filtras al usuario
        return $stmt->execute();
    }
}


?>
