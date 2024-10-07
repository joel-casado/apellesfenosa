<?php

class ObrasController {

    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    
    public function verObras() {
        // Crear una instancia de la clase de base de datos para obtener la conexión
        $db = (new Database())->conectar(); 

        // Crear instancia de ObrasModel y pasarle la conexión a la base de datos
        $obrasModel = new ObrasModel($db);

        // Obtener las obras desde el modelo
        $obras = $obrasModel->getObras();

        // Cargar la vista y pasarle los datos de las obras
        require_once "views/obras/obras.php";
    }

    public function editar($id) {
        return $this->obra->obtenerObra($id);
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_registro = $_POST['n_registro'];
            $titulo = $_POST['titulo'];
            $classificacion_generica = $_POST['classificacion_generica'];
            $autor = $_POST['nombre_autor'];
            $coleccion_procedencia = $_POST['coleccion_procedencia'];
            $maxima_altura = $_POST['maxima_altura'];
            $maxima_anchura = $_POST['maxima_anchura'];
            $maxima_profundidad = $_POST['maxima_profundidad'];
            $material = $_POST['id_material'];
            $tecnica = $_POST['tecnica'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];
            $datacion = $_POST['datacion'];
            $ubicacion = $_POST['ubicacion'];
            $fecha_registro = $_POST['fecha_registro'];
            $descripcion = $_POST['descripcion'];


            // Instanciar el modelo con la conexión
            $obraModel = new ObrasModel($this->conn);

            // actualizar la obra
            $resultado = $obraModel->actualizarObra($numero_registro, $titulo, $autor, $classificacion_generica, 
            $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, $id_material, $tecnica, 
            $ano_inicio, $ano_final, $datacion, $ubicacion, $fecha_registro, $descripcion);

            if ($resultado) {
                // Redirigir a la lista de obras después de la actualización
                header('Location: index.php?controller=Obras&action=verObras');
                exit();
            } else {
                echo "Error al actualizar la obra.";
            }
        }
    }
    
    

    
    

    public function mostrarFormulario($id) {
        // Obtener los valores únicos desde el modelo
        $obra = $this->obra->obtenerObra($id);
        $autores = $this->obra->getAutores(); 
        $anoInicio = $this->obra->getAnoInicio();
        $anoFinal = $this->obra->getAnoFinal();
        $materiales = $this->obra->getMateriales();
        $tecnicas = $this->obra->getTecnicas();
        $clasificacionesGenericas = $this->obra->getClasificacionesGenericas(); 
        $formasIngreso = $this->obra->getFormasIngreso();
        $estadosConservacion = $this->obra->getEstadosConservacion();
    
        require_once 'views/editar_obra/editar.php';
    }
}
?>
