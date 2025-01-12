<?php

class MaterialesController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarMateriales() {
        $materialModel = new MaterialModel($this->conn);
        $materiales = $materialModel->getMateriales();
        require_once "views/vocabulario/materiales/material.php";
    }

    public function actualizar() {
        $codigo_getty_material = $_POST['codigo_getty_material'];
        $texto_material = $_POST['texto_material'];
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->actualizarMaterial($codigo_getty_material, $texto_material);
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");
            exit();
        } else {
            echo "Error al actualizar el material.";
        }
    }

    public function crearMaterial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_getty_material = $_POST['codigo_getty_material'];
            $texto_material = $_POST['texto_material'];
            $materialModel = new MaterialModel($this->conn);

            // Verificar si el ID ya existe
            if ($materialModel->existeMaterial($codigo_getty_material)) {
                $error = "El codi Getty Material ja està en ús.";
                require_once "views/vocabulario/materiales/crear_material.php";
                return;
            }

            $resultado = $materialModel->crearMaterial($codigo_getty_material, $texto_material);
            if ($resultado) {
                header("Location: index.php?controller=Materiales&action=mostrarMateriales");
                exit();
            } else {
                echo "Error al agregar el material.";
            }
        } else {
            require_once "views/vocabulario/materiales/crear_material.php";
        }
    }

    public function deshabilitar() {
        $codigo_getty_material = $_GET['id'];
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->deshabilitarMaterial($codigo_getty_material);
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");
            exit();
        } else {
            echo "Error al deshabilitar el material.";
        }
    }

    public function habilitar() {
        $codigo_getty_material = $_GET['id'];
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->habilitarMaterial($codigo_getty_material);
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");
            exit();
        } else {
            echo "Error al habilitar el material.";
        }
    }

    public function mostrarFormulario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $MaterialModel = new MaterialModel($this->conn);
            $material = $MaterialModel->obtenerMaterial($id);
            if ($material) {
                require_once 'views/vocabulario/materiales/editar_vocabulario.php';
            } else {
                echo "Obra no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
}
?>
