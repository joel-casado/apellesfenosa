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
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>

    <h1>Listado de Autores</h1>

    <div class="actions">
    <a href="index.php?controller=autores&action=crearAutores" class="edit-button">Crear</a>
    </div>
    <form class="search-bar">
        <input type="text" id="q" placeholder="Busca Autor" onkeyup="search()">
    </form>
    <table>
        <thead>
            <tr>
                <th>Código Autor</th>
                <th>Nombre Autor</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="the_table_body">
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?php echo($autor['codigo_autor']); ?></td>
                    <td><?php echo($autor['nombre_autor']); ?></td>
                    <td>
                        <a href="index.php?controller=autores&action=mostrarFormulario&id=<?php echo $autor['codigo_autor']; ?>" class="edit-button">Editar</a>
                        <?php if ($autor['activo']): ?>
                            <form action="index.php?controller=autores&action=deshabilitar&id=<?php echo $autor['codigo_autor']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este autor?');">
                                <button type="submit" id="deshabilitar">Deshabilitar</button>
                            </form>
                        <?php else: ?>
                            <form action="index.php?controller=autores&action=habilitar&id=<?php echo $autor['codigo_autor']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres habilitar este autor?');">
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
