<?php
class ObrasModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getObras() { 
        $query = "SELECT obras.*,materiales.texto_material,autores.nombre_autor, dataciones.nombre_datacion, archivos.enlace AS imagen_url
                  FROM obras 
                  JOIN materiales ON obras.material = materiales.codigo_getty_material
                  JOIN autores ON obras.autor = autores.codigo_autor
                  JOIN dataciones ON obras.datacion = dataciones.id_datacion
                  LEFT JOIN archivos ON obras.numero_registro = archivos.numero_registro";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarArchivo($numero_registro, $rutaDestino) {
        $query = "INSERT INTO archivos (numero_registro, enlace) VALUES (:numero_registro, :enlace)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero_registro', $numero_registro);
        $stmt->bindParam(':enlace', $rutaDestino);
        return $stmt->execute();
    }
    
    
    


        public function obtenerObra($id) {
        $query = "SELECT * FROM obras WHERE numero_registro = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Usa bindParam
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
            $stmt = $this->conn->query($sql); // Usa $this->conn en lugar de $this->db
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
            $sql = "SELECT DISTINCT texto_clasificacion, id_clasificacion FROM clasificaciones_genericas";
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
            $sql = "SELECT DISTINCT estado_conservacion FROM obras";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener dataciones
        public function getdatacion() {
            $sql = "SELECT DISTINCT id_datacion, nombre_datacion, ano_inicio, ano_final from dataciones";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener dataciones
        public function getexposicion() {
            $sql = "SELECT DISTINCT id_exposicion, tipo_exposicion, sitio_exposicion from exposiciones";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        

        
            public function crearObra(
                $numero_registro, $titulo, $codigo_autor, $classificacion_generica, 
                $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, 
                $materiales, $tecnica, $ano_inicio, $ano_final, /*$dataciones, */
                $ubicacion, $formas_ingreso, $fecha_registro, $descripcion, 
                $numero_ejemplares, $fuente_ingreso, $estado_conservacion, 
                $lugar_procedencia, $lugar_ejecucion, $valoracion_econ, 
                $bibliografia, $historia_obra,$fecha_ingreso,/*$exposicion*/

            ) {
                $query = "INSERT INTO obras (
                    numero_registro, titulo, classificacion_generica, autor, 
                    coleccion_procedencia, maxima_altura, maxima_anchura, 
                    maxima_profundidad, material, tecnica, ano_inicio, 
                    ano_final, ubicacion, fecha_registro, 
                    descripcion, numero_ejemplares, fecha_ingreso, fuente_ingreso,
                    forma_ingreso, estado_conservacion, lugar_ejecucion, 
                    lugar_procedencia, valoracion_econ, /*id_exposicion,*/ 
                    bibliografia, historia_obra
                ) VALUES (
                    :n_registro, :titulo, :classificacion_generica, :autor, 
                    :coleccion_procedencia, :maxima_altura, :maxima_anchura, 
                    :maxima_profundidad, :material, :tecnica, :ano_inicio, 
                    :ano_final, :ubicacion, :fecha_registro, 
                    :descripcion, :numero_ejemplares, :fecha_ingreso, :fuente_ingreso,
                    :forma_ingreso, :estado_conservacion, :lugar_ejecucion, 
                    :lugar_procedencia, :valoracion_econ,/* :exposicion, */ 
                    :bibliografia, :historia_obra
                )";
                
                $stmt = $this->conn->prepare($query);
                
                $stmt->bindParam(':n_registro', $numero_registro);
                $stmt->bindParam(':titulo', $titulo);
                $stmt->bindParam(':classificacion_generica', $clasificaciones_genericas);
                $stmt->bindParam(':autor', $codigo_autor); 
                $stmt->bindParam(':coleccion_procedencia', $coleccion_procedencia);
                $stmt->bindParam(':maxima_altura', $maxima_altura); 
                $stmt->bindParam(':maxima_anchura', $maxima_anchura);
                $stmt->bindParam(':maxima_profundidad', $maxima_profundidad);
                $stmt->bindParam(':material', $materiales);  
                $stmt->bindParam(':tecnica', $tecnica);
                $stmt->bindParam(':ano_inicio', $ano_inicio);
                $stmt->bindParam(':ano_final', $ano_final);
               // $stmt->bindParam(':datacion', $dataciones);
                $stmt->bindParam(':ubicacion', $ubicacion);
                $stmt->bindParam(':fecha_registro', $fecha_registro);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':numero_ejemplares', $numero_ejemplares);
                $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
                $stmt->bindParam(':fuente_ingreso', $fuente_ingreso);
                $stmt->bindParam(':forma_ingreso', $formas_ingreso);
                $stmt->bindParam(':estado_conservacion', $estado_conservacion);
                $stmt->bindParam(':lugar_ejecucion', $lugar_ejecucion);
                $stmt->bindParam(':lugar_procedencia', $lugar_procedencia);
                $stmt->bindParam(':valoracion_econ', $valoracion_econ);
               /* $stmt->bindParam(':exposicion', $exposicion);*/
                $stmt->bindParam(':bibliografia', $bibliografia);
                $stmt->bindParam(':historia_obra', $historia_obra);
                
                
                if ($stmt->execute()) {
                    // Si la inserción fue exitosa
                    return json_encode(['success' => true, 'message' => 'Obra creada correctamente.']);
                } else {
                    // Si hubo un error
                    return json_encode(['success' => false, 'message' => 'Error al crear la obra.', 'error' => $stmt->errorInfo()]);
                }
                
                
            }
            
            public function getObrasExpo($id_exposicion) {
                $query = "SELECT obras.*, materiales.texto_material, autores.nombre_autor, dataciones.nombre_datacion
                FROM obras 
                JOIN materiales ON obras.material = materiales.codigo_getty_material
                JOIN autores ON obras.autor = autores.codigo_autor
                JOIN dataciones ON obras.datacion = dataciones.id_datacion
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
