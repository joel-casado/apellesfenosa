<?php

class Usuario extends Database {
    private $nombre;
    private $password;
    private $rol;

    function getNombre() {
        return $this->nombre;
    }
    public function eliminar($id) {
        $db = $this->conectar();
        $sql = "DELETE FROM usuarios WHERE id = :id";  // Asegúrate de que 'id' es el nombre correcto del campo en tu tabla
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    

    function getApellidos() {
        return $this->rol;
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
    
        // ...
    
    function insertar($nombre, $password, $rol) {
        $db = $this->conectar();
        $sql = "INSERT INTO usuarios ('nombre_usuario', 'password', 'rol_usuario') VALUES (:nombre_usuario, :password, :rol_usuario)"; // Asegúrate de que el nombre de la tabla y los campos sean correctos
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre);
        $stmt->bindParam(':password',$hashedPassword);
        $stmt->bindParam(':rol_usuario', $rol);
        echo "Nombre: $nombre, Rol: $rol, Password: $password"; // Debugging
            
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
    }


?>