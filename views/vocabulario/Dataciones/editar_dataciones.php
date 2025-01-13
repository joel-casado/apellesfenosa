<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  
$datacionesModel = new DatacionesModel($conn);
$datacion = $datacionesModel->getDatacionId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datació</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=dataciones&action=mostrardataciones" class="edit-button">Tornar</a>

    <h1>Editar Datación</h1>

    <div class="expo_box">
        <form action="index.php?controller=dataciones&action=actualizar" method="POST">
            <input type="hidden" name="id_datacion" value="<?php echo htmlspecialchars($datacion['id_datacion'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="nombre_datacion">Nom:</label>
            <input type="text" id="nombre_datacion" name="nombre_datacion" value="<?php echo htmlspecialchars($datacion['nombre_datacion'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="ano_inicio">Any d'Inici:</label>
            <input type="number" id="ano_inicio" name="ano_inicio" value="<?php echo htmlspecialchars($datacion['ano_inicio'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="ano_final">Any Final:</label>
            <input type="number" id="ano_final" name="ano_final" value="<?php echo htmlspecialchars($datacion['ano_final'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>
