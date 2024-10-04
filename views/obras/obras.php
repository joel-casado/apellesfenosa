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
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>

    <h1>Listado de Obras</h1>
    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th>Número Registre</th>
                <th>Nom Objecte</th>
                <th>Títol</th>
                <th>Autor</th>
                <th>Datació</th>
                <th>Ubicació</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra["numero_registro"]; ?></td>
                    <td><?php echo $obra["Nom Objecte"]; ?></td>
                    <td><?php echo $obra['autor']; ?></td>
                    <td><?php echo $obra['datacio']; ?></td>
                    <td><?php echo $obra['ubicacio']; ?></td>
                    <td><?php echo $obra['accio']; ?></td>
                    <td><a href="editar.php?id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
