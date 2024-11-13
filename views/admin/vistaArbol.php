<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol de Ubicaciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
    <style>
        /* General styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        
        .header {
            width: 100%;
            padding: 20px;
            background-color: white;
            display: flex;
            justify-content: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .header img {
            height: 50px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 800px;
            text-align: center;
        }

        /* Title */
        h1 {
            font-weight: 500;
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        /* Tree container */
        #jstree {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Button styling */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-buttons button {
            background-color: #6589C4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 0.9em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .action-buttons button:hover:not(:disabled) {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>

    <div class="container">
        <h1>Árbol de Ubicaciones</h1>
        <div id="jstree"></div>

        <div class="action-buttons">
            <button id="btnCrearUbicacion">Crear Ubicación</button>
            <button id="btnEditarUbicacion" disabled>Editar Ubicación</button>
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
