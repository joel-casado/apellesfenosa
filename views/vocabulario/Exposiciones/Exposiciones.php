<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$exposicionesModel = new exposicionesModel($conn);
$exposiciones = $exposicionesModel->getexposiciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exposiciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
    <h1>Listado de exposiciones</h1>

    <div class="actions">
        <a href="index.php?controller=exposiciones&action=crearexposiciones" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo exposiciones</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Lugar</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exposiciones as $exposicion): ?>
                <tr>
                    <td><?php echo($exposicion['id_exposicion']); ?></td>
                    <td><?php echo($exposicion['tipo_exposicion']); ?></td>
                    <td><?php echo($exposicion['fecha_inicio_expo']); ?></td>
                    <td><?php echo($exposicion['fecha_fin_expo']); ?></td>
                    <td><?php echo($exposicion['sitio_exposicion']); ?></td>
                    <td>
                        <a href="index.php?controller=Exposiciones&action=mostrarFormulario&id=<?php echo $exposicion['id_exposicion']; ?>" class="edit-button">Editar</a>
                        <form action="index.php?controller=exposiciones&action=deshabilitar&id=<?php echo $exposicion['id_exposicion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este autor?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>
</html>
