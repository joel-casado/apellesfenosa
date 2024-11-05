<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones - Árbol</title>
    <!-- Include jQuery and jsTree CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
</head>
<body>
    <h1>Árbol de Ubicaciones</h1>
    <div id="jstree"></div>
    
    <!-- Action buttons for creating and editing locations -->
    <button id="btnCrearUbicacion" disabled>Crear Ubicación</button>
    <button id="btnEditarUbicacion" disabled>Editar Ubicación</button>

    <script>
    $(document).ready(function() {
        // Initialize jsTree with location data
        $('#jstree').jstree({
            'core': {
                'data': <?php echo json_encode($ubicacionesData); ?> // Data passed from the controller
            }
        });

        let selectedNodeId = null; // To store the ID of the selected node

        // Event listener for node selection in jsTree
        $('#jstree').on("select_node.jstree", function(e, data) {
            selectedNodeId = data.node.id; // Capture the selected node ID
            // Enable buttons when a node is selected
            $("#btnCrearUbicacion").prop("disabled", false);
            $("#btnEditarUbicacion").prop("disabled", false);
        });

        // Button action to create a new location with the selected location as parent
        $('#btnCrearUbicacion').on('click', function() {
            if (selectedNodeId) {
                // Redirect to the "crearUbicacion" action with the selected location as "padre_id"
                window.location.href = `index.php?controller=ubicacion&action=crearUbicacion&padre_id=${selectedNodeId}`;
            }
        });

        // Button action to edit the selected location
        $('#btnEditarUbicacion').on('click', function() {
            if (selectedNodeId) {
                // Redirect to the "editarUbicacion" action with the selected location ID
                window.location.href = `index.php?controller=ubicacion&action=editarUbicacion&id=${selectedNodeId}`;
            }
        });
    });
    </script>
</body>
</html>
