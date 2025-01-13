<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar exposició</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/exposiciones/crear_expo.css">
</head>
<body>
    <div class="container">
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Tornar</a>
        <h1>Editar exposició</h1>
        <div class="expo_box">
            <form action="index.php?controller=Exposiciones&action=update" method="POST">
                <input type="hidden" name="id_exposicion" value="<?php echo $expo['id_exposicion']; ?>">
                <label for="exposicion">Exposició</label>
                <input type="text" name="exposicion" id="exposicion" value="<?= htmlspecialchars($expo['exposicion']); ?>" required>
                <label for="inicio">Data inici expo.</label>
                <input type="date" id="inicio" name="inicio" value="<?= $expo['fecha_inicio_expo']; ?>" required>
                <label for="fin">Data fi expo.</label>
                <input type="date" id="fin" name="fin" value="<?= $expo['fecha_fin_expo']; ?>" required>
                <label for="tipo">Tipus exposició</label>
                <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($expo['tipo_exposicion']); ?>" required>
                <label for="lugar">Lloc exposició</label>
                <input type="text" id="lugar" name="lugar" value="<?= htmlspecialchars($expo['sitio_exposicion']); ?>" required>
                <button type="submit">Guardar cambios</button>
            </form>
            <div class="image_expo_box">
                <img src="images/3.-Busto-de-Dora-Maar.jpg" alt="Statue">
            </div>
        </div>
    </div>
</body>
</html>