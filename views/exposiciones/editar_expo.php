<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar exposició</title>
    <link rel="stylesheet" href="styles/exposiciones/editar_expo.css">
</head>
<body>
    <div class="header">
            <img src="images/login/Logo.png" alt="Logo">
    </div>
    <div class="editar">
    <form action="index.php?controller=Exposiciones&action=update" method="POST">
            <input type="hidden" name="id_exposicion" value="<?php echo $expo['id_exposicion']; ?>">
            <input type="text" name="exposicion" value="<?= htmlspecialchars($expo['exposicion']); ?>" required>
            <input type="date" name="inicio" value="<?= $expo['fecha_inicio_expo']; ?>" required>
            <input type="date" name="fin" value="<?= $expo['fecha_fin_expo']; ?>" required>
            <input type="text" name="tipo" value="<?= htmlspecialchars($expo['tipo_exposicion']); ?>" required>
            <input type="text" name="lugar" value="<?= htmlspecialchars($expo['sitio_exposicion']); ?>" required>
            <button type="submit">Guardar cambios</button>
        </form>

            
        <div class="image_editar">
            <img src="images/3.-Busto-de-Dora-Maar.jpg" alt="Statue">
        </div>
    </div>
</body>
</html>