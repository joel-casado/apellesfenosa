<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el id_forma_ingreso
$ingresoModel = new ingresoModel($conn);
$ingresos = $ingresoModel->getingresoPorId($id);
 
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ingreso</title>
    <link rel="stylesheet" href="styles/materiales/materiales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../../views/obras/obras.php">a</a>
    <h1>Editar ingreso</h1>

    <div class="editar">
        <form action="index.php?controller=ingresos&action=actualizar" method="POST">

            <input type="hidden" name="id_forma_ingreso" value="<?php echo $ingresos['id_forma_ingreso']; ?>">
            
            

            <label for="id_forma_ingreso">Codigo:</label>
            <input type="text" id="id_forma_ingreso" name="id_forma_ingreso" value="<?php echo $ingresos['id_forma_ingreso']; ?>" required>
            
            <label for="texto_forma_ingreso">Nombre:</label>
            <input type="text" id="texto_forma_ingreso" name="texto_forma_ingreso" value="<?php echo $ingresos['texto_forma_ingreso']; ?>" required>

            <button type="submit">actualizar</button>
        </form>
    </div>
</body>
</html>