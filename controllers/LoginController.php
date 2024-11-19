<?php

class LoginController {

    public function verLogin() {
        // Check for error messages passed as query parameters or session
        $error_message = isset($_GET['error']) ? $_GET['error'] : '';
        require_once "views/login/login.php";
    }

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $login_model = new Login();

            // Validate user existence and password
            $rol_usuario = $login_model->validar_usuario($username, $password);

            if ($rol_usuario) {
                session_start();

                if ($rol_usuario == 'admin') {
                    $_SESSION['admin'] = $username;
                    header("Location: index.php?controller=Obras&action=verObras&admin");
                } elseif ($rol_usuario == 'tecnic') {
                    $_SESSION['tecnic'] = $username;
                    header("Location: index.php?controller=Obras&action=verObras&tecnic");
                } elseif ($rol_usuario == 'convidat') {
                    $_SESSION['convidat'] = $username;
                    header("Location: index.php?controller=Obras&action=verObras&convidat");
                }
            } else {
                // Check if the user exists
                if (!$login_model->usuario_existe($username)) {
                    header("Location: index.php?controller=Login&action=verLogin&error=Usuari no trobat");
                } else {
                    header("Location: index.php?controller=Login&action=verLogin&error=Contrasenya incorrecta");
                }
            }
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
