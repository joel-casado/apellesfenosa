<?php

class AutoresController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los Autores y los pasa a la vista
    public function mostrarAutores() {
        // Instanciamos el modelo y pasamos la conexión
        $AutoresModel = new AutoresModel($this->conn);

        // Obtenemos los Autores desde el modelo
        $Autores = $AutoresModel->getAutores();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/Autores/Autores.php";
    }

    // Método para actualizar el Autores
    public function actualizar() {
        // Recibir datos del formulario
        $codigo_autor = $_POST['codigo_autor'];
        $nombre_autor = $_POST['nombre_autor'];

        // Instanciar el modelo
        $AutoresModel = new AutoresModel($this->conn);

        // Llamar al método del modelo para actualizar el Autores
        $resultado = $AutoresModel->actualizarAutores($codigo_autor, $nombre_autor);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/Autores/Autores.php");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el Autores.";
        }
    }

    public function crearAutores() {
        // Recibir datos del formulario
        $codigo_autor = $_POST['codigo_autor'];
        $nombre_autor = $_POST['nombre_autor'];
    
        // Instanciar el modelo
        $AutoresModel = new AutoresModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo Autores
        $resultado = $AutoresModel->crearAutores($codigo_autor, $nombre_autor);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/Autores/Autores.php");  // Redirige a la lista de Autores
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el Autores.";
        }
    }


    public function deshabilitar() {
        $codigo_autor = $_GET['id'];  // Asegúrate de que el id se pase correctamente en la URL
    
        $AutoresModel = new AutoresModel($this->conn);
        $resultado = $AutoresModel->deshabilitarAutores($codigo_autor);
    
        // Redirigir a la lista de Autores después de deshabilitar
        if ($resultado) {
            header("Location: views/vocabulario/Autores/Autores.php"); // Cambia esta ruta según tu estructura
            exit();
        } else {
            echo "Error al deshabilitar el Autores.";
        }
    }
    
    



}
