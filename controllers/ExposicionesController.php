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

    public function anadirObra(){
        require_once 'views/exposiciones/añadir_obra.php';
    }
    public function anadirObrasSeleccionadas() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['obra_ids'])) {
            $obraIds = $_POST['obra_ids'];
            $id_exposicion = $_GET['id']; // Suponiendo que el ID de la exposición esté en la URL
    
            foreach ($obraIds as $obraId) {
                $this->modelo->addObraToExposicion($obraId, $id_exposicion);
            }
    
            // Redirigir a la página de ver obras
            header('Location: index.php?controller=Exposiciones&action=ver_obras&id=' . $id_exposicion);
            exit();
        }
    }
    //Md reactualiza

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
    
        // Si no es un POST, mostrar el formulario
        require_once 'views/exposiciones/crea_expo.php';
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
        if (isset($_GET['id'])) { // Cambiar de POST a GET para obtener el ID desde la URL
            $id_exposicion = $_GET['id']; // Obtener el ID de la exposición desde la URL
            $obras = $this->modelo->ver_obras($id_exposicion); // Llamar al método del modelo para obtener las obras
        } else {
            // Manejar el caso en que no se proporciona un ID
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
        // Crear una instancia de la clase de base de datos para obtener la conexión
        $db = (new Database())->conectar();
        $obrasModel = new ObrasModel($db);
        $obras = $obrasModel->getObrasExpo($id_exposicion);

        // Cargar la vista y pasarle los datos de las obras
        require_once "views/exposiciones/ver_obras.php";
    }
}
?>