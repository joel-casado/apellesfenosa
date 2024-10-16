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
        $tecnicaModel = new tecnicaModel($this->conn);

        // Obtenemos los tecnicas desde el modelo
        $tecnicas = $tecnicaModel->gettecnicas();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/tecnica.php";
    }

    // Método para actualizar el tecnica
    public function actualizar() {
        // Recibir datos del formulario
        $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
        $texto_tecnica = $_POST['texto_tecnica'];

        // Instanciar el modelo
        $tecnicaModel = new tecnicaModel($this->conn);

        // Llamar al método del modelo para actualizar el tecnica
        $resultado = $tecnicaModel->actualizartecnica($codigo_getty_tecnica, $texto_tecnica);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/tecnicas/tecnica.php");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el tecnica.";
        }
    }

    public function creartecnica() {
        // Recibir datos del formulario
        $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
        $texto_tecnica = $_POST['texto_tecnica'];
    
        // Instanciar el modelo
        $tecnicaModel = new tecnicaModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo tecnica
        $resultado = $tecnicaModel->creartecnica($codigo_getty_tecnica, $texto_tecnica);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/tecnicas/tecnica.php");  // Redirige a la lista de tecnicas
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el tecnica.";
        }
    }


    public function deshabilitar() {
        $codigo_getty_tecnica = $_GET['id'];
    
        $tecnicaModel = new tecnicaModel($this->conn);
        $resultado = $tecnicaModel->deshabilitartecnica($codigo_getty_tecnica);
    
        if ($resultado) {
            if ($this->esAjax()) {
                echo "success";  // Respuesta simple para peticiones AJAX
            } else {
                header("Location: views/vocabulario/ver_vocabulario.php");
                exit();
            }
        } else {
            echo "Error al deshabilitar el tecnica.";
        }
    }
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    
    



}
