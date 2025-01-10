<?php

class ClasificacionesController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarClasificaciones() {
        $ClasificacionesModel = new ClasificacionesModel($this->conn);
        $Clasificaciones = $ClasificacionesModel->getClasificaciones();
        require_once "views/vocabulario/clasificaciones/clasificaciones.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_clasificacion = $_POST['id_clasificacion'];
            $texto_clasificacion = $_POST['texto_clasificacion'];
            $ClasificacionesModel = new ClasificacionesModel($this->conn);
            $resultado = $ClasificacionesModel->actualizarClasificaciones($id_clasificacion, $texto_clasificacion);
            if ($resultado) {
                header("Location: index.php?controller=clasificaciones&action=mostrarclasificaciones");
                exit();
            } else {
                echo "Error al actualizar la clasificación.";
            }
        }
    }

    public function crearClasificaciones() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_clasificacion = $_POST['id_clasificacion'];
            $texto_clasificacion = $_POST['texto_clasificacion'];
            $ClasificacionesModel = new ClasificacionesModel($this->conn);
            $resultado = $ClasificacionesModel->crearClasificaciones($id_clasificacion, $texto_clasificacion);
            if ($resultado) {
                header("Location: index.php?controller=clasificaciones&action=mostrarclasificaciones");
                exit();
            } else {
                echo "Error al agregar la clasificación.";
            }
        } else {
            require_once "views/vocabulario/clasificaciones/crear_clasificaciones.php";
        }
    }

    public function deshabilitar() {
        $id_clasificacion = $_GET['id'];
        $ClasificacionesModel = new ClasificacionesModel($this->conn);
        $resultado = $ClasificacionesModel->deshabilitarClasificaciones($id_clasificacion);
        if ($resultado) {
            header("Location: index.php?controller=clasificaciones&action=mostrarclasificaciones");
            exit();
        } else {
            echo "Error al deshabilitar la clasificación.";
        }
    }

    public function habilitar() {
        $id_clasificacion = $_GET['id'];
        $ClasificacionesModel = new ClasificacionesModel($this->conn);
        $resultado = $ClasificacionesModel->habilitarClasificaciones($id_clasificacion);
        if ($resultado) {
            header("Location: index.php?controller=clasificaciones&action=mostrarclasificaciones");
            exit();
        } else {
            echo "Error al habilitar la clasificación.";
        }
    }

    public function mostrarFormulario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ClasificacionesModel = new ClasificacionesModel($this->conn);
            $clasificacion = $ClasificacionesModel->getClasificacionId($id);
            if ($clasificacion) {
                require_once 'views/vocabulario/clasificaciones/editar_clasificaciones.php';
            } else {
                echo "Clasificación no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
}
?>
