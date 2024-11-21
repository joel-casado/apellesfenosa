<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_exposicion
$exposicionesModel = new exposicionesModel($conn);
$exposiciones = $exposicionesModel->getexposicionPorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Exposiciones</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="views/obras/obras.php">a</a>
    <h1>Editar Exposiciones</h1>
    <div class="editar">

        <form action="index.php?controller=exposiciones&action=actualizar" method="POST">

            <input type="hidden" name="id_exposicion" value="<?php echo $exposiciones['id_exposicion']; ?>">
            
            <label for="id_exposicion">Codigo:</label>
            <input type="text" id="id_exposicion" name="id_exposicion" value="<?php echo $exposiciones['id_exposicion']; ?>" required>
            
            <label for="tipo_exposicion">Nombre:</label>
            <input type="text" id="tipo_exposicion" name="tipo_exposicion" value="<?php echo $exposiciones['tipo_exposicion']; ?>" required>

            <label for="fecha_inicio_expo">Inicio:</label>
            <input type="text" id="fecha_inicio_expo" name="fecha_inicio_expo" value="<?php echo($exposiciones['fecha_inicio_expo']); ?>" required>

            <label for="fecha_fin_expo">Fin:</label>
            <input type="text" id="fecha_fin_expo" name="fecha_fin_expo" value="<?php echo($exposiciones['fecha_fin_expo']); ?>" required>

            <label for="sitio_exposicion">Lugar:</label>
            <input type="text" id="sitio_exposicion" name="sitio_exposicion" value="<?php echo($exposiciones['sitio_exposicion']); ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>