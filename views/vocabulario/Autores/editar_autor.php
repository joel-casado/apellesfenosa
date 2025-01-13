<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_autor
$AutoresModel = new AutoresModel($conn);
$autores = $AutoresModel->getAutorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=autores&action=mostrarautores" class="edit-button">Tornar</a>

    <h1>Editar Autor</h1>

    <div class="expo_box">
        <form action="index.php?controller=Autores&action=actualizar" method="POST">
            <input type="hidden" name="codigo_autor" value="<?php echo htmlspecialchars($autores['codigo_autor'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="codigo_autor">Codi:</label>
            <input type="text" id="codigo_autor" name="codigo_autor" value="<?php echo htmlspecialchars($autores['codigo_autor'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="nombre_autor">Nom:</label>
            <input type="text" id="nombre_autor" name="nombre_autor" value="<?php echo htmlspecialchars($autores['nombre_autor'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>