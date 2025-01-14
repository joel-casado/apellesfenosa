<?php
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
<?php include 'views/header/sidebar_header.php'; ?>
<div class="sidebar">
    <ul class="menu">
        <li><a href="index.php?controller=Obras&action=verObras"><i class="fas fa-palette"></i> <span>Obres</span></a></li>
        <li><a href="index.php?controller=vocabulario&action=mostrarVocabulario"><i class="fas fa-book"></i> <span>Vocabulari</span></a></li>
        <li><a href="index.php?controller=Exposiciones&action=listado_exposiciones"><i class="fas fa-university"></i> <span>Exposicions</span></a></li>
        <li><a href="index.php?controller=Ubicacion&action=verArbol"><i class="fas fa-map-marker-alt"></i> <span>Ubicacions</span></a></li>
        <li><a href="index.php?controller=usuaris&action=listar_usuarios"><i class="fa-solid fa-user"></i> <span>Usuaris</span></a></li>
        <li><a href="index.php?controller=Backup&action=createBackup"><i class="fa-solid fa-file"></i> <span>Backup</span></a></li>
        <li><a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras"><i class="fa-regular fa-file-pdf"></i><span>Llibre-registre</span></a></li>
        <li><a href="index.php?controller=Login&action=logout"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a></li>
        
    </ul>
    <div class="toggle-btn">
        <i class="fas fa-angle-double-right"></i>
    </div>
</div>

<div class="content">
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>

<div class="button-bar">
    <?php if (isset($rol) && ($rol == 'admin' || $rol == 'tecnic')): ?>
        <a href="index.php?controller=Obras&action=crear">Crear</a>
    <?php endif; ?>
    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $obra['numero_registro']; ?>">Fitxa Bàsica</a>
    <a href="index.php?controller=Obras&action=mostrarFichaGeneral&id=<?php echo $obra['numero_registro']; ?>">Fitxa General</a>
    <a href="index.php?controller=Restauraciones&action=restauraciones&id=<?php echo $obra['numero_registro']; ?>">Restauracions</a>
    <a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Tornar</a>
</div>

<h1>Donar de Baixa Obra "<?php echo $obra['titulo']; ?>"</h1>


<div class="grid-container">

<form action="index.php?controller=Baixa&action=procesarBaja" method="POST">
    <?php if (!empty($imagen_url)): ?>
            <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>" style="width: 100px; height: auto;">
        <?php else: ?>
            <img src="images/login/default.png" alt="Sin imagen disponible" style="width: 100px; height: auto;">
        <?php endif; ?>
    <label for="baja">Baixa:</label>
    <input type="text" id="baja" name="baja" required>

    <label for="causa_baja">Causa de Baixa:</label>
    <textarea id="causa_baja" name="causa_baja" required></textarea>

    <label for="persona_autorizada">Persona autoritzada Baixa:</label>
    <input type="text" id="persona_autorizada" name="persona_autorizada" required>

    <label for="fecha">Data Baixa:</label>
    <input type="date" id="fecha" name="fecha" required>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($obra['numero_registro']); ?>">
    
    <button type="submit">Dar de Baja</button>
    </div>
</form>

