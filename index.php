<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

require_once "autoload.php";
require_once "models/database.php";

$db = new Database();
$connection = $db->conectar();

if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'] . "Controller";
} else {
    $nombreController = "LoginController";
}

if (class_exists($nombreController)) {
    // Pass the database connection to the controller
    $controlador = new $nombreController($connection);

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = "verLogin";
    }
    
    // Check if the action exists in the controller before calling it
    if (method_exists($controlador, $action)) {
        $controlador->$action();
    } else {
        echo "No existe la acción";
    }
} else {
    echo "No existe el controlador";
}
?>
</body>
</html>
