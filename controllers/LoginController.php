<?php

class LoginController {
    public function __construct() {
        $this->startSession();
    }

    private function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function redirectToRolePage($role, $username) {
        $_SESSION[$role] = $username;
        header("Location: index.php?controller=Obras&action=verObras&$role");
        exit();
    }

    public function verLogin() {
        // Redirecció si ja s'ha iniciat sessió.
        foreach (['admin', 'tecnic', 'convidat'] as $role) {
            if (isset($_SESSION[$role])) {
                header("Location: index.php?controller=Obras&action=verObras&$role");
                exit();
            }
        }

        // Mostrar missatge d'error
        $error_message = $_SESSION['error'] ?? '';
        unset($_SESSION['error']); // Neteja d'error després d'utilitzar-ho
        require_once "views/login/login.php";
    }

    public function login() {
        // Validació i netejeda dels inputs
        $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
    
        if (!empty($username) && !empty($password)) {
            $login_model = new LoginModel();
            $rol_usuario = $login_model->validar_usuario($username, $password);
    
            if ($rol_usuario) {
                $this->redirectToRolePage($rol_usuario, $username);
            } else {
                $_SESSION['error'] = !$login_model->usuario_existe($username) 
                    ? 'Usuari no trobat' 
                    : 'Contrasenya incorrecta';
                header("Location: index.php?controller=Login&action=verLogin");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Missing credentials';
            header("Location: index.php?controller=Login&action=verLogin");
            exit();
        }
    }    

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?controller=Login&action=verLogin");
        exit();
    }
}
?>