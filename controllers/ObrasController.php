<?php
session_start();
class ObrasController {

    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function filter() {
        $filters = [];
    
        for ($i = 1; $i <= 5; $i++) {
            $field = $_POST["filterField$i"] ?? null;
            $value = $_POST["filterValue$i"] ?? null;
    
            if (!empty($field) && !empty($value)) {
                $filters[] = ['field' => $field, 'value' => $value];    
            }
        }
    
        $obrasModel = new ObrasModel($this->conn);
        $obras = $obrasModel->getFilteredObras($filters);
    
        require_once "views/obras/obras.php";
    }
    
    public function verObras() {
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        $db = (new Database())->conectar(); 

        $obrasModel = new ObrasModel($db);

        $obras = $obrasModel->getObras();

        require_once "views/obras/obras.php";
    }

    public function actualizar() {
        $rutaArchivo = null;
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
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
                $estado_conservacion = $_POST['estado_conservacion'];
                $lugar_procedencia = $_POST['lugar_procedencia'];
                $lugar_ejecucion = $_POST['lugar_ejecucion'];
                $valoracion_econ = $_POST['valoracion_econ'];
                $bibliografia = $_POST['bibliografia'];
                $historia_obra = $_POST['historia_obra'];
                $ubicacion = $_POST['ubicacion'];
    
                // Instanciar el modelo con la conexión
                $obraModel = new ObrasModel($this->conn);
    
                // Actualizar la obra
                $resultado = $obraModel->actualizarObra($numero_registro, $titulo, $autor, $clasificaciones_genericas, 
                    $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, $materiales, $tecnicas, 
                    $ano_inicio, $ano_final, $dataciones, $formas_ingreso, $fecha_registro, $descripcion,
                    $numero_ejemplares, $fuente_ingreso, $estado_conservacion, $lugar_procedencia, $lugar_ejecucion, $valoracion_econ, $bibliografia, $historia_obra, $ubicacion);
                
                // Manejar la subida de la foto
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
                
                if ($resultado) {
                    if ($rutaArchivo) {
                        // Actualizar el archivo
                        $imagenExistente = $obraModel->obtenerImagen($numero_registro);
                        if ($imagenExistente) {
                            $archivoActualizado = $obraModel->actualizarArchivo($numero_registro, $rutaArchivo);
                            if (!$archivoActualizado) {
                                echo json_encode(['success' => false, 'message' => 'Error al actualizar el archivo en la base de datos']);
                                exit();
                            }
                        } else {
                            $archivoGuardado = $obraModel->guardarArchivo($numero_registro, $rutaArchivo);
                            if (!$archivoGuardado) {
                                echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo en la base de datos']);
                                exit();
                            }
                        }
                    } else {
                        // No se ha subido un archivo, omitir la actualización del archivo
                        // Continuar con el resto del proceso de actualización
                    }
                
                    // Crear carpeta para archivos secundarios
                    $carpetaObra = "archivos/obra_" . $numero_registro;
                    if (!is_dir($carpetaObra)) {
                        mkdir($carpetaObra, 0777, true);
                    }
                
                    // Guardar archivos secundarios
                    if (!empty($_FILES['archivos_extra']['name'][0])) {
                        foreach ($_FILES['archivos_extra']['tmp_name'] as $key => $tmpName) {
                            $nombreArchivoSecundario = basename($_FILES['archivos_extra']['name'][$key]);
                            $rutaDestinoSecundario = $carpetaObra . "/" . $nombreArchivoSecundario;
                
                            if (move_uploaded_file($tmpName, $rutaDestinoSecundario)) {
                                $obraModel->guardarArchivoSecundario($numero_registro, $rutaDestinoSecundario);
                            } else {
                                echo json_encode(['success' => false, 'message' => 'Error al subir archivo secundario: ' . $nombreArchivoSecundario]);
                                exit();
                            }
                        }
                    }
                
                    // Redirigir a la página de obras
                    header('Location: index.php?controller=Obras&action=verObras');
                    exit();
                } else {
                    echo "Error al actualizar la obra. 2";
                }
            } catch (Exception $e) {
                error_log("Error en el controlador: " . $e->getMessage());
                echo "Error en el controlador: " . $e->getMessage();
            }
        }
    }
    
    
    public function mostrarFicha() {
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
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
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
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
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
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
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
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
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        $obraModel = new ObrasModel($this->conn);
        $obras = $obraModel->obtenerTodasLasObras();
    
        if (empty($obras)) {
            echo "No hay obras disponibles para generar el PDF.";
            return;
        }

         // Cargar la vista de edición con los datose la obra
         require_once 'views/ficha/libro-registro.php';
    }



    public function crear() {
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;

        if (isset($_SESSION['username'])) {
            $usuari_creador = $_SESSION['username'];
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            ob_clean();
            
            error_log("Datos POST recibidos en el controlador crear: " . print_r($_POST, true));

            $letra = isset($_POST['letra']) ? trim($_POST['letra']) : null;
            $numero_registro = isset($_POST['n_registro']) ? trim($_POST['n_registro']) : null;
            $decimales = isset($_POST['decimales']) ? trim($_POST['decimales']) : null;
            $usuari_creador = isset($_POST['usuario']) ? trim($_POST['usuario']) : null;
            $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : null;
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
            $ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : null;
    
                        
            $obraModel = new ObrasModel($this->conn);
            if ($obraModel->consultarNumeroRegistro($numero_registro)) {
                echo json_encode(['success' => false, 'message' => 'El número de registro ya existe.']);
                exit();
            }
            // Validación de datos
            $errors = [];
            if (empty($titulo)) {
                $errors[] = 'El título es obligatorio';
            }
            if (empty($numero_registro)) {
                $errors[] = 'El Nº de registro es obligatorio';
            }
            // Log de errores de validación
            error_log("Errores de validación: " . print_r($errors, true));
    
            if (!empty($errors)) {
                echo json_encode(['success' => false, 'message' => 'Errores en los campos', 'errors' => $errors]);
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
    
            // Log de la ejecución del modelo de creación de obra
            
            error_log("Llamando a crearObra() con los siguientes parámetros: " . print_r($_POST, true));
    
            $resultado = $obraModel->crearObra(
                $letra, $numero_registro, $decimales, $titulo,  $nombre, $codigo_autor, $classificacion_generica,
                $coleccion_procedencia, $maxima_altura, $maxima_anchura,
                $maxima_profundidad, $materiales, $tecnica,
                $ano_inicio, $ano_final, $dataciones,
                $formas_ingreso, $fecha_registro, $descripcion,
                $numero_ejemplares, $fecha_ingreso, $fuente_ingreso,
                $estado_conservacion, $lugar_ejecucion, $lugar_procedencia,
                $valoracion_econ, $bibliografia, $historia_obra, $usuari_creador, $ubicacion
            );
    
            // Log del resultado de crearObra
            if ($resultado) {
                if ($rutaArchivo) {
                    $archivoGuardado = $obraModel->guardarArchivo($numero_registro, $rutaArchivo);
                    if (!$archivoGuardado) {
                        echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo en la base de datos']);
                        exit();
                    }
                }
                
                if ($resultado) {
                       
                    
                    // Crear carpeta para archivos secundarios
                    $carpetaObra = "archivos/obra_" . $numero_registro;
                    if (!is_dir($carpetaObra)) {
                        mkdir($carpetaObra, 0777, true);
                    }

                    // Guardar archivos secundarios
                    if (!empty($_FILES['archivos_extra']['name'][0])) {
                        foreach ($_FILES['archivos_extra']['tmp_name'] as $key => $tmpName) {
                            $nombreArchivoSecundario = basename($_FILES['archivos_extra']['name'][$key]);
                            $rutaDestinoSecundario = $carpetaObra . "/" . $nombreArchivoSecundario;

                            if (move_uploaded_file($tmpName, $rutaDestinoSecundario)) {
                                $obraModel->guardarArchivoSecundario($numero_registro, $rutaDestinoSecundario);
                            } else {
                                echo json_encode(['success' => false, 'message' => 'Error al subir archivo secundario: ' . $nombreArchivoSecundario]);
                                exit();
                            }
                        }
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

        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        // Capturar el ID de la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el 'id' desde la URL
            error_log("ID recibido: " . $id);

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
    public function editar() {
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $obraModel = new ObrasModel($this->conn);
            $obra = $obraModel->obtenerObra($id);
            $autores = $obraModel->getAutores();
            $clasificaciones_genericas = $obraModel->getClasificacionesGenericas();
            $materiales = $obraModel->getMateriales();
            $tecnicas = $obraModel->getTecnicas();
            $anoInicio = $obraModel->getAnoInicio();
            $anoFinal = $obraModel->getAnoFinal();
            $formasIngreso = $obraModel->getFormasIngreso();
            $estadosConservacion = $obraModel->getEstadosConservacion();
            $dataciones = $obraModel->getdatacion();

            require_once 'views/editar_obra/editar.php';
        } else {
            echo "ID no proporcionado.";
        }
    }
    public function generarPdf() {
        $rol = $_SESSION['admin'] ?? $_SESSION['tecnic'] ?? $_SESSION['convidat'] ?? null;
        require_once("vendor/autoload.php");
        if (ob_get_length()) {
            ob_clean();
        }
        // Decodificar las obras visibles enviadas desde la vista
        $filteredData = json_decode($_POST['filteredData'], true);

        if (empty($filteredData)) {
            echo "No hay datos para generar el PDF.";
            return;
        }
    
        // Configuración básica del PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Museu Apel·les Fenosa');
        $pdf->SetTitle('Obras');
        $pdf->SetHeaderData('', 0, 'Obras', '');
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Crear el contenido del PDF
        $html = '<h1>Obras Disponibles</h1>
                 <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Imatge</th>
                            <th>Nom Objecte</th>
                            <th>Títol</th>
                            <th>Autor</th>
                            <th>Técnica</th>
                            <th>Ubicació</th>
                            <th>Material</th>
                            <th>Tècnica</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($filteredData as $obra) {
            $html .= '<tr>
                        <td><img src="' . htmlspecialchars($obra['imagen_url']) . '" alt="Imagen"></td>
                        <td>' . htmlspecialchars($obra['numero_registro']) . '</td>
                        <td>' . htmlspecialchars($obra['titulo']) . '</td>
                        <td>' . htmlspecialchars($obra['nombre_autor']) . '</td>
                        <td>' . htmlspecialchars($obra['texto_tecnica']) . '</td>
                        <td>' . htmlspecialchars($obra['ubicacion']) . '</td>
                        <td>' . htmlspecialchars($obra['texto_material']) . '</td>
                        <td>' . htmlspecialchars($obra['texto_tecnica']) . '</td>
                      </tr>';
        }
        $html .= '</tbody></table>';
    
        // Añadir contenido al PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('obras.pdf', 'I');
        exit;
    }
    public function exportarCsv()
{
    // Crear la conexión a la base de datos
    $db = new PDO('mysql:host=localhost;dbname=apellesfenosa;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Importar el modelo y pasar la conexión
    require_once 'models/ObrasModel.php';
    $obraModel = new ObrasModel($db);

    // Obtener las obras desde el modelo
    $obras = $obraModel->getAll();

    // Nombre del archivo CSV
    $filename = "obras_" . date('Ymd_His') . ".csv";

    // Configurar headers para la descarga
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    // Abrir el archivo de salida
    $output = fopen('php://output', 'w');

    // Escribir el encabezado (columnas)
    if (!empty($obras)) {
        fputcsv($output, array_keys($obras[0]));
    }

    // Escribir los datos
    foreach ($obras as $obra) {
        fputcsv($output, $obra);
    }

    // Cerrar el archivo
    fclose($output);
    exit;
}

    
}
?>