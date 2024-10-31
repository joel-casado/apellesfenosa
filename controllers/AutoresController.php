<?php
//h
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_autor = $_POST['codigo_autor'];
            $nombre_autor = $_POST['nombre_autor'];
           
            // Instanciar el modelo con la conexión
            $autorModel = new AutoresModel($this->conn);

            // actualizar la obra
            $resultado = $autorModel->actualizarAutores($codigo_autor, $nombre_autor);

            if ($resultado) {
                // Redirigir a la lista de obras después de la actualización
                header('Location: index.php?controller=Autores&action=mostrarAutores');
                exit();
            } else {
                echo "Error al actualizar la obra.";
            }
        }
    }

    // Método para crear un nuevo autor
    public function crearAutores() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $codigo_autor = $_POST['codigo_autor'];
            $nombre_autor = $_POST['nombre_autor'];
    
            // Instanciar el modelo
            $AutoresModel = new AutoresModel($this->conn);
    
            // Insertar el nuevo autor en la base de datos
            $resultado = $AutoresModel->crearAutores($codigo_autor, $nombre_autor);
    
            // Redirigir a la lista de autores si la inserción fue exitosa
            if ($resultado) {
                header("Location: index.php?controller=autores&action=mostrarAutores");
                exit();
            } else {
                echo "Error al agregar el autor.";
            }
        } else {
            // Si no es una petición POST, simplemente mostrar el formulario
            require_once "views/vocabulario/autores/crear_autor.php";
        }
    }
    

    public function deshabilitar() {
        $codigo_autor = $_GET['id'];  // Asegúrate de que el id se pase correctamente en la URL
    
        $AutoresModel = new AutoresModel($this->conn);
        $resultado = $AutoresModel->deshabilitarAutores($codigo_autor);
    
        // Redirigir a la lista de Autores después de deshabilitar
        if ($resultado) {
            header("Location: index.php?controller=autores&action=mostrarAutores"); // Redirige a la lista de autores
            exit();
        } else {
            echo "Error al deshabilitar el autor.";
        }
    }

    public function mostrarFormulario() {
        // Capturar el ID de la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el 'id' desde la URL
    
            // Obtener los valores desde el modelo utilizando el ID
            $AutorModel = new AutoresModel($this->conn);
            $autor = $AutorModel->obtenerAutor($id);  // Suponemos que este método obtiene la obra completa
    
            // Validar si se encontró la obra
            if ($autor) {
                // Cargar la vista de edición con los datos de la obra
                require_once 'views/vocabulario/autores/editar_autor.php';
            } else {
                echo "Obra no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
    
}
