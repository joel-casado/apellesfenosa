<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear exposició</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/exposiciones/crear_expo.css">
</head>
<body>
    <div class="container">
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Tornar</a>
        <h1>Creació d'exposició</h1>
        <div class="expo_box">
            <form action="index.php?controller=Exposiciones&action=crea_expo" method="POST" onsubmit="return validarFormulario()">
                <label for="exposicion">Exposició</label>
                <input type="text" name="exposicion" id="exposicion" required>
                <label for="inicio">Data inici expo.</label>
                <input type="date" id="inicio" name="inicio" required>
                <label for="fin">Data fi expo.</label>
                <input type="date" id="fin" name="fin" required>
                <label for="tipo">Tipus exposició</label>
                <input type="text" id="tipo" name="tipo" required>
                <label for="lugar">Lloc exposició</label>
                <input type="text" id="lugar" name="lugar" required>
                <button type="submit">Crear exposició</button>
            </form>
            <div class="image_expo_box">
                <img src="images/10.-Orlando-furioso.jpg" alt="Statue">
            </div>
        </div>
    </div>
</body>
</html>
