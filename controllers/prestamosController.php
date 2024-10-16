<?php

class prestamosController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los prestamos y los pasa a la vista
    public function mostrarprestamos() {
        // Instanciamos el modelo y pasamos la conexión
        $prestamosModel = new prestamosModel($this->conn);

        // Obtenemos los prestamos desde el modelo
        $prestamos = $prestamosModel->getprestamos();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/prestamos/prestamos.php";
    }

    // Método para actualizar el prestamo
    public function actualizar() {

        // Recibir datos del formulario
        $id_prestamo = $_POST['id_prestamo'];
        $numero_registro = $_POST['numero_registro'];
        $fecha_prestacion = $_POST['fecha_prestacion'];
        $fecha_devolucion = $_POST['fecha_devolucion'];
        // Instanciar el modelo
        $prestamosModel = new prestamosModel($this->conn);

        // Llamar al método del modelo para actualizar el prestamo
        $resultado = $prestamosModel->actualizarprestamo($id_prestamo, $numero_registro, $fecha_prestacion, $fecha_devolucion);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/prestamos/prestamos.php");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el prestamo.";
        }
    }

    public function crearprestamos() {
        // Recibir datos del formulario
        $id_prestamo = $_POST['id_prestamo'];
        $numero_registro = $_POST['numero_registro'];
        $fecha_prestacion = $_POST['fecha_prestacion'];
        $fecha_devolucion = $_POST['fecha_devolucion'];
    
        // Instanciar el modelo
        $prestamosModel = new prestamosModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo prestamo
        $resultado = $prestamosModel->crearprestamo($id_prestamo, $numero_registro, $fecha_prestacion, $fecha_devolucion);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/prestamos/prestamos.php");  // Redirige a la lista de prestamos
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el prestamo.";
        }
    }


    public function deshabilitar() {
        $id_prestamo = $_GET['id'];
    
        $prestamosModel = new prestamosModel($this->conn);
        $resultado = $prestamosModel->deshabilitarprestamo($id_prestamo);
    
        if ($resultado) {
            if ($this->esAjax()) {
                echo "success";  // Respuesta simple para peticiones AJAX
            } else {
                header("Location: views/vocabulario/prestamos/prestamos.php");
                exit();
            }
        } else {
            echo "Error al deshabilitar el prestamo.";
        }
    }
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    
    



}
