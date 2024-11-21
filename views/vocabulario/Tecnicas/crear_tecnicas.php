<?php
// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de tecnicas
$tecnicaController = new tecnicasController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear tecnica</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear tecnica</h1>
    <div class="editar">
        <form action="index.php?controller=tecnicas&action=creartecnica" method="POST">
            <label for="codigo_getty_tecnica">Código Getty tecnica:</label>
            <input type="text" id="codigo_getty_tecnica" name="codigo_getty_tecnica" required>

            <label for="texto_tecnica">Nombre:</label>
            <input type="text" id="texto_tecnica" name="texto_tecnica" required>

            <button type="submit">Agregar tecnica</button>
        </form>
    </div>
</body>
</html>
