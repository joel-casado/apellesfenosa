<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tècnica</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=tecnicas&action=mostrarTecnicas" class="edit-button">Tornar</a>

    <h1>Crear Tècnica</h1>

    <div class="expo_box">
        <form action="index.php?controller=tecnicas&action=crearTecnica" method="POST">
            <label for="codigo_getty_tecnica">Codi Getty Tècnica:</label>
            <input type="text" id="codigo_getty_tecnica" name="codigo_getty_tecnica" required>

            <label for="texto_tecnica">Nom:</label>
            <input type="text" id="texto_tecnica" name="texto_tecnica" required>

            <button type="submit">Afegir Tècnica</button>
        </form>
    </div>
</div>

</body>
</html>
