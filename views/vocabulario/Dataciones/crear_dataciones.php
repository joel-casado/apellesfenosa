<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Datación</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=dataciones&action=mostrarDataciones" class="edit-button">Tornar</a>

    <h1>Crear Datació</h1>

    <div class="expo_box">
        <form action="index.php?controller=dataciones&action=crearDataciones" method="POST">
            <label for="nombre_datacion">Nom:</label>
            <input type="text" id="nombre_datacion" name="nombre_datacion" required>

            <label for="ano_inicio">Any Inici:</label>
            <input type="text" id="ano_inicio" name="ano_inicio" required>

            <label for="ano_final">Any Final:</label>
            <input type="text" id="ano_final" name="ano_final" required>

            <button type="submit">Afegir Datació</button>
        </form>
    </div>
</div>

</body>
</html>
