<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_getty_material
$materialModel = new MaterialModel($conn);
$materiales = $materialModel->getMaterialPorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Material</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="/views/obras/obras.php">a</a>
    <h1>Editar Material</h1>

    <div class="editar">
        <form action="index.php?controller=Materiales&action=actualizar" method="POST">

            <input type="hidden" name="codigo_getty_material" value="<?php echo $materiales['codigo_getty_material']; ?>">
            
            

            <label for="codigo_getty_material">Codigo:</label>
            <input type="text" id="codigo_getty_material" name="codigo_getty_material" value="<?php echo $materiales['codigo_getty_material']; ?>" required>
            
            <label for="texto_material">Nombre:</label>
            <input type="text" id="texto_material" name="texto_material" value="<?php echo $materiales['texto_material']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>