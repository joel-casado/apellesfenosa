<?php

class Login extends Database {

    public function __construct() {
        // Initialize the database connection using the parent class method
        $this->db = $this->conectar();
    }

    public function validar_usuario($username, $password){
        // Prevent SQL injection using prepared statements
        $stmt = $this->db->prepare("SELECT password FROM usuarios WHERE nombre_usuario = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

        // Check if a user with the given username exists
        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $contrasenya = $row['password'];

            // Verify if the provided password matches the stored hash
            if (password_verify($password, $contrasenya)) {
                return true;
            }
            
        }
        
        // If no user found or password doesn't match, return false
        return false;
    }
}

?>
