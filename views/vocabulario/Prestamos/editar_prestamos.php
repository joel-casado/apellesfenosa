<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_prestamo
$prestamosModel = new prestamosModel($conn);
$prestamos = $prestamosModel->getprestamoPorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="views/obras/obras.php">a</a>
    <h1>Editar Clasificación</h1>

    <div class="editar">
        <form action="index.php?controller=prestamos&action=actualizar" method="POST">

            <input type="hidden" name="id_prestamo" value="<?php echo $prestamos['id_prestamo']; ?>">
            
            <label for="id_prestamo">ID:</label>
            <input type="text" id="id_prestamo" name="id_prestamo" value="<?php echo $prestamos['id_prestamo']; ?>" required>
            
            <label for="numero_registro">Número Registro:</label>
            <input type="text" id="numero_registro" name="numero_registro" value="<?php echo $prestamos['numero_registro']; ?>" required>

            <label for="fecha_prestacion">Inicio:</label>
            <input type="text" id="fecha_prestacion" name="fecha_prestacion" value="<?php echo($prestamos['fecha_prestacion']); ?>" required>

            <label for="fecha_devolucion">Fin:</label>
            <input type="text" id="fecha_devolucion" name="fecha_devolucion" value="<?php echo($prestamos['fecha_devolucion']); ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>