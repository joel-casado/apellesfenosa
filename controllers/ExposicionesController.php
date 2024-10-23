<?php

class ExposicionesController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los exposiciones y los pasa a la vista
    public function mostrarexposiciones() {
        // Instanciamos el modelo y pasamos la conexión
        $exposicionesModel = new exposicionesModel($this->conn);

        // Obtenemos los exposiciones desde el modelo
        $exposiciones = $exposicionesModel->getexposiciones();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/exposiciones/exposiciones.php";
    }

    // Método para actualizar el exposicion
    public function actualizar() {
        // Recibir datos del formulario
        $id_exposicion = $_POST['id_exposicion'];
        $tipo_exposicion = $_POST['tipo_exposicion'];
        $fecha_inicio_expo = $_POST['fecha_inicio_expo'];
        $fecha_fin_expo = $_POST['fecha_fin_expo'];
        $sitio_exposicion = $_POST['sitio_exposicion'];
        // Instanciar el modelo
        $exposicionesModel = new exposicionesModel($this->conn);

        // Llamar al método del modelo para actualizar el exposicion
        $resultado = $exposicionesModel->actualizarexposicion($id_exposicion, $tipo_exposicion, $fecha_inicio_expo, $fecha_fin_expo, $sitio_exposicion);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=exposiciones&action=mostrarexposiciones");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el exposicion.";
        }
    }

    public function crearexposiciones() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir datos del formulario
            $id_exposicion = $_POST['id_exposicion'];
            $tipo_exposicion = $_POST['tipo_exposicion'];
            $fecha_inicio_expo = $_POST['fecha_inicio_expo'];
            $fecha_fin_expo = $_POST['fecha_fin_expo'];
            $sitio_exposicion = $_POST['sitio_exposicion'];
        
            // Instanciar el modelo
            $exposicionesModel = new exposicionesModel($this->conn);
        
            // Llamar al método del modelo para insertar el nuevo exposicion
            $resultado = $exposicionesModel->crearexposicion($id_exposicion, $tipo_exposicion, $fecha_inicio_expo, $fecha_fin_expo, $sitio_exposicion);
        
            // Redirigir a una página de confirmación o de listado
            if ($resultado) {
                header("Location: index.php?controller=exposiciones&action=mostrarexposiciones");  // Redirige a la lista de exposiciones
                exit(); // Asegúrate de usar exit después de redirigir
            } else {
                echo "Error al agregar el exposicion.";
            }
        } else {
            require_once "views/vocabulario/exposiciones/crear_exposiciones.php";
        }
    }


    public function deshabilitar() {
        $id_exposicion = $_GET['id'];
    
        $exposicionesModel = new exposicionesModel($this->conn);
        $resultado = $exposicionesModel->deshabilitarexposicion($id_exposicion);
    
        if ($resultado) {
            if ($this->esAjax()) {
                echo "success";  // Respuesta simple para peticiones AJAX
            } else {
                header("Location: index.php?controller=exposiciones&action=mostrarexposiciones");
                exit();
            }
        } else {
            echo "Error al deshabilitar el exposicion.";
        }
    }
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    public function mostrarFormulario() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ExposicionesModel = new ExposicionesModel($this->conn);
            $Exposicion = $ExposicionesModel->getexposicionPorId($id);
            
            if ($Exposicion) {
                require_once 'views/vocabulario/exposiciones/editar_exposiciones.php';
            } else {
                echo "Datación no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
    
    



}
