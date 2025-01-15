<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ubicación</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="styles/ubicaciones/editarUbicacion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#fecha_inicio_ubi, #fecha_fin_ubi").datepicker({
                dateFormat: "dd/mm/yy"
            });
        });
    </script>
</head>
<body>

    <a href="index.php?controller=ubicacion&action=verArbol" class="edit-button">Tornar</a>

    <h2>Editar Ubicación</h2>
    <div class="form_container">
        <form action="index.php?controller=ubicacion&action=updateUbicacion&id=<?php echo htmlspecialchars($ubicacion['id_ubicacion']); ?>" method="POST">
            <label for="nombre_ubicacion">Nombre de Ubicación:</label>
            <input type="text" id="nombre_ubicacion" name="nombre_ubicacion" value="<?php echo htmlspecialchars($ubicacion['nombre_ubicacion']); ?>" required>

            <label for="fecha_inicio_ubi">Fecha Inicio:</label>
            <input type="text" id="fecha_inicio_ubi" name="fecha_inicio_ubi" value="<?php echo date('d/m/Y', strtotime($ubicacion['fecha_inicio_ubi'])); ?>" required>

            <label for="fecha_fin_ubi">Fecha Fin:</label>
            <input type="text" id="fecha_fin_ubi" name="fecha_fin_ubi" value="<?php echo date('d/m/Y', strtotime($ubicacion['fecha_fin_ubi'])); ?>">

            <label for="comentario_ubicacion">Comentario:</label>
            <textarea id="comentario_ubicacion" name="comentario_ubicacion"><?php echo htmlspecialchars($ubicacion['comentario_ubicacion']); ?></textarea>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

</body>
</html>
