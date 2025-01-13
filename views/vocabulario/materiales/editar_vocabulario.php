<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Material</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=materiales&action=mostrarMateriales" class="edit-button">Tornar</a>

    <h1>Editar Material</h1>

    <div class="expo_box">
        <form action="index.php?controller=Materiales&action=actualizar" method="POST">
            <input type="hidden" name="codigo_getty_material" value="<?php echo htmlspecialchars($materiales['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="codigo_getty_material">Codi Getty Material:</label>
            <input type="text" id="codigo_getty_material" name="codigo_getty_material" value="<?php echo htmlspecialchars($materiales['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="texto_material">Nom:</label>
            <input type="text" id="texto_material" name="texto_material" value="<?php echo htmlspecialchars($materiales['texto_material'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>