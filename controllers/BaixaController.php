<?php
session_start();
require_once 'models/BaixaModel.php';
class BaixaController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    public function mostrarFormulario() {
        // Obtener el ID de la obra desde la URL
        $id = $_GET['id'];

        // Cargar la información de la obra desde el modelo
        $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);

        // Cargar la vista del formulario
        require_once 'views/editar_obra/baixa.php';
    }

    public function mostrarFormularioalta() {
        // Obtener el ID de la obra desde la URL
        $id = $_GET['id'];

        // Cargar la información de la obra desde el modelo
        $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);

        // Cargar la vista del formulario
        require_once 'views/editar_obra/alta.php';
    }

    public function procesarBaja() {
        // Obtener los datos enviados desde el formulario
        $baja = $_POST['baja'];
        $causa_baja = $_POST['causa_baja'];
        $persona_autorizada = $_POST['persona_autorizada'];
        $fecha_baja = $_POST['fecha'];
        $id = $_POST['id'];
    
        // Llamar al modelo para actualizar la obra
        $baixaModel = new BaixaModel($this->conn);
        $resultado = $baixaModel->darDeBaja($baja, $causa_baja, $persona_autorizada, $fecha_baja, $id);
    
        // Redirigir con un mensaje de éxito o error
        if ($resultado) {
            $_SESSION['mensaje'] = "Baixa realitzada correctament.";
            $_SESSION['tipo_mensaje'] = 'success'; // Tipo de mensaje (éxito)
        } else {
            $_SESSION['mensaje'] = "Error en realitzar la baixa.";
            $_SESSION['tipo_mensaje'] = 'error'; // Tipo de mensaje (error)
        }
        header('Location: index.php?controller=Obras&action=mostrarFicha&id=' . $id);
        exit;
    }
    
    public function darAlta() {
        // Obtener los datos enviados desde el formulario
        $causa_alta = $_POST['causa_alta'];
        $persona_autorizada = $_POST['persona_autorizada'];
        $fecha_alta = $_POST['fecha'];
        $id = $_POST['id'];
    
        // Llamar al modelo para actualizar la obra
        $baixaModel = new BaixaModel($this->conn);
        $resultado = $baixaModel->darAlta($causa_alta, $persona_autorizada, $fecha_alta, $id);
    
        // Redirigir con un mensaje de éxito o error
        if ($resultado) {
            $_SESSION['mensaje'] = "Alta realitzada correctament.";
        } else {
            $_SESSION['mensaje'] = "Error en realitzar l'alta.";
        }
        header('Location: index.php?controller=Obras&action=mostrarFicha&id=' . $id);
        exit;
    }
    


    
}
