<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de materiales
$AutoresController = new AutoresController();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Autor</title>
    <link rel="stylesheet" href="../../styles/obras/obras.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear Autor</h1>

    <form action="index.php?controller=autores&action=crearAutores" method="POST">
        <label for="codigo_autor">Código Autor:</label>
        <input type="text" id="codigo_autor" name="codigo_autor" required>

        <label for="nombre_autor">Nombre:</label>
        <input type="text" id="nombre_autor" name="nombre_autor" required>

        <button type="submit">Agregar Autor</button>
    </form>
</body>
</html>

