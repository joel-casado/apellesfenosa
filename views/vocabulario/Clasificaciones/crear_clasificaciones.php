<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Classificació</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=clasificaciones&action=mostrarClasificaciones" class="edit-button">Tornar</a>

    <h1>Crear Classificació</h1>

    <div class="expo_box">
        <form action="index.php?controller=clasificaciones&action=crearClasificaciones" method="POST">
            <label for="id_clasificacion">ID Classificació:</label>
            <input type="text" id="id_clasificacion" name="id_clasificacion" required>

            <label for="texto_clasificacion">Nom:</label>
            <input type="text" id="texto_clasificacion" name="texto_clasificacion" required>

            <button type="submit">Afegir Classificació</button>
        </form>
    </div>
</div>

</body>
</html>
