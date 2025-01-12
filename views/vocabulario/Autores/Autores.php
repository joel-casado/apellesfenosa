<?php

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$AutoresModel = new AutoresModel($conn);
$autores = $AutoresModel->getAutores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/vocabulario/material.css">
</head>
<body>

<a href="index.php?controller=vocabulario&action=mostrarVocabulario" class="edit-button">Tornar</a>

<h1>Llistat d'Autors</h1>

<div class="actions">
    <form class="search-bar">
        <input type="text" id="q" placeholder="Cerca d'autors" onkeyup="search()">
    </form>
    <a href="index.php?controller=autores&action=crearAutores" class="edit-button">Crear</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Codi Autor</th>
                <th>Nom Autor</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody id="the_table_body">
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($autor['codigo_autor'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($autor['nombre_autor'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="action-icons">
                        <a href="index.php?controller=autores&action=mostrarFormulario&id=<?php echo htmlspecialchars($autor['codigo_autor'], ENT_QUOTES, 'UTF-8'); ?>" class="edit-button" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="index.php?controller=autores&action=<?php echo $autor['activo'] ? 'deshabilitar' : 'habilitar'; ?>&id=<?php echo htmlspecialchars($autor['codigo_autor'], ENT_QUOTES, 'UTF-8'); ?>" method="post" class="inline-form" onsubmit="return confirm('Estàs segur de què vols <?php echo $autor['activo'] ? 'deshabilitar' : 'habilitar'; ?> aquest autor?');">
                            <button type="submit" class="edit-button" title="<?php echo $autor['activo'] ? 'Deshabilitar' : 'Habilitar'; ?>">
                                <i class="fas fa-<?php echo $autor['activo'] ? 'times' : 'check'; ?>"></i>
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
