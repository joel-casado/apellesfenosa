<?php

class DatacionesController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarDataciones() {
        $datacionesModel = new DatacionesModel($this->conn);
        $dataciones = $datacionesModel->getDataciones();
        require_once "views/vocabulario/dataciones/dataciones.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_datacion = $_POST['id_datacion'];
            $nombre_datacion = $_POST['nombre_datacion'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];
            $datacionesModel = new DatacionesModel($this->conn);
            $resultado = $datacionesModel->actualizarDataciones($id_datacion, $nombre_datacion, $ano_inicio, $ano_final);
            if ($resultado) {
                header('Location: index.php?controller=dataciones&action=mostrarDataciones');
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

    public function habilitar() {
        $id_datacion = $_GET['id'];
        $datacionesModel = new DatacionesModel($this->conn);
        $resultado = $datacionesModel->habilitarDatacion($id_datacion);
        if ($resultado) {
            header("Location: index.php?controller=dataciones&action=mostrarDataciones");
            exit();
        } else {
            echo "Error al habilitar la datación.";
        }
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
?>
