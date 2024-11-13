<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol de Ubicaciones</title>
    <link rel="stylesheet" href="SCSS/prueba/prueba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
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

    <h1>Árbol de Ubicaciones</h1>
    <div id="jstree"></div>
    
    <!-- Action buttons for creating and editing locations -->
    <button id="btnCrearUbicacion">Crear Ubicación</button>
    <button id="btnEditarUbicacion" disabled>Editar Ubicación</button>

    <script>
    $(document).ready(function() {
        $('#jstree').jstree({
            'core': {
                'data': <?php echo json_encode($ubicacionesData); ?>
            }
        });

        let selectedNodeId = null;

        // Handle node selection in jsTree
        $('#jstree').on("select_node.jstree", function(e, data) {
            selectedNodeId = data.node.id;
            $("#btnEditarUbicacion").prop("disabled", false);
        });

        // Deselect the selected node when clicking outside of jsTree
        $(document).on("click", function(event) {
            if (!$(event.target).closest("#jstree").length) {
                $('#jstree').jstree("deselect_all");
                selectedNodeId = null;
                $("#btnEditarUbicacion").prop("disabled", true);
            }
        });

        // Create button action - handles selected and unselected nodes
        $('#btnCrearUbicacion').on('click', function() {
            let url = 'index.php?controller=ubicacion&action=crearUbicacion';
            if (selectedNodeId) {
                url += `&padre_id=${selectedNodeId}`;
            }
            window.location.href = url;
        });

        // Edit button action
        $('#btnEditarUbicacion').on('click', function() {
            if (selectedNodeId) {
                window.location.href = `index.php?controller=ubicacion&action=editarUbicacion&id=${selectedNodeId}`;
            }
        });
    });
    </script>
</body>
</html>
