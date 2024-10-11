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
            $clasificaciones_genericas = $_POST['classificacion_generica'];
            $autor = $_POST['codigo_autor'];
            $coleccion_procedencia = $_POST['coleccion_procedencia'];
            $maxima_altura = $_POST['maxima_altura'];
            $maxima_anchura = $_POST['maxima_anchura'];
            $maxima_profundidad = $_POST['maxima_profundidad'];
            $materiales = $_POST['codigo_getty_material'];
            $tecnicas = $_POST['tecnica'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];
            $dataciones = $_POST['datacion'];
            $ubicacion = $_POST['ubicacion'];
            $formas_ingreso = $_POST['forma_ingreso'];
            $fecha_registro = $_POST['fecha_registro'];
            $descripcion = $_POST['descripcion'];
            $numero_ejemplares = $_POST['numero_ejemplares'];
            $fuente_ingreso = $_POST['fuente_ingreso'];
            $estado_conservacion = $_POST['estado']; // Asegúrate de que el nombre del campo es correcto.
            $lugar_procedencia = $_POST['lugar_procedencia'];
            $lugar_ejecucion = $_POST['lugar_ejecucion'];
            $valoracion_econ = $_POST['valoracion_econ'];
            $bibliografia = $_POST['bibliografia'];
            $historia_obra = $_POST['historia_obra'];

            // Instanciar el modelo con la conexión
            $obraModel = new ObrasModel($this->conn);

            // actualizar la obra
            $resultado = $obraModel->actualizarObra($numero_registro, $titulo, $autor, $clasificaciones_genericas, 
            $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, $materiales, $tecnicas, 
            $ano_inicio, $ano_final, $dataciones, $ubicacion, $formas_ingreso, $fecha_registro, $descripcion,$numero_ejemplares, $fuente_ingreso, $estado_conservacion,
            $lugar_procedencia, $lugar_ejecucion, $valoracion_econ, $bibliografia, $historia_obra );

            if ($resultado) {
                // Redirigir a la lista de obras después de la actualización
                header('Location: index.php?controller=Obras&action=verObras');
                exit();
            } else {
                echo "Error al actualizar la obra.";
            }
        }
    }
    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_registro = $_POST['n_registro'];
            $titulo = $_POST['titulo'];
            $clasificaciones_genericas = $_POST['classificacion_generica'];
            $autor = $_POST['codigo_autor'];
            $coleccion_procedencia = $_POST['coleccion_procedencia'];
            $maxima_altura = $_POST['maxima_altura'];
            $maxima_anchura = $_POST['maxima_anchura'];
            $maxima_profundidad = $_POST['maxima_profundidad'];
            $materiales = $_POST['codigo_getty_material'];
            $tecnicas = $_POST['tecnica'];
            $ano_inicio = $_POST['ano_inicio'];
            $ano_final = $_POST['ano_final'];
            $dataciones = $_POST['datacion'];
            $ubicacion = $_POST['ubicacion'];
            $formas_ingreso = $_POST['forma_ingreso'];
            $fecha_registro = $_POST['fecha_registro'];
            $descripcion = $_POST['descripcion'];
            $numero_ejemplares = $_POST['numero_ejemplares'];
            $fuente_ingreso = $_POST['fuente_ingreso'];
            $estado_conservacion = $_POST['estado']; 
            $lugar_procedencia = $_POST['lugar_procedencia'];
            $lugar_ejecucion = $_POST['lugar_ejecucion'];
            $valoracion_econ = $_POST['valoracion_econ'];
            $bibliografia = $_POST['bibliografia'];
            $historia_obra = $_POST['historia_obra'];
            
            // Validar que los campos requeridos no estén vacíos
            if (empty($numero_registro) || empty($titulo) || empty($fecha_registro) || empty($descripcion)) {
                echo "Por favor, complete todos los campos requeridos.";
                return;
            }
    
            // Instanciar el modelo con la conexión
            $obraModel = new ObrasModel($this->conn);
    
            // Crear la obra
            $resultado = $obraModel->crearObra($numero_registro, $titulo, $autor, $clasificaciones_genericas, 
            $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, $materiales, $tecnicas, 
            $ano_inicio, $ano_final, $dataciones, $ubicacion, $formas_ingreso, $fecha_registro, $descripcion,$numero_ejemplares, $fuente_ingreso, $estado_conservacion,
            $lugar_procedencia, $lugar_ejecucion, $valoracion_econ, $bibliografia, $historia_obra );
    
            if ($resultado) {
                // Redirigir a la lista de obras después de la creación
                header('Location: index.php?controller=Obras&action=verObras');
                exit();
            } else {
                echo "Error al crear la obra.";
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
