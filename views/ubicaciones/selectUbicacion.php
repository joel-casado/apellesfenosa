<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Ubicación</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
    <link rel="stylesheet" href="styles/arbol/vistaArbol.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Seleccionar Ubicación</h1>
        <div id="jstree"></div>
        <button id="btnSelectUbicacion" disabled>Seleccionar Ubicación</button>
    </div>

    <script>
    $(document).ready(function() {
        $('#jstree').jstree({
            'core': {
                'data': <?php echo json_encode($ubicacionesData); ?>
            }
        });

        let selectedNodeId = null;

        $('#jstree').on("select_node.jstree", function(e, data) {
            selectedNodeId = data.node.id;
            $("#btnSelectUbicacion").prop("disabled", false);
        });

        $('#jstree').on("deselect_node.jstree", function(e, data) {
            selectedNodeId = null;
            $("#btnSelectUbicacion").prop("disabled", true);
        });

        $('#btnSelectUbicacion').on('click', function() {
            if (selectedNodeId) {
                window.opener.document.getElementById('ubicacion').value = selectedNodeId;
                window.close();
            }
        });
    });
    </script>
</body>
</html>