<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$datacionesModel = new DatacionesModel($conn);
$dataciones = $datacionesModel->getDataciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataciones</title>
    <link rel="stylesheet" href="styles/obras/obras.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
    <h1>Listado de Dataciones</h1>

    <div class="actions">
        <a href="index.php?controller=dataciones&action=crearDataciones" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Datación</th>
                <th>Nombre Datación</th>
                <th>Año Inicio</th>
                <th>Año Final</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataciones as $datacion): ?>
                <tr>
                    <td><?php echo($datacion['id_datacion']); ?></td>
                    <td><?php echo($datacion['nombre_datacion']); ?></td>
                    <td><?php echo($datacion['ano_inicio']); ?></td>
                    <td><?php echo($datacion['ano_final']); ?></td>
                    <td>
                        <a href="index.php?controller=dataciones&action=mostrarFormulario&id=<?php echo $datacion['id_datacion']; ?>" class="edit-button">Editar</a>
                        <?php if ($datacion['activo']): ?>
                            <form action="index.php?controller=dataciones&action=deshabilitar&id=<?php echo $datacion['id_datacion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar esta datación?');">
                                <button type="submit" id="deshabilitar">Deshabilitar</button>
                            </form>
                        <?php else: ?>
                            <form action="index.php?controller=dataciones&action=habilitar&id=<?php echo $datacion['id_datacion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres habilitar esta datación?');">
                                <button type="submit" id="habilitar">Habilitar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
