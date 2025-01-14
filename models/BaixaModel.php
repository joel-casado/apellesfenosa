<?php

class BaixaModel {
    private $db;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function darDeBaja($baja, $causa_baja,$persona_autorizada,$data, $id) {
        $query = "UPDATE obras 
                SET baja = :baja, causa_baja = :causa_baja,  persona_aut_baja = :persona_aut_baja, fecha_baja = :fecha_baja
                WHERE numero_registro = :numero_registro";
        
        $stmt = $this->conn->prepare($query);
        
        // Vincula los parámetros correctamente
        $stmt->bindParam(':baja', $baja);
        $stmt->bindParam(':causa_baja', $causa_baja);
        $stmt->bindParam(':persona_aut_baja', $persona_autorizada);
        $stmt->bindParam(':fecha_baja', $data); 
        $stmt->bindParam(':numero_registro', $id);  // Asegúrate de vincular el ID correctamente
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            // Captura el error para depuración
            $errorInfo = $stmt->errorInfo();
            error_log("Error en la actualización: " . print_r($errorInfo, true));
            return false;
        }
    }

    public function darAlta($causa_baja, $persona_autorizada, $data, $id) {
        $query = "UPDATE obras 
                  SET baja = 1, causa_baja = :causa_baja, persona_aut_baja = :persona_aut_baja, fecha_baja = :fecha_baja
                  WHERE numero_registro = :numero_registro";
    
        $stmt = $this->conn->prepare($query);
    
        // Vincula los parámetros correctamente
        $stmt->bindValue(':causa_baja', $causa_baja);
        $stmt->bindValue(':persona_aut_baja', $persona_autorizada);
        $stmt->bindValue(':fecha_baja', $data);
        $stmt->bindValue(':numero_registro', $id);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            // Captura el error para depuración
            $errorInfo = $stmt->errorInfo();
            error_log("Error en la actualización: " . print_r($errorInfo, true));
            return false;
        }
    }
    
    

    
    
}