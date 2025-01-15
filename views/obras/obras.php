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
<body>

<div class="content">

    <h1>OBRAS DISPONIBLES</h1>
    <div class="busqueda-avanzada-container">
        <button id="addFiltersButton" class="toggle-filters">Búsqueda Avanzada</button>
        <div class="busqueda-avanzada" id="busquedaAvanzada" style="display: none;">
            <form id="filterForm" method="POST" action="index.php?controller=Obras&action=filter">
                <div id="filterGroups"></div>
                <button type="submit" class="filter-submit">Filtrar</button>
            </form>
        </div>
        <form class="search-bar">
            <input type="text" id="q" placeholder="Buscador de obra" onkeyup="search()">
        </form>
        <form method="POST" action="index.php?controller=Obras&action=generarPdf">
            <input type="hidden" name="filteredData" id="filteredData"/>
            <button type="submit" class="pdf" id="generate-pdf" disabled>Generar PDF</button>
        </form>
        <a href="index.php?controller=Obras&action=crear" class="create-button">Crear</a>
    </div>
    <div class="actions">
        
    </div>
    

    <table>
        <thead>
        <tr>
            <th>Imatge</th>
            <th>Nº registre</th>
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
                    <img src="<?php echo htmlspecialchars($obra['imagen_url']); ?>" 
                        alt="<?php echo htmlspecialchars($obra['titulo']); ?>">
                <?php else: ?>
                    <img src="images/login/default.png" 
                        alt="Imagen por defecto">
                <?php endif; ?>
            </td>
                <td><?php echo $obra["numero_registro"]; ?></td>
                <td><?php echo $obra['titulo']; ?></td>
                <td><?php echo $obra['nombre_autor']; ?></td>
                <td><?php echo $obra['texto_tecnica']; ?></td>
                <td><?php echo $obra['ubicacion']; ?></td>
                <td><?php echo $obra['texto_material']; ?></td>
                <td><?php echo $obra["texto_tecnica"]; ?></td>
                <td><a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>"
                       class="edit-button">Editar</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script src="scripts/busqueda.js"></script>
<script src="scripts/busquedaAvanzada.js"></script>


</body>
</html>
