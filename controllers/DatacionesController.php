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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_datacion = $_POST['id_datacion'];
                $nombre_datacion = $_POST['nombre_datacion'];
                $ano_inicio = $_POST['ano_inicio'];
                $ano_final = $_POST['ano_final'];
                
                $datacionesModel = new datacionesModel($this->conn);
                // Aquí cambia el nombre del método para que coincida
                $resultado = $datacionesModel->actualizardataciones($id_datacion, $nombre_datacion, $ano_inicio, $ano_final);
            
                if ($resultado) {
                    header('Location: index.php?controller=dataciones&action=mostrardataciones');
                    exit();
                } else {
                    echo "Error al actualizar la datación.";
                }
            }
        }
    


        public function crearDataciones() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre_datacion = $_POST['nombre_datacion'];
                $ano_inicio = $_POST['ano_inicio'];
                $ano_final = $_POST['ano_final'];
                
                $datacionesModel = new DatacionesModel($this->conn);
                $resultado = $datacionesModel->crearDataciones($nombre_datacion, $ano_inicio, $ano_final);
        
                if ($resultado) {
                    header("Location: index.php?controller=dataciones&action=mostrarDataciones");
                    exit();
                } else {
                    echo "Error al agregar la datación.";
                }
            } else {
                require_once "views/vocabulario/dataciones/crear_dataciones.php";
            }
        }
        


        // Método para deshabilitar una datación
        public function deshabilitar() {

            $id_datacion = $_GET['id'];
            $datacionesModel = new DatacionesModel($this->conn);
            $resultado = $datacionesModel->deshabilitarDatacion($id_datacion);
            
            if ($resultado) {
                header("Location: index.php?controller=dataciones&action=mostrarDataciones");
                exit();
            } else {
                echo "Error al deshabilitar la datación.";
            }
        }

    
        // Método para verificar si es una petición AJAX
        private function esAjax() {
            return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        }
            
        public function mostrarFormulario() {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $datacionesModel = new DatacionesModel($this->conn);
                $datacion = $datacionesModel->getDatacionId($id);
                
                if ($datacion) {
                    require_once 'views/vocabulario/dataciones/editar_dataciones.php';
                } else {
                    echo "Datación no encontrada.";
                }
            } else {
                echo "ID no proporcionado.";
            }
        }
        
        
    
    



}
