<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$ClasificacionesModel = new ClasificacionesModel($conn);
$Clasificaciones = $ClasificacionesModel->getClasificaciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificaciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
    <h1>Listado de Clasificaciones</h1>

    <div class="actions">
        <a href="index.php?controller=clasificaciones&action=crearClasificaciones" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Texto Clasificaciones</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Clasificaciones as $clasificacion): ?>
                <tr>
                    <td><?php echo($clasificacion['id_clasificacion']); ?></td>
                    <td><?php echo($clasificacion['texto_clasificacion']); ?></td>
                    <td>
                    <a href="index.php?controller=clasificaciones&action=mostrarFormulario&id=<?php echo $clasificacion['id_clasificacion']; ?>" class="edit-button">Editar</a>
                        <form action="index.php?controller=Clasificaciones&action=deshabilitar&id=<?php echo $clasificacion['id_clasificacion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este autor?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>
</html>
