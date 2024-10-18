<?php
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
    <title>Crear Datación</title>
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
</head>
<body>
    <h1>Crear Datación</h1>

    <form action="index.php?controller=dataciones&action=crearDataciones" method="POST">
        <label for="nombre_datacion">Nombre:</label>
        <input type="text" id="nombre_datacion" name="nombre_datacion" required>

        <label for="ano_inicio">Año Inicio:</label>
        <input type="text" id="ano_inicio" name="ano_inicio" required>

        <label for="ano_final">Año Final:</label>
        <input type="text" id="ano_final" name="ano_final" required>

        <button type="submit">Agregar Datación</button>
    </form>
</body>
</html>

