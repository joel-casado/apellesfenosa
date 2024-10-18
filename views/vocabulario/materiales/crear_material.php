<?php
// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de materiales
$materialController = new MaterialesController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Material</title>
    <link rel="stylesheet" href="../../styles/crear_material/crear.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear Material</h1>

    <form action="index.php?controller=Materiales&action=crearMaterial" method="POST">
        <label for="codigo_getty_material">Código Getty Material:</label>
        <input type="text" id="codigo_getty_material" name="codigo_getty_material" required>

        <label for="texto_material">Nombre:</label>
        <input type="text" id="texto_material" name="texto_material" required>

        <button type="submit">Agregar Material</button>
    </form>
</body>
</html>
