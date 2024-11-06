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

    private function buildTree($ubicaciones, $parent_id = null, $visited = []) {
        $tree = [];
    
        // Avoid cycles by marking nodes as visited
        if (in_array($parent_id, $visited)) {
            return []; // Break out of the recursion if we detect a cycle
        }
        
        // Add the current parent_id to visited list
        $visited[] = $parent_id;
    
        foreach ($ubicaciones as $ubicacion) {
            if ($ubicacion['ubicacion_padre'] == $parent_id) {
                $children = $this->buildTree($ubicaciones, $ubicacion['id_ubicacion'], $visited);
                $node = [
                    'id' => $ubicacion['id_ubicacion'],
                    'text' => $ubicacion['nombre_ubicacion'],
                ];
                if (!empty($children)) {
                    $node['children'] = $children;
                }
                $tree[] = $node;
            }
        }
    
        return $tree;
    }
    

    public function crearUbicacion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreUbicacion = $_POST['nombre_ubicacion'];
            
            // Convert dates from DD/MM/YYYY to YYYY-MM-DD
            $fechaInicio = !empty($_POST['fecha_inicio_ubi']) 
                ? DateTime::createFromFormat('d/m/Y', $_POST['fecha_inicio_ubi'])->format('Y-m-d')
                : null;
            $fechaFin = !empty($_POST['fecha_fin_ubi']) 
                ? DateTime::createFromFormat('d/m/Y', $_POST['fecha_fin_ubi'])->format('Y-m-d')
                : null;
    
            $comentario = $_POST['comentario_ubicacion'];
            $ubicacionPadre = isset($_GET['padre_id']) ? $_GET['padre_id'] : null;
    
            // Call the model to create a new ubicacion
            $this->ubicacionModel->crearUbicacion($fechaInicio, $fechaFin, $comentario, $ubicacionPadre, $nombreUbicacion);
    
            // Redirect to prevent resubmission
            header('Location: index.php?controller=ubicacion&action=verArbol');
            exit;
        }
    
        require_once "views/ubicaciones/crearUbicacion.php";
    }
    
    
    
    
    
    public function editarUbicacion() {
        // Get the location ID from the URL
        $id = $_GET['id'] ?? null;
    
        // Fetch location data from the model
        $ubicacion = $this->ubicacionModel->getUbicacionById($id);
    
        // Load the editing view with location data
        require_once "views/ubicaciones/editarUbicacion.php";
    }
    
    
    public function updateUbicacion() {
        $id = $_GET['id'] ?? null;
    
        // Retrieve updated data from POST
        $nombreUbicacion = $_POST['nombre_ubicacion'];
        
        // Convert dates from dd/mm/yyyy to yyyy-mm-dd format
        $fechaInicio = DateTime::createFromFormat('d/m/Y', $_POST['fecha_inicio_ubi'])->format('Y-m-d');
        $fechaFin = !empty($_POST['fecha_fin_ubi']) 
                    ? DateTime::createFromFormat('d/m/Y', $_POST['fecha_fin_ubi'])->format('Y-m-d') 
                    : null;
    
        $comentario = $_POST['comentario_ubicacion'];
    
        // Update the location using the model
        $this->ubicacionModel->updateUbicacion($id, $nombreUbicacion, $fechaInicio, $fechaFin, $comentario);
    
        // Redirect back to the tree view
        header('Location: index.php?controller=ubicacion&action=verArbol');
        exit;
    }
    
    
    
    
}

?>