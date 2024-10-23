<?php

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$ingresoModel = new ingresoModel($conn);
$ingresos = $ingresoModel->getingresos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ingresos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de ingresos</h1>

    <div class="actions">
        <a href="index.php?controller=ingresos&action=crearingreso" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código ingreso</th>
                <th>Nombre ingreso</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingresos as $ingreso): ?>
                <tr>
                    <td><?php echo($ingreso['id_forma_ingreso']); ?></td>
                    <td><?php echo($ingreso['texto_forma_ingreso']); ?></td>
                    <td>
                        <a href="index.php?controller=ingresos&action=mostrarFormulario&id=<?php echo $ingreso['id_forma_ingreso']; ?>" class="edit-button">Editar</a>
                        <form onsubmit="return false;" style="display:inline-block;">
                            <button type="button" class="edit-button" onclick="deshabilitaringreso('<?php echo $ingreso['id_forma_ingreso']; ?>', this)">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>
</html>
