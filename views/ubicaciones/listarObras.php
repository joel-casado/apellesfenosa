<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras en Ubicación</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
            margin-top: 20px;
        }

        h1 {
            font-weight: 500;
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            background-color: #6589C4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 0.9em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Obras en Ubicación</h1>
        <table>
            <thead>
                <tr>
                    <th>Número de Registro</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Material</th>
                    <th>Técnica</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($obras)): ?>
                    <?php foreach ($obras as $obra): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($obra['numero_registro']); ?></td>
                            <td><?php echo htmlspecialchars($obra['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($obra['nombre_autor']); ?></td>
                            <td><?php echo htmlspecialchars($obra['texto_material']); ?></td>
                            <td><?php echo htmlspecialchars($obra['texto_tecnica']); ?></td>
                            <td><?php echo htmlspecialchars($obra['fecha_registro']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay obras en esta ubicación.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button class="back-button" onclick="window.history.back();">Volver</button>
    </div>
</body>
</html>