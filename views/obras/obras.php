<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scroll */
            width: 100%;
            background-color: #F3F3F3;
        }

        .actions {
            margin-right: 540px;
            margin-top: 100px;
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
            margin-bottom: -90px;
        }

        .sidebar {
            background-color: #FFFFFF;
            color: #ecf0f1;
            width: 60px;
            min-height: 100vh;
            transition: width 0.3s;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar .logo {
            text-align: center;
            padding: 10px 0;
        }

        .sidebar img {
            max-width: 40px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a {
            color: #000000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar ul li:hover {
            background-color: #f3f3f3;
        }

        .sidebar .toggle-btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            cursor: pointer;
            color: #000000;
            font-size: 20px;
        }

        .sidebar.expanded {
            width: 200px;
        }

        .sidebar.expanded ul li span {
            display: inline;
        }

        .sidebar ul li span {
            display: none;
        }

        .content {
            margin-left: 60px;
            padding: 20px;
            transition: margin-left 0.3s;
            box-sizing: border-box; /* Ensure padding/margin is within width */
            max-width: calc(100vw - 60px); /* Prevent overflow when sidebar is collapsed */
        }

        .sidebar.expanded ~ .content {
            margin-left: 200px;
            max-width: calc(100vw - 200px); /* Adjust for expanded sidebar */
        }

        .header {
            box-sizing: border-box;
            width: calc(100% - 60px); /* Prevent header from overflowing */
            position: fixed;
            top: 0;
            left: 60px;
            height: 10%;
            background-color: #ffffff;
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar.expanded ~ .header {
            left: 200px;
            width: calc(100% - 200px); /* Adjust for expanded sidebar */
        }

        table {
            width: 100%; /* Ensure table doesn't overflow */
            table-layout: auto;
            border-collapse: collapse;
        }


        .filters, .search-bar, form {
            margin-top: 80px;
        }

    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>
    <ul class="menu">
        <li><a href="index.php?controller=Obras&action=verObras"><i class="fas fa-palette"></i> <span>Obres</span></a></li>
        <li><a href="index.php?controller=vocabulario&action=mostrarVocabulario"><i class="fas fa-book"></i> <span>Vocabulari</span></a></li>
        <li><a href="index.php?controller=Exposiciones&action=listado_exposiciones"><i class="fas fa-university"></i> <span>Exposicions</span></a></li>
        <li><a href="index.php?controller=Ubicacion&action=verArbol"><i class="fas fa-map-marker-alt"></i> <span>Ubicacions</span></a></li>
        <li><a href="index.php?controller=usuaris&action=listar_usuarios"><i class="fa-solid fa-user"></i> <span>Usuaris</span></a></li>
        <li><a href="index.php?controller=Backup&action=createBackup"><i class="fa-solid fa-file"></i> <span>Backup</span></a></li>
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
    <div class="filters">
        <form id="filterForm" method="POST" action="index.php?controller=Obras&action=filter">
            <!-- Grupos filtros en archivo js-->
            <div id="filterGroups"></div>

            <button type="submit">Filtrar</button>
        </form>
    </div>

    <form method="POST" action="index.php?controller=Obras&action=generarPdf">
        <input type="hidden" name="filteredData" id="filteredData"/>
        <button type="submit" class="pdf" id="generate-pdf" disabled>Generar PDF</button>
    </form>

    <form class="search-bar">
        <input type="text" id="q" placeholder="Buscador de obra" onkeyup="search()">
    </form>

    <div class="actions">
        <a href="index.php?controller=Obras&action=crear" class="edit-button">Crear</a>
        <a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras" class="edit-button">Generar libro-registro</a>
        <a href="index.php?controller=Prestec&action=generarWord" class="edit-button">Prestec</a>
        <a href="index.php?action=exportarCsv" class="btn btn-success">Exportar Obras (CSV)</a>
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
                        <img src="<?php echo htmlspecialchars("images/default.png"); ?>">
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
                <td><a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>"
                       class="edit-button">Editar</a></td>
                <td><a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $obra['numero_registro']; ?>"
                       class="edit-button">FichaBásica</a></td>
                <td><a href="index.php?controller=Obras&action=mostrarFichaGeneral&id=<?php echo $obra['numero_registro']; ?>"
                       class="edit-button">FichaGeneral</a></td>
                <td><a href="index.php?controller=restauraciones&action=restauraciones&numero_registro=<?php echo $obra['numero_registro']; ?>"
                       class="edit-button">Restauracions</a></td>
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
</script>

</body>
</html>
