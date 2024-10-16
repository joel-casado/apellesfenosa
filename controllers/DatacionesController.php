<?php

class datacionesController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los dataciones y los pasa a la vista
    public function mostrardataciones() {
        // Instanciamos el modelo y pasamos la conexión
        $datacionesModel = new datacionesModel($this->conn);

        // Obtenemos los dataciones desde el modelo
        $dataciones = $datacionesModel->getdataciones();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/dataciones/dataciones.php";
    }

    // Método para actualizar las dataciones
        public function actualizar() {
            // Recibir datos del formulario
            $id_datacion = $_POST['id_datacion'];
            $nombre_datacion = $_POST['nombre_datacion'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];

            // Instanciar el modelo
            $datacionesModel = new DatacionesModel($this->conn);

            // Llamar al método del modelo para actualizar las dataciones
            $resultado = $datacionesModel->actualizardataciones($id_datacion, $nombre_datacion, $ano_inicio, $ano_final);

            // Redirigir a una página de confirmación o de listado
            if ($resultado) {
                header("Location: views/vocabulario/dataciones/dataciones.php");  // Redirige de vuelta a la página de dataciones
                exit(); // Asegúrate de usar exit después de redirigir
            } else {
                echo "Error al actualizar las dataciones.";
            }
        }


        public function creardataciones() {
            // Recibir datos del formulario
            $nombre_datacion = $_POST['nombre_datacion'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];
            
            // Instanciar el modelo
            $datacionesModel = new DatacionesModel($this->conn);
            
            // Llamar al método del modelo para insertar la nueva datación
            $resultado = $datacionesModel->creardataciones($nombre_datacion, $ano_inicio, $ano_final);
            
            // Redirigir a una página de confirmación o de listado
            if ($resultado) {
                header("Location: views/vocabulario/dataciones/dataciones.php");  // Redirige a la lista de dataciones
                exit(); // Asegúrate de usar exit después de redirigir
            } else {
                echo "Error al agregar la datación.";
            }
        }
        


        // Método para deshabilitar una datación
    public function deshabilitar() {
        $id_datacion = $_GET['id'];
    
        $datacionesModel = new DatacionesModel($this->conn);
        $resultado = $datacionesModel->deshabilitarDatacion($id_datacion);
    
        if ($resultado) {
            if ($this->esAjax()) {
                echo "success";  // Respuesta simple para peticiones AJAX
            } else {
                header("Location: views/vocabulario/dataciones.php");
                exit();
            }
        } else {
            echo "Error al deshabilitar la datación.";
        }
    }
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
        
        
        
    
    



}
