<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_clasificacion
$clasificacionesModel = new clasificacionesModel($conn);
$clasificaciones = $clasificacionesModel->getclasificacionId($id);
 
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
    <a href="../../views/obras/obras.php">a</a>
    <h1>Editar Clasificación</h1>

    <div class="editar">
        <form action="index.php?controller=clasificaciones&action=actualizar" method="POST">

            <input type="hidden" name="id_clasificacion" value="<?php echo $clasificaciones['id_clasificacion']; ?>">
            
            

            <label for="id_clasificacion">Codigo:</label>
            <input type="text" id="id_clasificacion" name="id_clasificacion" value="<?php echo $clasificaciones['id_clasificacion']; ?>" required>
            
            <label for="texto_clasificacion">Nombre:</label>
            <input type="text" id="texto_clasificacion" name="texto_clasificacion" value="<?php echo $clasificaciones['texto_clasificacion']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>