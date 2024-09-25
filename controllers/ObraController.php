<?php
require_once '../models/database.php';
require_once '../models/obra.php';

class ObrasController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ObrasModel($pdo);
    }

    public function index() {
        $obras = $this->model->getObras();
        require '../views/general/main.php';
    }
}
?>
