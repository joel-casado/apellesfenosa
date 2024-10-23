<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$tecnicaModel = new tecnicasModel($conn);
$Tecnicas = $tecnicaModel->getTecnicas();
?>
<script>
    function deshabilitartecnica(codigo, button) {
    if (confirm('¿Estás seguro de que quieres deshabilitar esta técnica?')) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php?controller=tecnicas&action=deshabilitar&id=" + codigo, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.status === 'success') {
                    // Si la respuesta es exitosa, eliminamos la fila del DOM
                    var row = button.closest('tr');
                    row.parentNode.removeChild(row);
                } else {
                    alert("Error: " + response.message);
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
    <title>Tecnicas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Tecnicas</h1>

    <div class="actions">
        <a href="index.php?controller=tecnicas&action=creartecnica" class="edit-button">Crear</a>
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
                        <a href="index.php?controller=tecnicas&action=mostrarFormulario&id=<?php echo $tecnica['codigo_getty_tecnica']; ?>" class="edit-button">Editar</a>
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
