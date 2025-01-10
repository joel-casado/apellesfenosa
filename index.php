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


try {
    $db = new Database();
    $connection = $db->conectar();

    // Aconsegueix i neteja el nom del controlador
    $controller = isset($_GET['controller']) 
        ? htmlspecialchars($_GET['controller'], ENT_QUOTES, 'UTF-8') 
        : 'Login';
    $controllerClass = ucfirst($controller) . "Controller";

    // Mira si la classe del controlador existeix
    if (class_exists($controllerClass)) {
        $controlador = new $controllerClass($connection);

        // Aconsegueix el nom de l'acció i el neteja
        $action = isset($_GET['action']) 
            ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8') 
            : 'verLogin';

        // Mira si l'acció existeix en el controlador
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            throw new Exception("L'acció '$action' no existeix en $controllerClass.");
        }
    } else {
        throw new Exception("El controlador '$controllerClass' no existeix");
    }
} catch (Exception $e) {
    // Mostra d'errors
    echo "<h1>Error</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    error_log($e->getMessage());
}
if ($_GET['action'] == 'exportarCsv') {
    $controller = new ObrasController();
    $controller->exportarCsv();
}
?>
</body>
</html>
