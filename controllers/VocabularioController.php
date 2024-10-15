<?php

class VocabularioController {
    
    public function mostrarObras() {
        $vocabularioModel = new VocabularioModel();
        $tablas = $vocabularioModel->getNombresTablas();

        // Depuración: imprimir el resultado
        echo "<pre>";
        print_r($tablas);
        echo "</pre>";
        
        // Pasamos los nombres de las tablas a la vista
        require_once 'views/obras/ver_vocabulario.php';
    }
}



    ?>