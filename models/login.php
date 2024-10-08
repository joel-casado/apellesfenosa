<?php

class Login extends Database {

    public function __construct() {
        
        $this->db = $this->conectar();
    }

    public function validar_usuario($username, $password){
        
        $stmt = $this->db->prepare("SELECT password, rol_usuario FROM usuarios WHERE nombre_usuario = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

    
        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $contrasenya = $row['password'];
            $rol_usuario = $row['rol_usuario'];

            
            if (password_verify($password, $contrasenya)) {
            
                return $rol_usuario;
            }
        }

       
        return false;
    }
}

?>
