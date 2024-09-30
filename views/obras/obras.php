<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Listado de Obras</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>autor</th>
                <th>Descripció</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra["numero_registro"]; ?></td>
                    <td><?php echo $obra["titulo"]; ?></td>
                    <td><?php echo $obra['autor']; ?></td>
                    <td><?php echo $obra['descripcion']; ?></td>
                    <td><a href="editar.php?id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
