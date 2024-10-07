<?php

class ObrasModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getObras() {
        $stmt = $this->conn->prepare("SELECT * FROM obras");
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

    

        // Obtener todos los autores únicos
        public function getAutores() {
            $sql = "SELECT DISTINCT nombre_autor FROM autores";
            $result = $this->conn->query($sql);  // La consulta se ejecuta correctamente
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
            $sql = "SELECT DISTINCT texto_material FROM materiales";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todas las técnicas únicas
        public function getTecnicas() {
            $sql = "SELECT DISTINCT texto_tecnica FROM tecnicas";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todas las clasificaciones genéricas únicas
        public function getClasificacionesGenericas() {
            $sql = "SELECT DISTINCT texto_clasificacion FROM clasificaciones_genericas";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }        

        // Obtener todas las formas de ingreso únicas
        public function getFormasIngreso() {
            $sql = "SELECT DISTINCT texto_forma_ingreso FROM formas_ingreso";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener todos los estados de conservación únicos
        public function getEstadosConservacion() {
            $sql = "SELECT DISTINCT estado_conservacion FROM obras";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function actualizarObra($numero_registro, $titulo, $autor, $classificacion_generica, 
        $coleccion_procedencia, $maxima_altura, $maxima_anchura, $maxima_profundidad, $id_material, $tecnica, 
        $ano_inicio, $ano_final, $datacion, $ubicacion, $fecha_registro, $descripcion) {

            $query = "UPDATE obras SET titulo = :titulo, classificacion_generica = :classificacion_generica, autor = :autor, coleccion_procedencia = :coleccion_procedencia, maxima_altura = :maxima_altura, maxima_anchura = :maxima_anchura, maxima_profundidad = :maxima_profundidad, material = :material, tecnica = :tecnica, ano_inicio = :ano_inicio, ano_final = :ano_final, datacion = :datacion, ubicacion = :ubicacion, fecha_registro = :fecha_registro, descripcion = :descripcion WHERE numero_registro = :numero_registro";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':classificacion_generica', $classificacion_generica);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':coleccion_procedencia', $coleccion_procedencia);
            $stmt->bindParam(':maxima_altura', $maxima_altura); 
            $stmt->bindParam(':maxima_anchura', $maxima_anchura);
            $stmt->bindParam(':maxima_profundidad', $maxima_profundidad);
            $stmt->bindParam(':material', $material);
            $stmt->bindParam(':tecnica', $tecnica);
            $stmt->bindParam(':ano_inicio', $ano_inicio);
            $stmt->bindParam(':ano_final', $ano_final);
            $stmt->bindParam(':datacion', $datacion);
            $stmt->bindParam(':ubicacion', $ubicacion);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
            $stmt->bindParam(':numero_registro', $numero_registro);
            $stmt->bindParam(':descripcion', $descripcion);
            
            return $stmt->execute();
        }
        

        

}
?>
