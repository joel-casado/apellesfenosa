<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_autor
$AutoresModel = new AutoresModel($conn);
$autores = $AutoresModel->getAutorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="../../styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../../views/obras/obras.php">a</a>
    <h1>Editar Autor</h1>


    <form action="index.php?controller=Autores&action=actualizar" method="POST">

        <input type="hidden" name="codigo_autor" value="<?php echo $autores['codigo_autor']; ?>">
        
        

        <label for="codigo_autor">Codigo:</label>
        <input type="text" id="codigo_autor" name="codigo_autor" value="<?php echo $autores['codigo_autor']; ?>" required>
        
        <label for="nombre_autor">Nombre:</label>
        <input type="text" id="nombre_autor" name="nombre_autor" value="<?php echo $autores['nombre_autor']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>