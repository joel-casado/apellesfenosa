<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/header/sidebar_header.css">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
<?php include 'views/header/sidebar_header.php'; ?>
<div class="sidebar">
    <ul class="menu">
        <li><a href="index.php?controller=Obras&action=verObras"><i class="fas fa-palette"></i> <span>Obres</span></a></li>
        <li><a href="index.php?controller=vocabulario&action=mostrarVocabulario"><i class="fas fa-book"></i> <span>Vocabulari</span></a></li>
        <li><a href="index.php?controller=Exposiciones&action=listado_exposiciones"><i class="fas fa-university"></i> <span>Exposicions</span></a></li>
        <li><a href="index.php?controller=Ubicacion&action=verArbol"><i class="fas fa-map-marker-alt"></i> <span>Ubicacions</span></a></li>
        <li><a href="index.php?controller=usuaris&action=listar_usuarios"><i class="fa-solid fa-user"></i> <span>Usuaris</span></a></li>
        <li><a href="index.php?controller=Backup&action=createBackup"><i class="fa-solid fa-file"></i> <span>Backup</span></a></li>
        <li><a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras"><i class="fa-regular fa-file-pdf"></i><span>Llibre-registre</span></a></li>
        <li><a href="index.php?action=exportarCsv"> <i class="fas fa-file-export"></i> <span>Exportar Obras (CSV)</span></a></li>
        <li><a href="index.php?controller=Prestec&action=generarWord"><i class="fas fa-book-open"></i><span>Prestec</span></a></li>
        <li><a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras"> <i class="fas fa-file-pdf"></i><span>Generar libro-registro</span></a></li>
        <li><a href="index.php?controller=Login&action=logout"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a></li> 
    </ul>
    <div class="toggle-btn">
        <i class="fas fa-angle-double-right"></i>
    </div>
</div>

<div class="content">
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>

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
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const toggleBtn = document.querySelector(".toggle-btn i");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("expanded");

            if (sidebar.classList.contains("expanded")) {
                toggleBtn.classList.replace("fa-angle-double-right", "fa-angle-double-left");
            } else {
                toggleBtn.classList.replace("fa-angle-double-left", "fa-angle-double-right");
            }
        });
    });
    document.addEventListener("DOMContentLoaded", () => {
    const toggleFiltersButton = document.querySelector(".toggle-filters");
    const busquedaAvanzadaDiv = document.getElementById("busquedaAvanzada");

        toggleFiltersButton.addEventListener("click", () => {
            // Alterna la clase 'active' para mostrar/ocultar
            if (busquedaAvanzadaDiv.style.display === "block") {
                busquedaAvanzadaDiv.style.display = "none";
            } else {
                busquedaAvanzadaDiv.style.display = "block";
            }
        });
    });



</script>

</body>
</html>
