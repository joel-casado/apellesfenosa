<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Material</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=materiales&action=mostrarMateriales" class="edit-button">Tornar</a>

    <h1>Crear Material</h1>

    <div class="expo_box">
        <form action="index.php?controller=Materiales&action=crearMaterial" method="POST">
            <label for="codigo_getty_material">Codi Getty Material:</label>
            <input type="text" id="codigo_getty_material" name="codigo_getty_material" required>
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="texto_material">Nom:</label>
            <input type="text" id="texto_material" name="texto_material" required>

            <button type="submit">Afegir Material</button>
        </form>
    </div>
</div>

</body>
</html>
