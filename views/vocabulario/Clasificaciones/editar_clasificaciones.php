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
    <title>Editar Classificació</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=clasificaciones&action=mostrarclasificaciones" class="edit-button">Tornar</a>

    <h1>Editar Clasificación</h1>

    <div class="expo_box">
        <form action="index.php?controller=clasificaciones&action=actualizar" method="POST">
            <input type="hidden" name="id_clasificacion" value="<?php echo htmlspecialchars($clasificaciones['id_clasificacion'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="id_clasificacion">Codi:</label>
            <input type="text" id="id_clasificacion" name="id_clasificacion" value="<?php echo htmlspecialchars($clasificaciones['id_clasificacion'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="texto_clasificacion">Nom:</label>
            <input type="text" id="texto_clasificacion" name="texto_clasificacion" value="<?php echo htmlspecialchars($clasificaciones['texto_clasificacion'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>