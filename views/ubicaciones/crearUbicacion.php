<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ubicación</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <h2>Crear Nueva Ubicación</h2>
    <form action="index.php?controller=ubicacion&action=crearUbicacion&padre_id=<?php echo isset($_GET['padre_id']) ? $_GET['padre_id'] : ''; ?>" method="POST">
        <label for="nombre_ubicacion">Nombre de Ubicación:</label>
        <input type="text" id="nombre_ubicacion" name="nombre_ubicacion" required>
        
        <label for="fecha_inicio_ubi">Fecha Inicio:</label>
        <input type="text" id="fecha_inicio_ubi" name="fecha_inicio_ubi" required>
        
        <label for="fecha_fin_ubi">Fecha Fin:</label>
        <input type="text" id="fecha_fin_ubi" name="fecha_fin_ubi">
        
        <label for="comentario_ubicacion">Comentario:</label>
        <textarea id="comentario_ubicacion" name="comentario_ubicacion"></textarea>
        
        <button type="submit">Crear Ubicación</button>
    </form>
</body>
</html>
