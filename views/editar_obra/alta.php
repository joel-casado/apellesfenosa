<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 
$id = $_GET['id'];
$obraModel = new ObrasModel($conn);
$obra = $obraModel->obtenerObra($id);
$imagen_url = $obraModel->obtenerImagen($obra['numero_registro']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
    <link rel="stylesheet" href="styles/baixa/baixa.css">
    <link rel="stylesheet" href="styles/header/sidebar_header.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="button-bar">
    <?php if (isset($rol) && ($rol == 'admin' || $rol == 'tecnic')): ?>
        <a href="index.php?controller=Obras&action=crear">Crear</a>
    <?php endif; ?>
    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $obra['numero_registro']; ?>">Fitxa Bàsica</a>
    <a href="index.php?controller=Obras&action=mostrarFichaGeneral&id=<?php echo $obra['numero_registro']; ?>">Fitxa General</a>
    <a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Tornar</a>
</div>

<h1>Donar de alta Obra "<?php echo $obra['titulo']; ?>"</h1>


<div class="grid-container">

<form action="index.php?controller=Baixa&action=darAlta" method="POST">
    <?php if (!empty($imagen_url)): ?>
            <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>" style="width: 100px; height: auto;">
        <?php else: ?>
            <img src="images/login/default.png" alt="Sin imagen disponible" style="width: 100px; height: auto;">
        <?php endif; ?>
    <label for="alta">alta:</label>
    <input type="text" id="alta" name="alta" required>

    <label for="causa_alta">Causa de alta:</label>
    <textarea id="causa_alta" name="causa_alta" required></textarea>

    <label for="persona_autorizada">Persona autoritzada alta:</label>
    <input type="text" id="persona_autorizada" name="persona_autorizada" required>

    <label for="fecha">Data alta:</label>
    <input type="date" id="fecha" name="fecha" required>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($obra['numero_registro']); ?>">
    
    <button type="submit">Dar de alta</button>
    </div>
</form>

