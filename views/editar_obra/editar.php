<?php
include "../../models/database.php";
include "../../models/EditModel.php";


$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];
$obraModel = new EditarController($conn);
$obra = $obraModel->obtenerObra($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/obras/obras.css">
</head>
<body>
    <h1>Editar Obra</h1>
    <form action="../controllers/EditarController.php" method="POST">
        <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>">
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" value="<?php echo $obra['autor']; ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $obra['descripcion']; ?></textarea>

        <button type="submit">Actualizar</button>
    </form>

    <a href="obras.php">Volver al listado</a>
</body>
</html>
