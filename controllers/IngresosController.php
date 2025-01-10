<?php

class IngresosController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarIngresos() {
        $ingresoModel = new IngresoModel($this->conn);
        $ingresos = $ingresoModel->getIngresos();
        require_once "views/vocabulario/ingresos/ingresos.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_forma_ingreso = $_POST['id_forma_ingreso'];
            $texto_forma_ingreso = $_POST['texto_forma_ingreso'];
            $ingresoModel = new IngresoModel($this->conn);
            $resultado = $ingresoModel->actualizarIngreso($id_forma_ingreso, $texto_forma_ingreso);
            if ($resultado) {
                header("Location: index.php?controller=ingresos&action=mostrarIngresos");
                exit();
            } else {
                echo "Error al actualizar el ingreso.";
            }
        }
    }

    public function crearIngreso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_forma_ingreso = $_POST['id_forma_ingreso'];
            $texto_forma_ingreso = $_POST['texto_forma_ingreso'];
            $ingresoModel = new IngresoModel($this->conn);
            $resultado = $ingresoModel->crearIngreso($id_forma_ingreso, $texto_forma_ingreso);
            if ($resultado) {
                header("Location: index.php?controller=ingresos&action=mostrarIngresos");
                exit();
            } else {
                echo "Error al agregar el ingreso.";
            }
        } else {
            require_once "views/vocabulario/ingresos/crear_ingresos.php";
        }
    }

    public function deshabilitar() {
        $id_forma_ingreso = $_GET['id'];
        $ingresoModel = new IngresoModel($this->conn);
        $resultado = $ingresoModel->deshabilitarIngreso($id_forma_ingreso);
        if ($resultado) {
            header("Location: index.php?controller=ingresos&action=mostrarIngresos");
            exit();
        } else {
            echo "Error al deshabilitar el ingreso.";
        }
    }

    public function habilitar() {
        $id_forma_ingreso = $_GET['id'];
        $ingresoModel = new IngresoModel($this->conn);
        $resultado = $ingresoModel->habilitarIngreso($id_forma_ingreso);
        if ($resultado) {
            header("Location: index.php?controller=ingresos&action=mostrarIngresos");
            exit();
        } else {
            echo "Error al habilitar el ingreso.";
        }
    }

    public function mostrarFormulario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ingresoModel = new IngresoModel($this->conn);
            $ingreso = $ingresoModel->getIngresoPorId($id);
            if ($ingreso) {
                require_once 'views/vocabulario/ingresos/editar_ingresos.php';
            } else {
                echo "Ingreso no encontrado.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
}
?>
