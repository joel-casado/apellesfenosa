<?php
// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de clasificaciones
$clasificacionesController = new clasificacionesController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear clasificaciones</title>
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear clasificaciones</h1>

    <form action="index.php?controller=clasificaciones&action=crearclasificaciones" method="POST">
        <label for="id_clasificacion">ID Clasificacion:</label>
        <input type="text" id="id_clasificacion" name="id_clasificacion" required>

        <label for="texto_clasificacion">Nombre:</label>
        <input type="text" id="texto_clasificacion" name="texto_clasificacion" required>

        <button type="submit">Agregar clasificaciones</button>
    </form>
</body>
</html>
