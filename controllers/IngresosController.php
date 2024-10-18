<?php

class ingresosController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los ingresos y los pasa a la vista
    public function mostraringresos() {
        // Instanciamos el modelo y pasamos la conexión
        $ingresoModel = new ingresoModel($this->conn);

        // Obtenemos los ingresos desde el modelo
        $ingresos = $ingresoModel->getingresos();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/ingresos/ingresos.php";
    }

    // Método para actualizar el ingreso
    public function actualizar() {
        // Recibir datos del formulario
        $id_forma_ingreso = $_POST['id_forma_ingreso'];
        $texto_forma_ingreso = $_POST['texto_forma_ingreso'];

        // Instanciar el modelo
        $ingresoModel = new ingresoModel($this->conn);

        // Llamar al método del modelo para actualizar el ingreso
        $resultado = $ingresoModel->actualizaringreso($id_forma_ingreso, $texto_forma_ingreso);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=ingresos&action=mostraringresos");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el ingreso.";
        }
    }

    public function crearingreso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $id_forma_ingreso = $_POST['id_forma_ingreso'];
            $texto_forma_ingreso = $_POST['texto_forma_ingreso'];
    
            // Instanciar el modelo
            $ingresoModel = new ingresoModel($this->conn);
    
            // Insertar el nuevo autor en la base de datos
            $resultado = $ingresoModel->crearingreso($id_forma_ingreso, $texto_forma_ingreso);
    
            // Redirigir a la lista de autores si la inserción fue exitosa
            if ($resultado) {
                header("Location: index.php?controller=ingresos&action=mostraringresos");
                exit();
            } else {
                echo "Error al agregar el ingreso.";
            }
        } else {
            // Si no es una petición POST, simplemente mostrar el formulario
            require_once "views/vocabulario/ingresos/crear_ingresos.php";
        }
    }


    public function deshabilitar() {
        $id_forma_ingreso = $_GET['id'];
        
        $ingresoModel = new ingresoModel($this->conn);
        $resultado = $ingresoModel->deshabilitaringreso($id_forma_ingreso);
        
        if ($this->esAjax()) {
            header('Content-Type: application/json');
            if ($resultado) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al deshabilitar ingreso.']);
            }
            exit();
        } else {
            if ($resultado) {
                header("Location: index.php?controller=ingresos&action=mostraringresos");
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
        // Capturar el ID de la URL 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el 'id' desde la URL
    
            // Obtener los valores desde el modelo utilizando el ID
            $ingresoModel = new ingresoModel($this->conn);
            $ingreso = $ingresoModel->obteneringreso($id);  // Suponemos que este método obtiene la obra completa
    
            // Validar si se encontró la obra
            if ($ingreso) {
                // Cargar la vista de edición con los datos de la obra
                require_once 'views/vocabulario/ingresos/editar_ingresos.php';
            } else {
                echo "Obra no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
    
    
    



}
