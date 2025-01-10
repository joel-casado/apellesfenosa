<?php

class VocabularioController {
    
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarVocabulario() {
        require_once "views/vocabulario/ver_vocabulario.php";
    }
}

?>