<?php

class UbicacionController {
    private $ubicacionModel;

    public function __construct($db) {
        $this->ubicacionModel = new UbicacionModel($db);
    }

    public function verArbol() {
        $ubicaciones = $this->ubicacionModel->getUbicaciones();

        $ubicacionesData = $this->buildTree($ubicaciones);

        require_once "views/admin/vistaArbol.php"; 
    }

    private function buildTree($ubicaciones, $parent_id = null) {
        $tree = [];
        foreach ($ubicaciones as $ubicacion) {
            if ($ubicacion['ubicacion_padre'] == $parent_id) {
                $children = $this->buildTree($ubicaciones, $ubicacion['id_ubicacion']);
                $node = [
                    'id' => $ubicacion['id_ubicacion'],
                    'text' => $ubicacion['nombre_ubicacion'],
                ];
                if ($children) {
                    $node['children'] = $children;
                }
                $tree[] = $node; 
            } 
        }
        return $tree;
    }

    public function crearUbicacion() {
        // Only process if form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $fechaInicio = $_POST['fecha_inicio_ubi'];
            $fechaFin = $_POST['fecha_fin_ubi'];
            $comentario = $_POST['comentario_ubicacion'];
            
            // Get the 'ubicacion_padre' from URL if available
            $ubicacionPadre = isset($_GET['id']) ? $_GET['id'] : null;
    
            // Create new ubicacion through the model
            $this->ubicacionModel->crearUbicacion($fechaInicio, $fechaFin, $comentario, $ubicacionPadre);
            
            // Redirect to the location tree view to avoid resubmission
            header('Location: index.php?controller=ubicacion&action=verArbol');
            exit; // Ensures no further code is executed
        }
    
        // Load the form view if the request is not a POST
        require_once "views/ubicaciones/crearUbicacion.php";
    }
    
    
    
    public function editarUbicacion() {
        $id = $_GET['id'] ?? null;
        $ubicacion = $this->ubicacionModel->getUbicacionById($id); // Fetch data for editing
        require_once "views/admin/editarUbicacion.php";
    }
    
}

?>