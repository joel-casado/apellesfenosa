<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ingres</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
</head>
<body>

<div class="container">
    <a href="index.php?controller=ingresos&action=mostrarIngresos" class="edit-button">Tornar</a>

    <h1>Crear Ingres</h1>

    <div class="expo_box">
        <form action="index.php?controller=ingresos&action=crearIngreso" method="POST">
            <label for="id_forma_ingreso">Codi Ingres:</label>
            <input type="text" id="id_forma_ingreso" name="id_forma_ingreso" required>

            <label for="texto_forma_ingreso">Nom:</label>
            <input type="text" id="texto_forma_ingreso" name="texto_forma_ingreso" required>

            <button type="submit">Afegir Ingres</button>
        </form>
    </div>
</div>

</body>
</html>
