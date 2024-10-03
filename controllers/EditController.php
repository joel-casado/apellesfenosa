<?php
include '../models/database.php';
include '../models/editModel.php';

class EditarController {
    private $obra;

    public function __construct($db) {
        $this->obra = new Obra($db);
    }

    public function editar($id) {
        return $this->obra->obtenerObra($id);
    }

    public function actualizar($data) {
        return $this->obra->actualizarObra($data['numero_registro'], $data['titulo'], $data['autor'], $data['descripcion']);
    }

    public function mostrarFormulario($id) {
        // Obtener los valores únicos desde el modelo
        $obra = $this->obra->obtenerObra($id);
        $autores = $this->obra->getAutores(); // Cambia esto
        $anoInicio = $this->obra->getAnoInicio();
        $anoFinal = $this->obra->getAnoFinal();
        $materiales = $this->obra->getMateriales();
        $tecnicas = $this->obra->getTecnicas();
        $clasificacionesGenericas = $this->obra->getClasificacionesGenericas(); // Cambia esto
        $formasIngreso = $this->obra->getFormasIngreso();
        $estadosConservacion = $this->obra->getEstadosConservacion();
    
        // Incluir la vista y pasarle los datos
        require_once 'views/editar.php';
    }
    
}

// Manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EditarController($conn);
    $controller->actualizar($_POST);
    header("Location: ../views/index.php");
    exit();
}

// Si la solicitud es GET (mostrar el formulario de edición)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $controller = new EditarController($conn);
    $controller->mostrarFormulario($_GET['id']);
}


?>
