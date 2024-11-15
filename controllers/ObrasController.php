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
            $formas_ingreso = $_POST['forma_ingreso'];
            $fecha_registro = $_POST['fecha_registro'];
            $descripcion = $_POST['descripcion'];
            $numero_ejemplares = $_POST['numero_ejemplares'];
            $fuente_ingreso = $_POST['fuente_ingreso'];
            $estado_conservacion = $_POST['estado_conservacion']; // Asegúrate de que el nombre del campo es correcto.
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
            $ano_inicio, $ano_final, $dataciones, $formas_ingreso, $fecha_registro, $descripcion,$numero_ejemplares, $fuente_ingreso, $estado_conservacion,
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
    
    public function mostrarFicha() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
            $imagen_url = $obraModel->obtenerImagen($id);
    
            // Depuración: Verificar si la URL de la imagen se pasa correctamente a la vista
            echo "<script>console.log('URL de imagen en el controlador: " . $imagen_url . "');</script>";
    
            require_once 'views/ficha/ficha.php';
        } else {
            echo "ID no proporcionado.";
        }
    }

    public function mostrarFichaGeneral() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
            $imagen_url = $obraModel->obtenerImagen($id);
    
            // Depuración: Verificar si la URL de la imagen se pasa correctamente a la vista
            echo "<script>console.log('URL de imagen en el controlador: " . $imagen_url . "');</script>";
    
            require_once 'views/ficha/ficha_general.php';
        } else {
            echo "ID no proporcionado.";
        }
    }
    
    

    public function mostrarpdf() {
        // Capturar el ID de la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  
    
            // Obtener los valores desde el modelo utilizando el ID
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
    
            // Cargar la vista de edición con los datos de la obra
            require_once 'views/ficha/crear_pdf.php';
        } else {
            echo "ID no proporcionado.";
        }
    }

    public function mostrarpdfGeneral() {
        // Capturar el ID de la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  
    
            // Obtener los valores desde el modelo utilizando el ID
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
    
            // Cargar la vista de edición con los datose la obra
            require_once 'views/ficha/crear_pdf_general.php';
        } else {
            echo "ID no proporcionado.";
        }
    }

    public function mostrarPdfTodasLasObras() {
        $obraModel = new ObrasModel($this->conn);
        $obras = $obraModel->obtenerTodasLasObras();
    
        if (empty($obras)) {
            echo "No hay obras disponibles para generar el PDF.";
            return;
        }
        $query .= " LIMIT 100";

         // Cargar la vista de edición con los datose la obra
         require_once 'views/ficha/libro-registro.php';
    }


    //FUNCION CREAR CON TODOS LOS PARAMETROS//

    
    public function crear() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            header('Content-Type: application/json');
            ob_clean(); 

            $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : null;
            $numero_registro = isset($_POST['n_registro']) ? trim($_POST['n_registro']) : null;
            $codigo_autor = isset($_POST['codigo_autor']) ? trim($_POST['codigo_autor']) : null;
            $nombre = isset($_POST['nombre_objeto']) ? trim($_POST['nombre_objeto']) : null;
            $classificacion_generica = isset($_POST['classificacion_generica']) ? trim($_POST['classificacion_generica']) : null;
            $coleccion_procedencia = isset($_POST['coleccion_procedencia']) ? trim($_POST['coleccion_procedencia']) : null;
            $maxima_altura = isset($_POST['maxima_altura']) ? trim($_POST['maxima_altura']) : null;
            $maxima_anchura = isset($_POST['maxima_anchura']) ? trim($_POST['maxima_anchura']) : null;
            $maxima_profundidad = isset($_POST['maxima_profundidad']) ? trim($_POST['maxima_profundidad']) : null;
            $materiales = isset($_POST['codigo_getty_material']) ? trim($_POST['codigo_getty_material']) : null; 
            $tecnica = isset($_POST['tecnica']) ? trim($_POST['tecnica']) : null;
            $ano_inicio = isset($_POST['ano_inicio']) ? trim($_POST['ano_inicio']) : null;
            $ano_final = isset($_POST['ano_final']) ? trim($_POST['ano_final']) : null;
            $dataciones = isset($_POST['datacion']) ? trim($_POST['datacion']) : null;
            $formas_ingreso = isset($_POST['forma_ingreso']) ? trim($_POST['forma_ingreso']) : null;
            $fecha_registro = isset($_POST['fecha_registro']) ? trim($_POST['fecha_registro']) : null;
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
            $numero_ejemplares = isset($_POST['numero_ejemplares']) ? trim($_POST['numero_ejemplares']) : null;
            $fecha_ingreso = isset($_POST['fecha_ingreso']) ? trim($_POST['fecha_ingreso']) : null;
            $fuente_ingreso = isset($_POST['fuente_ingreso']) ? trim($_POST['fuente_ingreso']) : null;
            $estado_conservacion = isset($_POST['estado_conservacion']) ? trim($_POST['estado_conservacion']) : null;
            $lugar_ejecucion = isset($_POST['lugar_ejecucion']) ? trim($_POST['lugar_ejecucion']) : null;
            $lugar_procedencia = isset($_POST['lugar_procedencia']) ? trim($_POST['lugar_procedencia']) : null;
            $valoracion_econ = isset($_POST['valoracion_econ']) ? trim($_POST['valoracion_econ']) : null;
            $bibliografia = isset($_POST['bibliografia']) ? trim($_POST['bibliografia']) : null;
            $historia_obra = isset($_POST['historia_obra']) ? trim($_POST['historia_obra']) : null;

            // Validación de datos
            $errors = [];
            if (empty($titulo)) {
                $errors[] = 'El título es obligatorio';
            }
            if (empty($numero_registro)) {
                $errors[] = 'El Nº de registro es obligatorio';
            }
            if (empty($codigo_autor)) {
                $errors[] = 'El código del autor es obligatorio';
            }

            if (!empty($errors)) {
                exit();
            }
    


            $rutaArchivo = null; // Ruta del archivo guardado

            // Comprobar si se ha subido un archivo
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $foto = $_FILES['foto'];
                $nombreArchivo = basename($foto['name']);
                $rutaDestino = "images/" . $nombreArchivo;

                // Mover el archivo a la carpeta "images"
                if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
                    $rutaArchivo = $rutaDestino; // Guardar la ruta del archivo
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al subir la foto']);
                    exit();
                }
            }

        $obraModel = new ObrasModel($this->conn);
        $resultado = $obraModel->crearObra(
            $numero_registro, $titulo,  $nombre, $codigo_autor, $classificacion_generica, 
            $coleccion_procedencia, $maxima_altura, $maxima_anchura, 
            $maxima_profundidad, $materiales, $tecnica, 
            $ano_inicio, $ano_final, $dataciones,
            $formas_ingreso, $fecha_registro, $descripcion,
            $numero_ejemplares, $fecha_ingreso, $fuente_ingreso, 
            $estado_conservacion, $lugar_ejecucion, $lugar_procedencia, 
            $valoracion_econ, $bibliografia, $historia_obra
        );

      
        if ($resultado) {
            if ($rutaArchivo) {
                $archivoGuardado = $obraModel->guardarArchivo($numero_registro, $rutaArchivo);
                if (!$archivoGuardado) {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo en la base de datos']);
                    exit();
                }
            }
            echo json_encode(['success' => true, 'message' => 'Obra y archivo creados con éxito', 'redirect' => 'index.php?controller=Obras&action=verObras']);
        } elseif ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Obra creada con éxito, sin archivo', 'redirect' => 'index.php?controller=Obras&action=verObras']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear la obra']);
        }
        exit();
    } else {
        require_once 'views/crear_obra/crear.php';
    }
}

        
    


    public function mostrarFormulario() {
        // Capturar el ID de la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el 'id' desde la URL
    
            // Obtener los valores desde el modelo utilizando el ID
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
            $autores = $obraModel->getAutores();
            $anoInicio = $obraModel->getAnoInicio();
            $anoFinal = $obraModel->getAnoFinal();
            $materiales = $obraModel->getMateriales();
            $tecnicas = $obraModel->getTecnicas();
            $clasificacionesGenericas = $obraModel->getClasificacionesGenericas();
            $formasIngreso = $obraModel->getFormasIngreso();
            $estadosConservacion = $obraModel->getEstadosConservacion();
            $numero_ejemplares = isset($_POST['numero_ejemplares']) ? trim($_POST['numero_ejemplares']) : null;


    
            // Cargar la vista de edición con los datos de la obra
            require_once 'views/editar_obra/editar.php';
        } else {
            echo "ID no proporcionado.";
        }
    }
    
}
?>