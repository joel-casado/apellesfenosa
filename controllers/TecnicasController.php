<?php

class TecnicasController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarTecnicas() {
        $tecnicasModel = new TecnicasModel($this->conn);
        $tecnicas = $tecnicasModel->getTecnicas();
        require_once "views/vocabulario/tecnicas/tecnicas.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
            $texto_tecnica = $_POST['texto_tecnica'];
            $tecnicasModel = new TecnicasModel($this->conn);
            $resultado = $tecnicasModel->actualizarTecnica($codigo_getty_tecnica, $texto_tecnica);
            if ($resultado) {
                header("Location: index.php?controller=tecnicas&action=mostrarTecnicas");
                exit();
            } else {
                echo "Error al actualizar la técnica.";
            }
        }
    }

    public function crearTecnica() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_getty_tecnica = $_POST['codigo_getty_tecnica'];
            $texto_tecnica = $_POST['texto_tecnica'];
            $tecnicasModel = new TecnicasModel($this->conn);
            $resultado = $tecnicasModel->crearTecnica($codigo_getty_tecnica, $texto_tecnica);
            if ($resultado) {
                header("Location: index.php?controller=tecnicas&action=mostrarTecnicas");
                exit();
            } else {
                echo "Error al agregar la técnica.";
            }
        } else {
            require_once "views/vocabulario/tecnicas/crear_tecnicas.php";
        }
    }

    public function deshabilitar() {
        $codigo_getty_tecnica = $_GET['id'];
        $tecnicasModel = new TecnicasModel($this->conn);
        $resultado = $tecnicasModel->deshabilitarTecnica($codigo_getty_tecnica);
        if ($resultado) {
            header("Location: index.php?controller=tecnicas&action=mostrarTecnicas");
            exit();
        } else {
            echo "Error al deshabilitar la técnica.";
        }
    }

    public function habilitar() {
        $codigo_getty_tecnica = $_GET['id'];
        $tecnicasModel = new TecnicasModel($this->conn);
        $resultado = $tecnicasModel->habilitarTecnica($codigo_getty_tecnica);
        if ($resultado) {
            header("Location: index.php?controller=tecnicas&action=mostrarTecnicas");
            exit();
        } else {
            echo "Error al habilitar la técnica.";
        }
    }

    public function mostrarFormulario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tecnicasModel = new TecnicasModel($this->conn);
            $tecnica = $tecnicasModel->getTecnicaPorId($id);
            if ($tecnica) {
                require_once 'views/vocabulario/tecnicas/editar_tecnicas.php';
            } else {
                echo "Técnica no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
}
?>
