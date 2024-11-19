<?php
class ObrasModel {
    private $db;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getObras() { 
        $query = "SELECT obras.*,materiales.texto_material,autores.nombre_autor, tecnicas.texto_tecnica, archivos.enlace AS imagen_url
                FROM obras 
                LEFT JOIN materiales ON obras.material = materiales.codigo_getty_material
                LEFT JOIN autores ON obras.autor = autores.codigo_autor
                LEFT JOIN tecnicas ON obras.tecnica = tecnicas.codigo_getty_tecnica
                LEFT JOIN archivos ON obras.numero_registro = archivos.numero_registro";
                
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilteredObras($filters) {
        $baseQuery = "
            SELECT 
                obras.*, 
                clasificaciones_genericas.texto_clasificacion AS classificacion_generica_name,
                materiales.texto_material AS material_name, 
                tecnicas.texto_tecnica AS tecnica_name,
                autores.nombre_autor AS autor_name, 
                dataciones.nombre_datacion AS datacion_name, 
                ubicaciones.nombre_ubicacion AS ubicacion_name,
                formas_ingreso.texto_forma_ingreso AS forma_ingreso_name, 
                exposiciones.sitio_exposicion AS exposicion_name,
                estado_conservacion.nombre_estado AS estado_conservacion_name
            FROM obras
            LEFT JOIN clasificaciones_genericas ON obras.classificacion_generica = clasificaciones_genericas.id_clasificacion
            LEFT JOIN materiales ON obras.material = materiales.codigo_getty_material
            LEFT JOIN tecnicas ON obras.tecnica = tecnicas.codigo_getty_tecnica
            LEFT JOIN autores ON obras.autor = autores.codigo_autor
            LEFT JOIN dataciones ON obras.datacion = dataciones.id_datacion
            LEFT JOIN ubicaciones ON obras.ubicacion = ubicaciones.id_ubicacion
            LEFT JOIN formas_ingreso ON obras.forma_ingreso = formas_ingreso.id_forma_ingreso
            LEFT JOIN exposiciones ON obras.id_exposicion = exposiciones.id_exposicion
            LEFT JOIN estado_conservacion ON obras.estado_conservacion = estado_conservacion.id_estado
        ";
    
        $whereClauses = [];
        $params = [];
    
        foreach ($filters as $filter) {
            $field = $filter['field'];
            $value = $filter['value'];
    
            // Foreign key fields mapped to their descriptive names
            $foreignKeyFields = [
                'classificacion_generica' => 'clasificaciones_genericas.texto_clasificacion',
                'material' => 'materiales.texto_material',
                'tecnica' => 'tecnicas.texto_tecnica',
                'autor' => 'autores.nombre_autor',
                'datacion' => 'dataciones.nombre_datacion',
                'ubicacion' => 'ubicaciones.nombre_ubicacion',
                'forma_ingreso' => 'formas_ingreso.texto_forma_ingreso',
                'id_exposicion' => 'exposiciones.sitio_exposicion',
                'estado_conservacion' => 'estado_conservacion.nombre_estado'
            ];
    
            if (array_key_exists($field, $foreignKeyFields)) {
                $whereClauses[] = "{$foreignKeyFields[$field]} LIKE :$field";
                $params[":$field"] = "%$value%";
            } elseif (in_array($field, ['nombre_objeto', 'titulo', 'descripcion'])) { // Text fields
                $whereClauses[] = "$field LIKE :$field";
                $params[":$field"] = "%$value%";
            } elseif (in_array($field, ['valoracion_econ', 'maxima_altura', 'maxima_anchura'])) { // Numeric fields
                $ranges = explode('-', $value);
                if (count($ranges) === 2) {
                    $whereClauses[] = "$field BETWEEN :{$field}_min AND :{$field}_max";
                    $params[":{$field}_min"] = (float)$ranges[0];
                    $params[":{$field}_max"] = (float)$ranges[1];
                }
            } elseif ($field === 'fecha_registro') { // Date field
                $whereClauses[] = "DATE($field) = :$field";
                $params[":$field"] = date('Y-m-d', strtotime($value));
            }
        }
    
        if (!empty($whereClauses)) {
            $baseQuery .= " WHERE " . implode(' AND ', $whereClauses);
        }
    
        $stmt = $this->conn->prepare($baseQuery);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    
        public function obtenerObra($id) {
        $query = "SELECT * FROM obras WHERE numero_registro = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Usa bindParam
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodasLasObras() {
        $query = "SELECT obras.*, materiales.texto_material,autores.nombre_autor, exposiciones.exposicion, clasificaciones_genericas.texto_clasificacion, 
        dataciones.nombre_datacion, 
        formas_ingreso.texto_forma_ingreso, 
        tecnicas.texto_tecnica, estado_conservacion.nombre_estado,
        archivos.enlace AS imagen_url
        FROM obras
        LEFT JOIN clasificaciones_genericas 
            ON obras.classificacion_generica = clasificaciones_genericas.id_clasificacion
        LEFT JOIN dataciones 
            ON obras.datacion = dataciones.id_datacion
        LEFT JOIN exposiciones 
            ON obras.id_exposicion = exposiciones.id_exposicion
        LEFT JOIN materiales 
            ON obras.material = materiales.codigo_getty_material
        LEFT JOIN formas_ingreso 
            ON obras.forma_ingreso = formas_ingreso.id_forma_ingreso
        LEFT JOIN autores 
            ON obras.autor = autores.codigo_autor
        LEFT JOIN tecnicas 
            ON obras.tecnica = tecnicas.codigo_getty_tecnica
        LEFT JOIN estado_conservacion
            ON obras.estado_conservacion = estado_conservacion.id_estado
        LEFT JOIN archivos 
            ON obras.numero_registro = archivos.numero_registro;";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public function obtenerImagen($numeroRegistro) {
        $sql = "SELECT enlace FROM archivos WHERE numero_registro = :numero_registro LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':numero_registro', $numeroRegistro);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $archivo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $archivo['enlace'];
        } else {
            return null; // No se encontró ninguna imagen
        }
    }
    

        // Obtener todos los autores únicos
        public function getAutores() {
            $sql = "SELECT DISTINCT codigo_autor, nombre_autor FROM autores"; // Asegúrate de que 'codigo_autor' esté incluido en la consulta
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        

    
        // Obtener todos los años de inicio únicos
        public function getAnoInicio() {
            $sql = "SELECT DISTINCT ano_inicio FROM dataciones";
            $stmt = $this->conn->query($sql); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        

        // Obtener todos los años finales únicos
        public function getAnoFinal() {
            $sql = "SELECT DISTINCT ano_final FROM dataciones";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todos los materiales únicos
        public function getMateriales() {
            $sql = "SELECT DISTINCT texto_material, codigo_getty_material FROM materiales";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todas las técnicas únicas
        public function getTecnicas() {
            $sql = "SELECT DISTINCT texto_tecnica, codigo_getty_tecnica FROM tecnicas";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todas las clasificaciones genéricas únicas
        public function getClasificacionesGenericas() {
            $sql = "SELECT DISTINCT  id_clasificacion, texto_clasificacion FROM clasificaciones_genericas";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }        

        // Obtener todas las formas de ingreso únicas
        public function getFormasIngreso() {
            $sql = "SELECT DISTINCT id_forma_ingreso, texto_forma_ingreso FROM formas_ingreso";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todos los estados de conservación únicos
        public function getEstadosConservacion() {
            $sql = "SELECT DISTINCT id_estado, nombre_estado FROM estado_conservacion";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener dataciones
        public function getdatacion() {
            $sql = "SELECT DISTINCT id_datacion, nombre_datacion, ano_inicio, ano_final from dataciones";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener exposiciones
        public function getexposicion() {
            $sql = "SELECT DISTINCT id_exposicion, tipo_exposicion, sitio_exposicion from exposiciones";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function actualizarObra($numero_registro, $titulo, $autor, $clasificaciones_genericas, $coleccion_procedencia, 
                                   $maxima_altura, $maxima_anchura, $maxima_profundidad, $materiales, $tecnicas, 
                                   $ano_inicio, $ano_final, $dataciones, $formas_ingreso, $fecha_registro, 
                                   $descripcion, $numero_ejemplares, $fuente_ingreso, $estado_conservacion, 
                                   $lugar_procedencia, $lugar_ejecucion, $valoracion_econ, $bibliografia, 
                                   $historia_obra) {

        // Consulta SQL para actualizar la obra
        $sql = "UPDATE obras SET 
                    titulo = :titulo,
                    autor = :autor,
                    classificacion_generica = :clasificaciones_genericas,
                    coleccion_procedencia = :coleccion_procedencia,
                    maxima_altura = :maxima_altura,
                    maxima_anchura = :maxima_anchura,
                    maxima_profundidad = :maxima_profundidad,
                    material = :materiales,
                    tecnica = :tecnicas,
                    ano_inicio = :ano_inicio,
                    ano_final = :ano_final,
                    datacion = :dataciones,
                    forma_ingreso = :formas_ingreso,
                    fecha_registro = :fecha_registro,
                    descripcion = :descripcion,
                    numero_ejemplares = :numero_ejemplares,
                    fuente_ingreso = :fuente_ingreso,
                    estado_conservacion = :estado_conservacion,
                    lugar_procedencia = :lugar_procedencia,
                    lugar_ejecucion = :lugar_ejecucion,
                    valoracion_econ = :valoracion_econ,
                    bibliografia = :bibliografia,
                    historia_obra = :historia_obra
                WHERE numero_registro = :numero_registro";

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':clasificaciones_genericas', $clasificaciones_genericas);
        $stmt->bindParam(':coleccion_procedencia', $coleccion_procedencia);
        $stmt->bindParam(':maxima_altura', $maxima_altura);
        $stmt->bindParam(':maxima_anchura', $maxima_anchura);
        $stmt->bindParam(':maxima_profundidad', $maxima_profundidad);
        $stmt->bindParam(':materiales', $materiales);
        $stmt->bindParam(':tecnicas', $tecnicas);
        $stmt->bindParam(':ano_inicio', $ano_inicio);
        $stmt->bindParam(':ano_final', $ano_final);
        $stmt->bindParam(':dataciones', $dataciones);
        $stmt->bindParam(':formas_ingreso', $formas_ingreso);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':numero_ejemplares', $numero_ejemplares);
        $stmt->bindParam(':fuente_ingreso', $fuente_ingreso);
        $stmt->bindParam(':estado_conservacion', $estado_conservacion);
        $stmt->bindParam(':lugar_procedencia', $lugar_procedencia);
        $stmt->bindParam(':lugar_ejecucion', $lugar_ejecucion);
        $stmt->bindParam(':valoracion_econ', $valoracion_econ);
        $stmt->bindParam(':bibliografia', $bibliografia);
        $stmt->bindParam(':historia_obra', $historia_obra);
        $stmt->bindParam(':numero_registro', $numero_registro); // El número de registro para identificar la obra

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function guardarArchivo($numero_registro, $rutaArchivo) {
        $query = "INSERT INTO archivos (enlace, numero_registro) VALUES (:enlace, :numero_registro)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':enlace', $rutaArchivo);
        $stmt->bindParam(':numero_registro', $numero_registro);
    
        if ($stmt->execute()) {
            error_log("Archivo guardado en la base de datos correctamente");
            return true;
        } else {
            error_log("Error al guardar el archivo en la base de datos");
            return false;
        }
    }

    public function guardarArchivoSecundario($numero_registro, $rutaDestinoSecundario) {
        $query = "INSERT INTO archivos (enlace, numero_registro) VALUES (:enlace, :numero_registro)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':numero_registro', $numero_registro);
        $stmt->bindParam(':enlace', $rutaDestinoSecundario);
    
        if ($stmt->execute()) {
            error_log("Archivo secundario guardado en la base de datos correctamente");
            return true;
        } else {
            error_log("Error al guardar el archivo secundario en la base de datos");
            return false;
        }
    }

    public function crearObra(
        $numero_registro, $titulo, $nombre, $codigo_autor, $classificacion_generica, 
        $coleccion_procedencia, $maxima_altura, $maxima_anchura, 
        $maxima_profundidad, $materiales, $tecnica, 
        $ano_inicio, $ano_final, $dataciones, $formas_ingreso, $fecha_registro, 
        $descripcion, $numero_ejemplares, $fecha_ingreso, $fuente_ingreso, 
        $estado_conservacion, $lugar_ejecucion, $lugar_procedencia, 
        $valoracion_econ, $bibliografia, $historia_obra
    ) {
            $query = "INSERT INTO obras (
                numero_registro, titulo, nombre_objeto, classificacion_generica, autor, 
                coleccion_procedencia, maxima_altura, maxima_anchura, 
                maxima_profundidad, material, tecnica, ano_inicio, 
                ano_final, datacion, fecha_registro, descripcion, numero_ejemplares, 
                fecha_ingreso, fuente_ingreso,  estado_conservacion,  forma_ingreso,
                lugar_ejecucion, lugar_procedencia, valoracion_econ, 
                bibliografia, historia_obra
            ) VALUES (
                :n_registro, :titulo, :nombre, :classificacion_generica, :autor, 
                :coleccion_procedencia, :maxima_altura, :maxima_anchura, 
                :maxima_profundidad, :material, :tecnica,
                :ano_inicio, :ano_final, :datacion, :fecha_registro, :descripcion, 
                :numero_ejemplares, :fecha_ingreso, :fuente_ingreso, 
                :estado_conservacion,:forma_ingreso, :lugar_ejecucion, 
                :lugar_procedencia, :valoracion_econ, :bibliografia, 
                :historia_obra
            )";
        
            $stmt = $this->conn->prepare($query);
            
            // Vincula los parámetros correctamente
            $stmt->bindParam(':n_registro', $numero_registro);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':autor', $codigo_autor); 
            $stmt->bindParam(':classificacion_generica', $classificacion_generica);
            $stmt->bindParam(':coleccion_procedencia', $coleccion_procedencia);
            $stmt->bindParam(':maxima_altura', $maxima_altura); 
            $stmt->bindParam(':maxima_anchura', $maxima_anchura);
            $stmt->bindParam(':maxima_profundidad', $maxima_profundidad);
            $stmt->bindParam(':material', $materiales);  
            $stmt->bindParam(':tecnica', $tecnica);
            $stmt->bindParam(':ano_inicio', $ano_inicio);
            $stmt->bindParam(':ano_final', $ano_final);
            $stmt->bindParam(':datacion', $dataciones);
            $stmt->bindParam(':forma_ingreso', $formas_ingreso);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':numero_ejemplares', $numero_ejemplares);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            $stmt->bindParam(':fuente_ingreso', $fuente_ingreso);
            $stmt->bindParam(':estado_conservacion', $estado_conservacion);
            $stmt->bindParam(':lugar_ejecucion', $lugar_ejecucion);
            $stmt->bindParam(':lugar_procedencia', $lugar_procedencia);
            $stmt->bindParam(':valoracion_econ', $valoracion_econ);
            $stmt->bindParam(':bibliografia', $bibliografia);
            $stmt->bindParam(':historia_obra', $historia_obra);
    
            
            error_log("Ejecutando consulta de inserción en la base de datos");
            
            if ($stmt->execute()) {
                // Si la inserción fue exitosa
                error_log("Inserción exitosa en la base de datos");
                $idObra = $this->conn->lastInsertId();
                error_log("Obra creada correctamente con ID: " . $idObra);
                return json_encode(['success' => true, 'message' => 'Obra creada correctamente.']);

            } else {
                // Si hubo un 
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar la consulta de inserción: " . print_r($errorInfo, true));
                return json_encode(['success' => false, 'message' => 'Error al crear la obra.', 'error' => $stmt->errorInfo()]);
            }
            
            
        }
            
            public function getObrasExpo($id_exposicion) {
                $query = "SELECT obras.*, materiales.texto_material, autores.nombre_autor, dataciones.nombre_datacion
                FROM obras 
                LEFT JOIN  materiales ON obras.material = materiales.codigo_getty_material
                LEFT JOIN autores ON obras.autor = autores.codigo_autor
                LEFT JOIN dataciones ON obras.datacion = dataciones.id_datacion
                WHERE obras.id_exposicion = :id_exposicion"; // Asegúrate de que 'id_exposicion' sea un campo válido
            
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id_exposicion', $id_exposicion, PDO::PARAM_INT); // Asegúrate de que el tipo de dato sea correcto
            
                // Imprimir la consulta y el valor del parámetro para depuración
                
            
                if (!$stmt->execute()) {
                    // Si hay un error, muestra el error
                    print_r($stmt->errorInfo());
                }
            
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
        

}
