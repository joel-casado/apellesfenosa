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

    public function anadirObra() {
        // Obtener las obras que no están adscritas a ninguna exposición
        $obras = $this->modelo->getObrasSinExposicion(); // Asegúrate de tener este método en tu modelo
    
        // Cargar la vista y pasarle los datos de las obras
        require_once 'views/exposiciones/añadir_obra.php';
    }
    public function anadirObrasSeleccionadas() {
        // Configuración de respuesta como JSON
        header('Content-Type: application/json');
    
        $id_exposicion = $_GET['id'] ?? null; // Obtener el ID de la exposición
        $input = json_decode(file_get_contents("php://input"), true); // Obtener el JSON enviado
        $obrasSeleccionadas = $input['exposicion_ids'] ?? []; // Obtener las obras seleccionadas
    
        if (!$id_exposicion || empty($obrasSeleccionadas)) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
            exit();
        }
    
        foreach ($obrasSeleccionadas as $numero_registro) {
            $this->modelo->addObraToExposicion($numero_registro, $id_exposicion);
        }
    
        echo json_encode(['success' => true, 'message' => 'Obras añadidas correctamente.']);
        exit();
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
    
    
    public function editar_expo() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $expo = $this->modelo->getExposicionById($id);
            require_once 'views/exposiciones/editar_expo.php';
        } else {
            // Manejar el caso en que no se proporciona un ID
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }

    }

    public function update() {
        if (isset($_POST['id_exposicion'])) {
            $id = $_POST['id_exposicion']; // ID obtenido del formulario
            $expo = [
                'exposicion' => $_POST['exposicion'],
                'inicio' => $_POST['inicio'],
                'fin' => $_POST['fin'],
                'tipo' => $_POST['tipo'],
                'lugar' => $_POST['lugar'],
            ]; // Recoge todos los datos del formulario
            $this->modelo->updateExposicion($id, $expo); // Actualiza la exposición
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones'); // Redirige a la lista
            exit();
        } else {
            // Manejar el caso en que no se proporciona un ID
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    }
    public function ver_obras() {
        if (isset($_GET['id'])) {
            $id_exposicion = $_GET['id'];
            // Llamar al método del modelo para obtener las obras
            $obras = $this->modelo->ver_obras($id_exposicion);
        } else {
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    
        // Cargar la vista y pasarle los datos de las obras
        require_once "views/exposiciones/ver_obras.php";
    }
    
}
?>