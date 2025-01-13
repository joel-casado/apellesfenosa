<?php

class VocabularioModel {
    private $db;
    private $conn;

    private function conectar() {
        $this->conn = new mysqli('localhost', 'username', 'password', 'apellesfenosa');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function __construct() {
        $this->db = $this->conectar();
    }

    public function getNombresTablas() {
        $query = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'apellesfenosa'");

        if ($query) {
            // Depuración: imprimir los resultados obtenidos
            echo "<pre>";
            print_r($query->fetch_all(MYSQLI_ASSOC));
            echo "</pre>";
            
            return $query->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Error en la consulta";
            return [];
        }
    }
}



?>