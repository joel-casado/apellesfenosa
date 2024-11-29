<?php

class LoginController {

    public function verLogin() {
        // Si l'usuari ja está logejat porta a la pagina de obres
        foreach (['admin', 'tecnic', 'convidat'] as $role) {
            if (isset($_SESSION[$role])) {
                header("Location: index.php?controller=Obras&action=verObras&$role");
                exit();
            }
        }

        // Mostra errors de credencials
        $error_message = $_SESSION['error'] ?? '';
        unset($_SESSION['error']);
        require_once "views/login/login.php";
    }

    public function login() {
        $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

        if (!empty($username) && !empty($password)) {
            $login_model = new LoginModel();
            $role = $login_model->usuarioExisteYValido($username, $password);

            if ($role) {
                $this->redirectToRolePage($role, $username);
            } else {
                $_SESSION['error'] = $login_model->usuarioExiste($username)
                    ? 'Contrasenya incorrecta'
                    : 'Usuari no trobat';
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
    }
}
?>

