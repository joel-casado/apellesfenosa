<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];  // Aquí $id es realmente el codigo_getty_tecnica
$tecnicaModel = new tecnicasModel($conn);
$tecnicas = $tecnicaModel->gettecnicaPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tècnica</title>
    <link rel="stylesheet" href="styles/vocabulario/formularioCrearVocabulario.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="index.php?controller=tecnicas&action=mostrartecnicas" class="edit-button">Tornar</a>

    <h1>Editar Tècnica</h1>

    <div class="expo_box">
        <form action="index.php?controller=tecnicas&action=actualizar" method="POST">
            <input type="hidden" name="codigo_getty_tecnica" value="<?php echo htmlspecialchars($tecnicas['codigo_getty_tecnica'], ENT_QUOTES, 'UTF-8'); ?>">

            <label for="codigo_getty_tecnica">Codi:</label>
            <input type="text" id="codigo_getty_tecnica" name="codigo_getty_tecnica" value="<?php echo htmlspecialchars($tecnicas['codigo_getty_tecnica'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <label for="texto_tecnica">Nom:</label>
            <input type="text" id="texto_tecnica" name="texto_tecnica" value="<?php echo htmlspecialchars($tecnicas['texto_tecnica'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <button type="submit">Actualitzar</button>
        </form>
    </div>
</div>

</body>
</html>