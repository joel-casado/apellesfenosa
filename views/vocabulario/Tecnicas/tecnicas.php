<?php
require_once "../../../models/database.php";
require_once "../../../models/tecnicasModel.php";
require_once "../../../controllers/TecnicasController.php";

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$tecnicaModel = new tecnicaModel($conn);
$Tecnicas = $tecnicaModel->getTecnicas();
?>
<script>
    function deshabilitartecnica(codigo, button) {
        if (confirm('¿Estás seguro de que quieres deshabilitar este tecnica?')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../../index.php?controller=Tecnicas&action=deshabilitar&id=" + codigo, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Si la solicitud fue exitosa, eliminamos la fila del tecnica
                    var row = button.closest('tr');
                    row.parentNode.removeChild(row);
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
    <title>Tecnicas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="../ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Tecnicas</h1>

    <div class="actions">
        <a href="crear_tecnicas.php" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código Getty</th>
                <th>Texto tecnica</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Tecnicas as $tecnica): ?>
                <tr>
                    <td><?php echo($tecnica['codigo_getty_tecnica']); ?></td>
                    <td><?php echo($tecnica['texto_tecnica']); ?></td>
                    <td>
                        <a href="editar_tecnicas.php?id=<?php echo $tecnica['codigo_getty_tecnica']; ?>" class="edit-button">Editar</a>
                        <form onsubmit="return false;" style="display:inline-block;">
                            <button type="button" class="edit-button" onclick="deshabilitartecnica('<?php echo $tecnica['codigo_getty_tecnica']; ?>', this)">Deshabilitar</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>

</body>
</html>
