<?php
require_once "../../../models/database.php";
require_once "../../../models/DatacionesModel.php";
require_once "../../../controllers/DatacionesController.php";

// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de dataciones
$datacionesController = new DatacionesController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Dataciones</title>
    <link rel="stylesheet" href="../../../styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear Dataciones</h1>

    <form action="../../../index.php?controller=dataciones&action=creardataciones" method="POST">
        <label for="nombre_datacion">Nombre:</label>
        <input type="text" id="nombre_datacion" name="nombre_datacion" required>

        <label for="ano_inicio">Año Inicio:</label>
        <input type="text" id="ano_inicio" name="ano_inicio" required>

        <label for="ano_final">Año Final:</label>
        <input type="text" id="ano_final" name="ano_final" required>

        <button type="submit">Agregar datación</button>
    </form>

</body>
</html>
