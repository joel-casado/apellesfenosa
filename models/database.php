<?php

class Database {
    // Declare the $db property
    private $db;

    public function conectar() {
        $servername = "localhost";
        $dbname = "apellesfenosa";
        $username = "root";
        $password = "";

        // Create a new PDO connection
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set PDO error mode to exception for better error handling
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $this->db;
    }
}


?>