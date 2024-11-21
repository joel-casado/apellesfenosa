<?php
// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de ingresos
$ingresoController = new ingresosController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear ingreso</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear ingreso</h1>
    <div class="editar">
        <form action="index.php?controller=ingresos&action=crearingreso" method="POST">
            <label for="id_forma_ingreso">Código Getty ingreso:</label>
            <input type="text" id="id_forma_ingreso" name="id_forma_ingreso" required>

            <label for="texto_forma_ingreso">Nombre:</label>
            <input type="text" id="texto_forma_ingreso" name="texto_forma_ingreso" required>

            <button type="submit">Agregar ingreso</button>
        </form>
    </div>
</body>
</html>
