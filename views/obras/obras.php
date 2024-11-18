<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['tecnic']) && !isset($_SESSION['convidat'])) {
    
    header("Location: index.php?controller=Login&action=verLogin");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>.actions {
  margin-right: 540px;
  margin-top: 100px;
  margin-bottom: 20px;
  display: flex;
  justify-content: flex-end; /* Alinea a la derecha */
  margin-bottom: -90px;
}</style>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="edit-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a>
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Exposiciones</a>
        <a href="index.php?controller=Ubicacion&action=verArbol" class="edit-button">Ubicaciones</a>
    </div>

    
    <h1>OBRAS DISPONIBLES</h1>
    <form class="search-bar">
		<input type="text" id="q" placeholder="Buscador de obra" onkeyup="search()">
	</form>

    <div class="filters">
        <form id="filterForm" method="POST" action="index.php?controller=Obras&action=filter">
            <div class="filter-group">
                <label for="filterField1">Campo 1:</label>
                <select name="filterField1" id="filterField1">
                    <option value="">Seleccione un campo</option>
                    <option value="nombre_objeto">Nombre Objeto</option>
                    <option value="valoracion_econ">Valoración Económica</option>
                    <option value="fecha_registro">Fecha Registro</option>
                    <!-- Add more fields as needed -->
                </select>
                <input type="text" name="filterValue1" id="filterValue1" placeholder="Valor" />
            </div>
            <!-- Repeat for up to 5 fields -->
            <button type="submit">Filtrar</button>
        </form>
    </div>


        <div class="actions">
            <a href="index.php?controller=Obras&action=crear" class="edit-button">Crear</a>
            <a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras" class="edit-button">Generar PDF Todas las Obras</a>
            <div class="pdf">
                <button id="generate-pdf">Generar PDF</button>
            </div>
        </div>
    <table>
        <thead>
            <tr>
                <th>Imatge</th>
                <th>Nom Objecte</th>
                <th>Títol</th>
                <th>Autor</th>
                <th>Técnica</th>
                <th>Ubicació</th>
                <th>Material</th>
                <th>Tècnica</th>
                <th colspan="3">Acció</th>
            </tr>
        </thead>
        <tbody id="the_table_body">
            <?php foreach ($obras as $obra): ?>
                <tr>
                <td>
                    <?php if (!empty($obra['imagen_url'])): ?>
                        <img src="<?php echo htmlspecialchars($obra['imagen_url']); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>">
                    <?php else: ?>
                        <img src="ruta/a/la/imagen/por_defecto.jpg" alt="Sin imagen" style="width: 100px; height: auto;">
                        <p>Sin imagen disponible</p>
                    <?php endif; ?>
                </td>
                    <td><?php echo $obra["numero_registro"]; ?></td>
                    <td><?php echo $obra['titulo']; ?></td>
                    <td><?php echo $obra['nombre_autor']; ?></td>
                    <td><?php echo $obra['texto_tecnica']; ?></td>
                    <td><?php echo $obra['ubicacion']; ?></td>
                    <td><?php echo $obra['texto_material']; ?></td>
                    <td><?php echo $obra["texto_tecnica"]; ?></td>
                    <td><a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Editar</a>
                    <td><a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">FichaBásica</a></td>
                    <td><a href="index.php?controller=Obras&action=mostrarFichaGeneral&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">FichaGeneral</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



    <script src="scripts/busqueda.js"></script>
    <script>
    document.getElementById('filterField1').addEventListener('change', function () {
    const fieldType = this.value;
    const input = document.getElementById('filterValue1');

    if (['valoracion_econ', 'maxima_altura', 'maxima_anchura'].includes(fieldType)) {
        input.placeholder = "Rango (ej, 10-50)";
    } else if (fieldType === 'fecha_registro') {
        input.type = "date";
        input.placeholder = "Fecha";
    } else {
        input.type = "text";
        input.placeholder = "Texto";
    }
    });
    </script>
</body>
</html>