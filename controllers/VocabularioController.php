<?php

class VocabularioController {
    
    public function mostrarvocabulario() {
        $vocabularioModel = new VocabularioModel();
        $tablas = $vocabularioModel->getNombresTablas();

        // Depuración: imprimir el resultado
        echo "<pre>";
        print_r($tablas);
        echo "</pre>";
        
        // Pasamos los nombres de las tablas a la vista
        require_once 'views/vocabulario/ver_vocabulario.php';
    }
}

?>