<?php

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$MaterialModel = new MaterialModel($conn);
$Materiales = $MaterialModel->getMateriales();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="header">
    <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
    <a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
    <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a><br>
</div>

<h1>Listado de Materiales</h1>

<div class="actions">
    <a href="index.php?controller=materiales&action=crearMaterial" class="edit-button">Crear</a>
</div>
<form class="search-bar">
    <input type="text" id="q" placeholder="Busca Material" onkeyup="search()">
</form>
<table>
    <thead>
        <tr>
            <th>Código Getty Material</th>
            <th>Texto Material</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody id="the_table_body">
        <?php foreach ($Materiales as $Material): ?>
            <tr>
                <td><?php echo($Material['codigo_getty_material']); ?></td>
                <td><?php echo($Material['texto_material']); ?></td>
                <td>
                    <a href="index.php?controller=Materiales&action=mostrarFormulario&id=<?php echo $Material['codigo_getty_material']; ?>" class="edit-button">Editar</a>
                    <?php if ($Material['activo']): ?>
                        <form action="index.php?controller=materiales&action=deshabilitar&id=<?php echo $Material['codigo_getty_material']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este material?');">
                            <button type="submit" id="deshabilitar">Deshabilitar</button>
                        </form>
                    <?php else: ?>
                        <form action="index.php?controller=materiales&action=habilitar&id=<?php echo $Material['codigo_getty_material']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres habilitar este material?');">
                            <button type="submit" id="habilitar">Habilitar</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script src="scripts/busqueda.js"></script>
</body>
</html>
