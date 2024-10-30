<?php

class ExposicionesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Exposiciones();
    }

    public function listado_exposiciones() {
        $exposiciones = $this->modelo->getExposiciones();
        require_once 'views/exposiciones/listado_exposiciones.php';
    }

    public function crea_expo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos del formulario
            $expo = [
                'exposicion' => $_POST['exposicion'],
                'inicio' => $_POST['inicio'],
                'fin' => $_POST['fin'],
                'tipo' => $_POST['tipo'],
                'lugar' => $_POST['lugar'],
            ];
    
            // Llamar al método para crear la exposición
            $this->modelo->createExposicion($expo);
            
            // Redirigir a la lista de exposiciones después de crear
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    
        // Si no es un POST, mostrar el formulario
        require_once 'views/exposiciones/crea_expo.php';
    }
    
    public function editar_expo($id) {
        $expo = $this->modelo->getExposicionById($id);
        require_once 'views/exposiciones/editar_expo.php';
    }

    public function update($id) {
        $expo = $_POST;
        $this->modelo->updateExposicion($id, $expo);
        header('Location: index.php?controller=Exposiciones&action=index');
    }
}
?>