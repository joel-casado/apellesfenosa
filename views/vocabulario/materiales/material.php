<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/vocabulario/material.css">
</head>
<body>

<a href="index.php?controller=vocabulario&action=mostrarVocabulario" class="edit-button">Tornar</a>

<h1>Llistat de Materials</h1>

<div class="actions">
    <form class="search-bar">
        <input type="text" id="q" placeholder="Cerca de materials" onkeyup="search()">
    </form>
    <a href="index.php?controller=materiales&action=crearMaterial" class="edit-button">Crear</a>
</div>

<div class="table-container">
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
                    <td class="action-icons">
                        <a href="index.php?controller=Materiales&action=mostrarFormulario&id=<?php echo htmlspecialchars($Material['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>" class="edit-button" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="index.php?controller=materiales&action=<?php echo $Material['activo'] ? 'deshabilitar' : 'habilitar'; ?>&id=<?php echo htmlspecialchars($Material['codigo_getty_material'], ENT_QUOTES, 'UTF-8'); ?>" method="post" class="inline-form" onsubmit="return confirm('Estàs segur de què vols <?php echo $Material['activo'] ? 'deshabilitar' : 'habilitar'; ?> aquesta datació?');">
                            <button type="submit" class="edit-button" title="<?php echo $Material['activo'] ? 'Deshabilitar' : 'Habilitar'; ?>">
                                <i class="fas fa-<?php echo $Material['activo'] ? 'times' : 'check'; ?>"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="scripts/busqueda.js"></script>
</body>
</html>