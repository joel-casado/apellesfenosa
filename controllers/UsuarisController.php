<?php

class UsuarisController {
    private $users = []; // Cambia esto a un array vacío inicialmente

    public function index() {
        // Obtener todos los usuarios desde el modelo
        $usuarioModel = new Usuario();
        $this->users = $usuarioModel->mostrarTodos(); // Asigna a $this->users
        // Mostrar todos los usuarios
        include('views/usuarios/crearUsuario.php');
    }

    public function formularioCrearUsuario(){
        require_once "views/usuarios/crearUsuario.php";
    }
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si se están enviando los valores correctos
            if (!isset($_POST['name']) || !isset($_POST['roles']) || !isset($_POST['password'])) {
                echo "Error: No se han enviado todos los campos requeridos";
                return;
            }
            $nombre = $_POST['name'];
            $rol = $_POST['roles'];
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usuarioModel = new Usuario();
            $existingUser  = $usuarioModel->getByUsername($nombre);
            if ($existingUser) {
                // Si el usuario ya existe, vuelve a mostrar la vista con un mensaje de error
                $errorMessage = "Error: El nombre de usuario ya existe."; // Mensaje de error
                include('views/usuarios/crearUsuario.php'); // Muestra la vista con el error
                return;
            }
            // Llamar al modelo para insertar el usuario en la base de datos
            if ($usuarioModel->insertar($nombre, $rol, $hashedPassword)) {
                // Redirigir a la lista de usuarios si se inserta correctamente
                header('Location: index.php?controller=Usuaris&action=index');
                exit(); // Asegúrate de salir para evitar que el script continúe
            } else {
                // Manejar el error aquí si es necesario
                echo "Error al crear el usuario.";
            }
        }
        $this->index(); // Mostrar la vista en caso de que no sea un POST 
    }

    }
    function deleteUser() {
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            // Llamar al modelo para eliminar el usuario de la base de datos
            $usuarioModel = new Usuario();
            $usuarioModel->eliminar($userId);
        }
        // Redirigir a la lista de usuarios después de la eliminación
        header('Location: index.php?controller=Usuaris&action=index');
        exit();
    }
    function checkUsername() {
        $username = $_GET['username'];
        $usuarioModel = new Usuario();
        $existingUser = $usuarioModel->getByUsername($username);
        $exists = !empty($existingUser);
        echo json_encode(['exists' => $exists]);
        exit;
    }
    
 
