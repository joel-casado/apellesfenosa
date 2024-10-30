<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar exposició</title>
    <link rel="stylesheet" href="styles/usuarioexposiciones/editar_expo.css">
</head>
<body>
    <div class="header">
        <a href="index.php?controller=Obras&action=verObras"><img src="images/login/logo.png" alt="Museu Apel·les Fenosa"></a>
        <a href="index.php?controller=Login&action=logout" class="create-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="create-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="create-button">Obras</a><br>
    </div>
    <div class="editar">
        <form action="index.php?controller=Exposiciones&action=edita_expo" method="POST">
            <input type="date" id="inicio" value="<?php $expo['fecha_inicio_expo']; ?>">
            <input type="date" id="fin" name="fin" value="<?php $expo['fecha_fin_expo']; ?>">
            <input type="text" id="tipo" name="tipo" value="<?php $expo['tipo_exposicion']; ?>">
            <input type="text" id="lugar" name="lugar" value="<?php $expo['sitio_exposicion']; ?>">
            <button type="submit">Guardar cambios</button>
        </form>
        <div class="image_editar">
            <img src="images/3.-Busto-de-Dora-Maar.jpg" alt="Statue">
        </div>
    </div>
</body>
</html>