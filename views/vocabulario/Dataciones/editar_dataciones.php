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
    <title>Editar Datación</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Editar Datación</h1>
    <div class="editar">
        <form action="index.php?controller=dataciones&action=actualizar" method="POST">
            <input type="hidden" name="id_datacion" value="<?php echo $datacion['id_datacion']; ?>">

            <label for="nombre_datacion">Nombre:</label>
            <input type="text" id="nombre_datacion" name="nombre_datacion" value="<?php echo $datacion['nombre_datacion']; ?>" required>

            <label for="ano_inicio">Año Inicio:</label>
            <input type="number" id="ano_inicio" name="ano_inicio" value="<?php echo $datacion['ano_inicio']; ?>" required>

            <label for="ano_final">Año Final:</label>
            <input type="number" id="ano_final" name="ano_final" value="<?php echo $datacion['ano_final']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
