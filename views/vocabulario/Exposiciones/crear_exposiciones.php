<?php
require_once "../../../models/database.php";
require_once "../../../models/exposicionesModel.php";
require_once "../../../controllers/exposicionesController.php";

// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de exposiciones
$exposicionesController = new exposicionesController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear exposiciones</title>
    <link rel="stylesheet" href="../../../styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear exposiciones</h1>

    <form action="../../../index.php?controller=exposiciones&action=crearexposiciones" method="POST">

        <label for="id_exposicion">Codigo:</label>
        <input type="text" id="id_exposicion" name="id_exposicion" value="" required>
        
        <label for="tipo_exposicion">Nombre:</label>
        <input type="text" id="tipo_exposicion" name="tipo_exposicion" value="" required>

        <label for="fecha_inicio_expo">Inicio:</label>
        <input type="text" id="fecha_inicio_expo" name="fecha_inicio_expo" value="" required>

        <label for="fecha_fin_expo">Fin:</label>
        <input type="text" id="fecha_fin_expo" name="fecha_fin_expo" value="" required>

        <label for="sitio_exposicion">Lugar:</label>
        <input type="text" id="sitio_exposicion" name="sitio_exposicion" value="" required>

        <button type="submit">Agregar Exposicion</button>
    </form>

</body>
</html>
