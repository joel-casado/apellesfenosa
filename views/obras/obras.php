<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
</head>
<body>
    <h1>Listado de Obras</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>autor</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra["numero_registro"]; ?></td>
                    <td><?php echo $obra["titulo"]; ?></td>
                    <td><?php echo $obra['autor']; ?></td>
                    <td><?php echo $obra['descripcion']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
