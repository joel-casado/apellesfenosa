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

    public function obtenerDatosArbol() {

        $ubicaciones = $this->ubicacionModel->getUbicaciones();
        echo json_encode($this->buildTree($ubicaciones));
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
}

?>
