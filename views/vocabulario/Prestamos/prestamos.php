<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$prestamosModel = new prestamosModel($conn);
$prestamos = $prestamosModel->getprestamos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prestamos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
    <h1>Listado de prestamos</h1>

    <div class="actions">
        <a href="index.php?controller=prestamos&action=crearprestamos" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número prestamo</th>
                <th>Inicio</th>
                <th>Devolución</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $prestamo): ?>
                <tr>
                    <td><?php echo($prestamo['id_prestamo']); ?></td>
                    <td><?php echo($prestamo['numero_registro']); ?></td>
                    <td><?php echo($prestamo['fecha_prestacion']); ?></td>
                    <td><?php echo($prestamo['fecha_devolucion']); ?></td>
                    <td>
                        <a href="index.php?controller=prestamos&action=mostrarFormulario&id=<?php echo $prestamo['id_prestamo']; ?>" class="edit-button">Editar</a>
                        <form action="index.php?controller=prestamos&action=deshabilitar&id=<?php echo $prestamo['id_prestamo']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este prestamo?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>
</html>
