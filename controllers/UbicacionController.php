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

        if (in_array($parent_id, $visited)) {
            return [];
        }

        $visited[] = $parent_id;

        foreach ($ubicaciones as $ubicacion) {
            if ($ubicacion['ubicacion_padre'] == $parent_id) {
                $children = $this->buildTree($ubicaciones, $ubicacion['id_ubicacion'], $visited);
                $node = [
                    'id' => $ubicacion['id_ubicacion'],
                    'text' => htmlspecialchars($ubicacion['nombre_ubicacion'], ENT_QUOTES, 'UTF-8'),
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
            $nombreUbicacion = htmlspecialchars($_POST['nombre_ubicacion'], ENT_QUOTES, 'UTF-8');
            $fechaInicio = $this->convertDateFormat($_POST['fecha_inicio_ubi'] ?? null);
            $fechaFin = $this->convertDateFormat($_POST['fecha_fin_ubi'] ?? null);
            $comentario = htmlspecialchars($_POST['comentario_ubicacion'], ENT_QUOTES, 'UTF-8');
            $ubicacionPadre = isset($_GET['padre_id']) ? filter_var($_GET['padre_id'], FILTER_VALIDATE_INT) : null;

            if (!$nombreUbicacion || !$fechaInicio) {
                die("Error: Nombre de la ubicación y fecha de inicio son obligatorios.");
            }

            $this->ubicacionModel->crearUbicacion($fechaInicio, $fechaFin, $comentario, $ubicacionPadre, $nombreUbicacion);

            header('Location: index.php?controller=ubicacion&action=verArbol');
            exit;
        }

        require_once "views/ubicaciones/crearUbicacion.php";
    }

    public function editarUbicacion() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id) {
            die("Error: ID de ubicación inválido.");
        }

        $ubicacion = $this->ubicacionModel->getUbicacionById($id);
        if (!$ubicacion) {
            die("Error: La ubicación no existe.");
        }

        require_once "views/ubicaciones/editarUbicacion.php";
    }

    public function updateUbicacion() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id) {
            die("Error: ID de ubicación inválido.");
        }

        $nombreUbicacion = htmlspecialchars($_POST['nombre_ubicacion'], ENT_QUOTES, 'UTF-8');
        $fechaInicio = $this->convertDateFormat($_POST['fecha_inicio_ubi'] ?? null);
        $fechaFin = $this->convertDateFormat($_POST['fecha_fin_ubi'] ?? null);
        $comentario = htmlspecialchars($_POST['comentario_ubicacion'], ENT_QUOTES, 'UTF-8');

        if (!$nombreUbicacion || !$fechaInicio) {
            die("Error: Nombre de la ubicación y fecha de inicio son obligatorios.");
        }

        $this->ubicacionModel->updateUbicacion($id, $nombreUbicacion, $fechaInicio, $fechaFin, $comentario);

        header('Location: index.php?controller=ubicacion&action=verArbol');
        exit;
    }

    public function eliminarUbicacion() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id) {
            die("Error: ID de ubicación inválido.");
        }

        $this->ubicacionModel->eliminarUbicacion($id);

        header('Location: index.php?controller=ubicacion&action=verArbol');
        exit;
    }

    public function listarObras() {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id) {
            die("Error: ID de ubicación inválido.");
        }

        $obrasModel = new ObrasModel($this->ubicacionModel->getConnection());
        $obras = $obrasModel->getObrasByUbicacion($id);

        require_once "views/ubicaciones/listarObras.php";
    }

    public function selectUbicacion() {
        $ubicaciones = $this->ubicacionModel->getUbicaciones();
        $ubicacionesData = $this->buildTree($ubicaciones);
        require_once "views/ubicaciones/selectUbicacion.php";
    }

    private function convertDateFormat($date) {
        if ($date) {
            $formattedDate = DateTime::createFromFormat('d/m/Y', $date);
            if ($formattedDate) {
                return $formattedDate->format('Y-m-d');
            } else {
                die("Error: Formato de fecha inválido. Use DD/MM/YYYY.");
            }
        }
        return null;
    }
}
