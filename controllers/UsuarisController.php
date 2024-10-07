<?php

class UsuarisController {
    private $users = []; // Cambia esto a un array vacío inicialmente

    public function index() {
        // Obtener todos los usuarios desde el modelo
        $usuarioModel = new Usuario();
        $this->users = $usuarioModel->mostrarTodos(); // Asigna a $this->users
        // Mostrar todos los usuarios
        include('views/usuarios/usuaris.php');
    }

    public function formularioCrearUsuario(){
        require_once "views/usuarios/crearUsuario.php";
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Recibir los datos del formulario
            $nombre = $_POST['name'];
            $rol = $_POST['rol'];
            $password = $_POST['password'];
        
                // Llamar al modelo para insertar el usuario en la base de datos
            $usuarioModel = new Usuario();
            if ($usuarioModel->insertar($nombre, $password, $rol )) {
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

    public function deleteUser() {
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
}
