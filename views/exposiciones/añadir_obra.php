<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/exposiciones/añadir_obra.css">
</head>
<body>
    <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Tornar</a>
    <h1>Llistat d'obres</h1>
    <div class="search-bar-container">
        <div class="crear-usuario">
            <button type="submit" form="obraForm" class="btn btn-success">Afegir</button>
        </div>
    </div>
    <form id="obraForm" method="POST" action="index.php?controller=Exposiciones&action=anadirObra&id_exposicion=<?php echo $id_exposicion; ?>">
        <table>
            <thead>
                <tr>
                    <th>Selecciona</th>
                    <th>Obra</th>
                    <th>Número Registre</th>
                    <th>Nom Objecte</th>
                    <th>Títol</th>
                    <th>Ubicació</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($obras)): ?>
                    <?php foreach ($obras as $obra): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="checkbox-obra" name="exposicion_ids[]" value="<?php echo $obra['numero_registro']; ?>">
                            </td>
                            <td>
                                <!-- <img src="" style="max-width: 100px; height: auto;">-->
                            </td>
                            <td><?php echo $obra['numero_registro']; ?></td>
                            <td><?php echo $obra['nombre_objeto']; ?></td>
                            <td><?php echo $obra['titulo']; ?></td>
                            <td><?php echo $obra['ubicacion']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hi ha obres disponibles per a la exposició.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</body>
</html>
