<?php

require_once "database.php";

class ObrasModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getObras() {
        $stmt = $this->db->prepare("SELECT * FROM obras");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
