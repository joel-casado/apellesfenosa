<?php

class tecnicasController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los tecnicas y los pasa a la vista
    public function mostrartecnicas() {
        // Instanciamos el modelo y pasamos la conexión
        $tecnicasModel = new TecnicasModel($this->conn);

        // Obtenemos los tecnicas desde el modelo
        $tecnicas = $tecnicasModel->gettecnicas();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/tecnicas/tecnicas.php";
    }

    // Método para actualizar el tecnica
    public function actualizar() {
        // Recibir datos del formulario
        $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
        $texto_tecnica = $_POST['texto_tecnica'];

        // Instanciar el modelo
        $tecnicaModel = new tecnicasModel($this->conn);

        // Llamar al método del modelo para actualizar el tecnica
        $resultado = $tecnicaModel->actualizartecnica($codigo_getty_tecnica, $texto_tecnica);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=tecnicas&action=mostrartecnicas");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el tecnica.";
        }
    }

    public function creartecnica() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir datos del formulario
        $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
        $texto_tecnica = $_POST['texto_tecnica'];
    
        // Instanciar el modelo
        $tecnicaModel = new tecnicasModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo tecnica
        $resultado = $tecnicaModel->creartecnica($codigo_getty_tecnica, $texto_tecnica);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=tecnicas&action=mostrartecnicas");  // Redirige a la lista de tecnicas
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el tecnica.";
        }
    } else {
        require_once "views/vocabulario/tecnicas/crear_tecnicas.php";
    }
    }


    public function deshabilitar() {
        $codigo_getty_tecnica = $_GET['id'];
        
        $tecnicaModel = new tecnicasModel($this->conn);
        $resultado = $tecnicaModel->deshabilitartecnica($codigo_getty_tecnica);
        
        if ($this->esAjax()) {
            header('Content-Type: application/json');
            if ($resultado) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al deshabilitar la técnica.']);
            }
            exit();
        } else {
            if ($resultado) {
                header("Location: index.php?controller=tecnicas&action=mostrartecnicas");
                exit();
            } else {
                echo "Error al deshabilitar la técnica.";
            }
        }
    }
    
    
    
    
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    public function mostrarFormulario() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tecnicaModel = new tecnicasModel($this->conn);
            $tecnicas = $tecnicaModel->gettecnicaPorId($id);
            
            if ($tecnicas) {
                require_once 'views/vocabulario/tecnicas/editar_tecnicas.php';
            } else {
                echo "Datación no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
    



}
