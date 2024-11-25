<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ficha</title>
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="edit-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a>
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Exposiciones</a>
        <a href="index.php?controller=Ubicacion&action=verArbol" class="edit-button">Ubicaciones</a>
    </div>

<form action="index.php?controller=Prestec&action=procesarFormulario" method="POST">
    <!-- Institución solicitante -->
    <label for="institucion_solicitante">Institución solicitante:</label>
    <input type="text" name="institucion_solicitante" id="institucion_solicitante" required>
    
    <!-- Responsable del préstamo -->
    <label for="responsable_prestamo">Responsable del préstamo:</label>
    <input type="text" name="responsable_prestamo" id="responsable_prestamo" required>
    
    <!-- Cargo -->
    <label for="cargo">Cargo:</label>
    <input type="text" name="cargo" id="cargo" required>
    
    <!-- Exposición -->
    <label for="exposicion">Exposición:</label>
    <input type="text" name="exposicion" id="exposicion" required>
    
    <!-- Lugar -->
    <label for="lugar">Lugar:</label>
    <input type="text" name="lugar" id="lugar" required>
    
    <!-- Fechas -->
    <label for="fecha_prestacion">Fecha inicio:</label>
    <input type="date" name="fecha_prestacion" id="fecha_prestacion" required>

    <label for="fecha_devolucion">Fecha final:</label>
    <input type="date" name="fecha_devolucion" id="fecha_devolucion" required>
    
    <!-- Número de registro -->
    <label for="numero_registro">Número de registro:</label>
    <input type="text" name="numero_registro" id="numero_registro" required>
    
    <!-- Nombre del objeto -->
    <label for="nombre_objeto">Nombre del objeto:</label>
    <input type="text" name="nombre_objeto" id="nombre_objeto" required>
    
    <!-- Dimensiones -->
    <label for="dimensiones">Dimensiones:</label>
    <input type="text" name="dimensiones" id="dimensiones" required>
    
    <!-- Materiales -->
    <label for="materiales">Materiales:</label>
    <input type="text" name="materiales" id="materiales" required>
    
    <!-- Datación -->
    <label for="datacion">Datación:</label>
    <input type="text" name="datacion" id="datacion" required>
    
    <!-- Dirección de recogida -->
    <label for="direccion_recogida">Dirección de recogida:</label>
    <input type="text" name="direccion_recogida" id="direccion_recogida" required>
    
    <!-- Dirección de devolución -->
    <label for="direccion_devolucion">Dirección de devolución:</label>
    <input type="text" name="direccion_devolucion" id="direccion_devolucion" required>
    
    <!-- Teléfono de recogida -->
    <label for="telefono_recogida">Teléfono de recogida:</label>
    <input type="text" name="telefono_recogida" id="telefono_recogida" required>
    
    <!-- Teléfono de devolución -->
    <label for="telefono_devolucion">Teléfono de devolución:</label>
    <input type="text" name="telefono_devolucion" id="telefono_devolucion" required>
    
    <!-- Observaciones -->
    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones"></textarea>
    
    <!-- Botón de envío -->
    <button type="submit">Guardar y Generar Word</button>
</form>
    <script src="scripts/formulario.js"></script>
</body>
</html>