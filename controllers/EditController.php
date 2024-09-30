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
}

// Manejar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EditarController($conn);
    $controller->actualizar($_POST);
    header("Location: ../views/index.php");
    exit();
}
?>
