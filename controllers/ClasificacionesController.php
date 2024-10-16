<?php

class ClasificacionesController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los Clasificaciones y los pasa a la vista
    public function mostrarClasificaciones() {
        // Instanciamos el modelo y pasamos la conexión
        $ClasificacionesModel = new ClasificacionesModel($this->conn);

        // Obtenemos los Clasificaciones desde el modelo
        $Clasificaciones = $ClasificacionesModel->getClasificaciones();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/Clasificaciones/Clasificaciones.php";
    }

    // Método para actualizar el Clasificaciones
    public function actualizar() {
        // Recibir datos del formulario
        $id_clasificacion = $_POST['id_clasificacion'];
        $texto_clasificacion = $_POST['texto_clasificacion'];

        // Instanciar el modelo
        $ClasificacionesModel = new ClasificacionesModel($this->conn);

        // Llamar al método del modelo para actualizar el Clasificaciones
        $resultado = $ClasificacionesModel->actualizarClasificaciones($id_clasificacion, $texto_clasificacion);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/Clasificaciones/Clasificaciones.php");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el Clasificaciones.";
        }
    }

    public function crearClasificaciones() {
        // Recibir datos del formulario
        $id_clasificacion = $_POST['id_clasificacion'];
        $texto_clasificacion = $_POST['texto_clasificacion'];
    
        // Instanciar el modelo
        $ClasificacionesModel = new ClasificacionesModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo Clasificaciones
        $resultado = $ClasificacionesModel->crearClasificaciones($id_clasificacion, $texto_clasificacion);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/Clasificaciones/Clasificaciones.php");  // Redirige a la lista de Clasificaciones
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el Clasificaciones.";
        }
    }


    public function deshabilitar() {
        $id_clasificacion = $_GET['id'];  // Asegúrate de que el id se pase correctamente en la URL
    
        $ClasificacionesModel = new ClasificacionesModel($this->conn);
        $resultado = $ClasificacionesModel->deshabilitarClasificaciones($id_clasificacion);
    
        // Redirigir a la lista de Clasificaciones después de deshabilitar
        if ($resultado) {
            header("Location: views/vocabulario/Clasificaciones/Clasificaciones.php"); // Cambia esta ruta según tu estructura
            exit();
        } else {
            echo "Error al deshabilitar el Clasificaciones.";
        }
    }
    
    



}
