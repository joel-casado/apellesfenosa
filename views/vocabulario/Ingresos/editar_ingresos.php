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
    <title>Editar Forma d'Ingres</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=ingresos&action=mostraringresos" class="edit-button">Tornar</a>

    <h1>Editar Forma d'Ingres</h1>

    <div class="expo_box">
        <form action="index.php?controller=ingresos&action=actualizar" method="POST">
            <input type="hidden" name="id_forma_ingreso" value="<?php echo htmlspecialchars($ingresos['id_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="id_forma_ingreso">Codi:</label>
            <input type="text" id="id_forma_ingreso" name="id_forma_ingreso" value="<?php echo htmlspecialchars($ingresos['id_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="texto_forma_ingreso">Nom:</label>
            <input type="text" id="texto_forma_ingreso" name="texto_forma_ingreso" value="<?php echo htmlspecialchars($ingresos['texto_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>