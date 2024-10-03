<?php

class LoginController {

    public function verLogin(){
        // Cargar la vista del formulario de login
        require_once "views/login/login.php";
    }

    public function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $login_model = new Login();

            if($login_model->validar_usuario($username, $password)) {

                session_start();
                $_SESSION['admin'] = $username;
                echo "Login exitoso"; 
                header("Location: index.php?controller=Obras&action=verObras");
                exit();
            } else {
                //Si las credenciales no son válidas, redirigir al formulario de login con un mensaje de error
                //header("Location: index.php?controller=login&action=verLogin");
                //exit();
                echo "Login invalido";
            }
        } else {
            //header("Location: index.php?controller=login&action=verLogin");
            //exit();
        }
    }

    public function logout() {

    }
}

?>
