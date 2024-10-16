<?php

class UsuarisController {
    private $users = [];

    public function index() {
        $usuarioModel = new Usuario();
        $this->users = $usuarioModel->mostrarTodos();
        include('views/usuarios/crearUsuario.php');
    }

    public function formularioCrearUsuario() {
        require_once "views/usuarios/crearUsuario.php";
    }

    public function mostrarPanelAdmin(){
        require_once "views/admin/panelAdmin.php";
    }

    public function listar_usuarios() {
        // Crear instancia del modelo Usuario
        $usuarioModel = new Usuario();

        // Obtener todos los usuarios
        $usuarios = $usuarioModel->mostrarTodos();

        // Incluir la vista que mostrará los usuarios
        require_once "views/usuarios/listarUsuarios.php";
    }

    public function createUser  () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['name'];
            $rol = $_POST['rol'];
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usuarioModel = new Usuario();
            $existingUser   = $usuarioModel->getByUsername($nombre);
            if ($existingUser ) {
                $errorMessage = "Error: El nombre de usuario ya existe.";
                include('views/usuarios/crearUsuario.php');
                return;
            }
            if ($usuarioModel->insertar($nombre, $rol, $hashedPassword)) {
                header('Location: index.php?controller=Usuaris&action=listar_usuarios');
                exit();
            } else {
                echo "Error al crear el usuario.";
            }
        }
        $this->index();
    }

    public function checkUsername() {
        $username = $_GET['username'];
        $usuarioModel = new Usuario();
        $existingUser  = $usuarioModel->getByUsername($username);
        $exists = !empty($existingUser );
        echo json_encode(['exists' => $exists]);
        exit;
    }

    public function editarUsuario() {
        $usuarioModel = new Usuario();
        $nombreUsuario = $_GET['nombre'] ?? null;
        if (!$nombreUsuario) {
            echo "Error: No se ha proporcionado un nombre de usuario.";
            return;
        }
        $user = $usuarioModel->getByUsername($nombreUsuario);
        if ($user) {
            include 'views/usuarios/editarUsuario.php';
        } else {
            echo "Usuario no encontrado.";
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreOriginal = $_POST['nombre_original']; // El nombre antes de editar
            $nombreNuevo = $_POST['name']; // El nuevo nombre
            $rol = $_POST['rol'];
            $activo = $_POST['activo'];
    
            $usuarioModel = new Usuario();
            $usuarioModel->actualizar($nombreOriginal, $nombreNuevo, $rol, $activo);
    
            header('Location: index.php?controller=Usuaris&action=listar_usuarios');

        }
    }
    
}
