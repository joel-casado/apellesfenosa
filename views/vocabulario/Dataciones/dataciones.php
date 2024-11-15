<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$datacionesModel = new datacionesModel($conn);
$dataciones = $datacionesModel->getdataciones();
?>

<script>
    function deshabilitarDatacion(id, button) {
        if (confirm('¿Estás seguro de que quieres deshabilitar esta datación?')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../../index.php?controller=Dataciones&action=deshabilitar&id=" + id, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Si la solicitud fue exitosa y el servidor responde "success", eliminamos la fila
                    if (xhr.responseText.trim() === "success") {
                        var row = button.closest('tr');
                        row.parentNode.removeChild(row);
                    } else {
                        alert('Hubo un error al deshabilitar la datación.');
                    }
                }
            };

            xhr.send();
        }
    }
</script>

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
                <th>ID</th>
                <th>Nombre</th>
                <th>Año Inicio</th>
                <th>Año Final</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="the_table_body">
            <?php foreach ($dataciones as $datacion): ?>
                <tr>
                    <td><?php echo $datacion['id_datacion']; ?></td>
                    <td><?php echo $datacion['nombre_datacion']; ?></td>
                    <td><?php echo $datacion['ano_inicio']; ?></td>
                    <td><?php echo $datacion['ano_final']; ?></td>
                    <td>
                        <a href="index.php?controller=dataciones&action=mostrarFormulario&id=<?php echo $datacion['id_datacion']; ?>" class="edit-button">Editar</a>
                        <form action="index.php?controller=dataciones&action=deshabilitar&id=<?php echo $datacion['id_datacion']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar esta datación?');">
                            <button type="submit" class="edit-button">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
