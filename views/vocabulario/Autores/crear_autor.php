<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Autor</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=autores&action=mostrarAutores" class="edit-button">Tornar</a>

    <h1>Crear Autor</h1>

    <div class="expo_box">
        <form action="index.php?controller=Autores&action=crearAutores" method="POST">
            <label for="codigo_autor">Codi Autor:</label>
            <input type="text" id="codigo_autor" name="codigo_autor" required>

            <label for="nombre_autor">Nom:</label>
            <input type="text" id="nombre_autor" name="nombre_autor" required>

            <button type="submit">Afegir Autor</button>
        </form>
    </div>
</div>

</body>
</html>
