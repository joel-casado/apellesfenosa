<?php

class LoginModel extends Database {
    private $db;

    public function __construct() {
        $this->db = $this->conectar(); // Conectar a la base de datos
    }

    public function usuarioExisteYValido($username, $password) {
        $stmt = $this->db->prepare(
            "SELECT password, rol_usuario FROM usuarios WHERE nombre_usuario = :username"
        );
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                return $row['rol_usuario']; // Return role if valid
            }
        }

        return false; // Invalid credentials
    }

    public function usuarioExiste($username) {
        $stmt = $this->db->prepare(
            "SELECT 1 FROM usuarios WHERE nombre_usuario = :username"
        );
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() !== false; // Return true if user exists
    }
}

?>
