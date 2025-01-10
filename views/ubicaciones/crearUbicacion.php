<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ubicación</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
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

        h1 {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
        }

        .form_container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], 
        input[type="date"], 
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
            color: #333;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        $(function() {
            $("#fecha_inicio_ubi, #fecha_fin_ubi").datepicker({
                dateFormat: "dd/mm/yy"
            });
        });
    </script>
</head>
<body>

    <div class="header">
        <img src="images/login/Logo.png" alt="Logo">
    </div>

    <h1>Crear Nueva Ubicación</h1>

    <div class="form_container">
        <form action="index.php?controller=ubicacion&action=crearUbicacion&padre_id=<?php echo isset($_GET['padre_id']) ? $_GET['padre_id'] : ''; ?>" method="POST">
            <label for="nombre_ubicacion">Nombre de Ubicación:</label>
            <input type="text" id="nombre_ubicacion" name="nombre_ubicacion" required>
            
            <label for="fecha_inicio_ubi">Fecha Inicio:</label>
            <input type="text" id="fecha_inicio_ubi" name="fecha_inicio_ubi" required>
            
            <label for="fecha_fin_ubi">Fecha Fin:</label>
            <input type="text" id="fecha_fin_ubi" name="fecha_fin_ubi">
            
            <label for="comentario_ubicacion">Comentario:</label>
            <textarea id="comentario_ubicacion" name="comentario_ubicacion"></textarea>
            
            <button type="submit">Crear Ubicación</button>
        </form>
    </div>

</body>
</html>
