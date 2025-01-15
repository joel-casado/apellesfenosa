<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbre d'Ubicacions</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
    <link rel="stylesheet" href="styles/arbol/vistaArbol.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
</head>
<body>

    <div class="container">
        <h1>Arbre d'Ubicacions</h1>
        <div id="jstree"></div>

        <div class="action-buttons">
            <button id="btnCrearUbicacion">Crear Ubicació</button>
            <button id="btnEditarUbicacion" disabled>Editar Ubicació</button>
            <button id="btnListarObras" disabled>Llistar Obras</button>
            <button id="btnEliminarUbicacion" disabled>Eliminar Ubicació</button>
        </div>
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
            $("#btnEditarUbicacion").prop("disabled", false);
            $("#btnListarObras").prop("disabled", false);
            $("#btnEliminarUbicacion").prop("disabled", false);
        });

        $('#jstree').on("deselect_node.jstree", function(e, data) {
            selectedNodeId = null;
            $("#btnEditarUbicacion").prop("disabled", true);
            $("#btnListarObras").prop("disabled", true);
            $("#btnEliminarUbicacion").prop("disabled", true);
        });

        $(document).on("click", function(event) {
            if (!$(event.target).closest("#jstree").length) {
                $('#jstree').jstree("deselect_all");
                selectedNodeId = null;
                $("#btnEditarUbicacion").prop("disabled", true);
                $("#btnListarObras").prop("disabled", true);
                $("#btnEliminarUbicacion").prop("disabled", true);
            }
        });

        $('#btnCrearUbicacion').on('click', function() {
            let url = 'index.php?controller=ubicacion&action=crearUbicacion';
            if (selectedNodeId) {
                url += `&padre_id=${selectedNodeId}`;
            }
            window.location.href = url;
        });

        $('#btnEditarUbicacion').on('click', function() {
            if (selectedNodeId) {
                window.location.href = `index.php?controller=ubicacion&action=editarUbicacion&id=${selectedNodeId}`;
            }
        });

        $('#btnListarObras').on('click', function() {
            if (selectedNodeId) {
                window.location.href = `index.php?controller=ubicacion&action=listarObras&id=${selectedNodeId}`;
            }
        });

        $('#btnEliminarUbicacion').click(function () {
            var selectedNode = $('#jstree').jstree('get_selected', true)[0];
            if (selectedNode) {
                if (confirm('Està segur que desitja eliminar aquesta ubicació i totes les seves sububicacions?')) {
                    window.location.href = 'index.php?controller=ubicacion&action=eliminarUbicacion&id=' + selectedNode.id;
                }
            }
        });
    });
    </script>
</body>
</html>
