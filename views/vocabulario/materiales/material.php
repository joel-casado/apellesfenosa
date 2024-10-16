<?php
require_once "../../../models/database.php";
require_once "../../../models/MaterialModel.php";
require_once "../../../controllers/MaterialesController.php";

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$materialModel = new MaterialModel($conn);
$materiales = $materialModel->getMateriales();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="../ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Materiales</h1>

    <div class="actions">
        <a href="crear_material.php" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código Getty</th>
                <th>Texto Material</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materiales as $material): ?>
                <tr>
                    <td><?php echo($material['codigo_getty_material']); ?></td>
                    <td><?php echo($material['texto_material']); ?></td>
                    <td>
                        <a href="editar_vocabulario.php?id=<?php echo $material['codigo_getty_material']; ?>" class="edit-button">Editar</a>
                        <form action="../../../index.php?controller=Materiales&action=deshabilitar&id=<?php echo $material['codigo_getty_material']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este material?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>

</body>
</html>
