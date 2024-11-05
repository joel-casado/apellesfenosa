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
require_once "models/database.php"; // Include your database class
ini_set('memory_limit', '1024M');
// Create the database connection using the conectar() method
$db = new Database();
$connection = $db->conectar(); // Call the conectar method

if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'] . "Controller";
} else {
    // Default controller
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
