<?php
// Conexión a la base de datos
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

// Instanciar el controlador de prestamos
$prestamosController = new prestamosController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear prestamos</title>
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear prestamos</h1>

    <form action="index.php?controller=prestamos&action=crearprestamos" method="POST">

                
        <label for="id_prestamo">ID:</label>
        <input type="text" id="id_prestamo" name="id_prestamo" value=">" required>
        
        <label for="numero_registro">Número Registro:</label>
        <input type="text" id="numero_registro" name="numero_registro" value="" required>

        <label for="fecha_prestacion">Inicio:</label>
        <input type="text" id="fecha_prestacion" name="fecha_prestacion" value="" required>

        <label for="fecha_devolucion">Fin:</label>
        <input type="text" id="fecha_devolucion" name="fecha_devolucion" value="" required>

        <button type="submit">Agregar prestamo</button>
    </form>

</body>
</html>
