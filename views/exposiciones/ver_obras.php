<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/exposiciones/ver_obras.css">
</head>
<body>
    <div class="container">
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Tornar</a>
        <h1>Exposició seleccionada</h1>
        <?php
            if (!isset($id_exposicion) || empty($id_exposicion)) {
                echo "El ID de exposición no está definido o está vacío.";
                return;
            }
        ?>
        <div class="crear-usuario">
            <a href="index.php?controller=Exposiciones&action=anadirObra&id_exposicion=<?php echo $id_exposicion; ?>" class="btn btn-success">Afegir</a>
        </div>
        <div class="usuaris_box">
            <table>
                <thead>
                    <tr>
                        <th>Obra</th>
                        <th>Número Registre</th>
                        <th>Nom Objecte</th>
                        <th>Títol</th>
                        <th>Ubicació</th>
                        <th>Acció</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($obras)): ?>
                        <?php foreach ($obras as $obra): ?>
                            <tr>
                                <td><?php echo '<img src="">'; ?></td>
                                <td><?php echo $obra["numero_registro"]; ?></td>
                                <td><?php echo $obra["nombre_objeto"]; ?></td>
                                <td><?php echo $obra['titulo']; ?></td>
                                <td><?php echo $obra['ubicacion']; ?></td>
                                <td>
                                    <a href="index.php?controller=Exposiciones&action=removeObra&id_exposicion=<?php echo $id_exposicion; ?>&numero_registro=<?php echo $obra['numero_registro']; ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No hay obras disponibles para esta exposición.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>