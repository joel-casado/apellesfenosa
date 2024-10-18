<?php

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$MaterialModel = new MaterialModel($conn);
$Materiales = $MaterialModel->getMateriales();
?>
<script>
    function deshabilitarmaterial(codigo, button) {
    if (confirm('¿Estás seguro de que quieres deshabilitar este material?')) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php?controller=materiales&action=deshabilitar&id=" + codigo, true);
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

function deshabilitarmaterial(codigo, button) {
    // Paso 1: Mostrar un cuadro de confirmación al usuario
    if (confirm('¿Estás seguro de que quieres deshabilitar este material?')) {
        
        // Paso 2: Crear un nuevo objeto XMLHttpRequest para realizar la petición AJAX
        var xhr = new XMLHttpRequest();
        
        // Paso 3: Configurar la petición como POST
        xhr.open("POST", "index.php?controller=materiales&action=deshabilitar&id=" + codigo, true);
        
        // Paso 4: Establecer el tipo de contenido que se enviará en la petición
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Paso 5: Definir lo que sucederá cuando la petición cambie de estado
        xhr.onreadystatechange = function () {
            // Verificar que la petición ha sido completada y ha sido exitosa (estado 200)
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                // Paso 6: Analizar la respuesta JSON del servidor
                var response = JSON.parse(xhr.responseText);

                // Paso 7: Verificar si la respuesta del servidor indica éxito
                if (response.status === 'success') {
                    // Si la respuesta es exitosa, eliminar la fila correspondiente en la tabla del DOM
                    var row = button.closest('tr');
                    row.parentNode.removeChild(row);
                } else {
                    // Si hubo un error, mostrar un mensaje de error
                    alert("Error: " + response.message);
                }
            }
        };

        // Paso 8: Enviar la petición al servidor
        xhr.send();
    }
}




</script>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Materiales</h1>

    <div class="actions">
        <a href="index.php?controller=materiales&action=crearMaterial" class="edit-button">Crear</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código Material</th>
                <th>Nombre Material</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Materiales as $Material): ?>
                <tr>
                    <td><?php echo($Material['codigo_getty_material']); ?></td>
                    <td><?php echo($Material['texto_material']); ?></td>
                    <td>
                        <a href="index.php?controller=Materiales&action=mostrarFormulario&id=<?php echo $Material['codigo_getty_material']; ?>" class="edit-button">Editar</a>
                        <form onsubmit="return false;" style="display:inline-block;">
                            <button type="button" class="edit-button" onclick="deshabilitarmaterial('<?php echo $Material['codigo_getty_material']; ?>', this)">Deshabilitar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</body>
</html>
