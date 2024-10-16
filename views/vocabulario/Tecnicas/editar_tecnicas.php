<?php
require_once "../../../models/database.php";
require_once "../../../models/tecnicasModel.php";
require_once "../../../controllers/tecnicasController.php";

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_getty_tecnica
$tecnicaModel = new tecnicaModel($conn);
$tecnicas = $tecnicaModel->gettecnicaPorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tecnica</title>
    <link rel="stylesheet" href="../../styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../../views/obras/obras.php">a</a>
    <h1>Editar tecnica</h1>


    <form action="../../../index.php?controller=tecnicas&action=actualizar" method="POST">

        <input type="hidden" name="codigo_getty_tecnica" value="<?php echo $tecnicas['codigo_getty_tecnica']; ?>">
        
        

        <label for="codigo_getty_tecnica">Codigo:</label>
        <input type="text" id="codigo_getty_tecnica" name="codigo_getty_tecnica" value="<?php echo $tecnicas['codigo_getty_tecnica']; ?>" required>
        
        <label for="texto_tecnica">Nombre:</label>
        <input type="text" id="texto_tecnica" name="texto_tecnica" value="<?php echo $tecnicas['texto_tecnica']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>