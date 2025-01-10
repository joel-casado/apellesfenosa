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

<h1>Llistat de Materials</h1>

<div class="actions">
    <a href="index.php?controller=materiales&action=crearMaterial" class="edit-button">Crear</a>
</div>
<form class="search-bar">
    <input type="text" id="q" placeholder="Busca Material" onkeyup="search()">
</form>
<table>
    <thead>
        <tr>
            <th>Codi Getty Material</th>
            <th>Text Material</th>
            <th>Acció</th>
        </tr>
    </thead>
    <tbody id="the_table_body">
        <?php foreach ($materiales as $Material): ?>
            <tr>
                <td><?php echo htmlspecialchars($Material['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($Material['texto_material'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="index.php?controller=Materiales&action=mostrarFormulario&id=<?php echo htmlspecialchars($Material['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>" class="edit-button">Editar</a>
                    <form action="index.php?controller=materiales&action=<?php echo $Material['activo'] ? 'deshabilitar' : 'habilitar'; ?>&id=<?php echo htmlspecialchars($Material['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>" method="post" class="inline-form" onsubmit="return confirm('¿Estás seguro de que quieres <?php echo $Material['activo'] ? 'deshabilitar' : 'habilitar'; ?> este material?');">
                        <button type="submit" class="edit-button"><?php echo $Material['activo'] ? 'Deshabilitar' : 'Habilitar'; ?></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script src="scripts/busqueda.js"></script>
</body>
</html>