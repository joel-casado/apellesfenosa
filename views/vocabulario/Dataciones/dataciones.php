<?php
require_once "../../../models/database.php";
require_once "../../../models/DatacionesModel.php";
require_once "../../../controllers/DatacionesController.php";

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
    <title>Listado de Dataciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="../ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Dataciones</h1>

    <div class="actions">
        <a href="crear_dataciones.php" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
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
                        <a href="editar_dataciones.php?id=<?php echo $datacion['id_datacion']; ?>" class="edit-button">Editar</a>
                        <form action="../../../index.php?controller=Dataciones&action=deshabilitar&id=<?php echo $datacion['id_datacion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar esta datación?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
