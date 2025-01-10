<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$tecnicaModel = new TecnicasModel($conn);
$Tecnicas = $tecnicaModel->getTecnicas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnicas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>
<h1>Listado de Técnicas</h1>

<div class="actions">
    <a href="index.php?controller=tecnicas&action=crearTecnica" class="edit-button">Crear</a>
</div>
<form class="search-bar">
    <input type="text" id="q" placeholder="Busca Técnica" onkeyup="search()">
</form>
<table>
    <thead>
        <tr>
            <th>Código Getty Técnica</th>
            <th>Texto Técnica</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody id="the_table_body">
        <?php foreach ($Tecnicas as $tecnica): ?>
            <tr>
                <td><?php echo($tecnica['codigo_getty_tecnica']); ?></td>
                <td><?php echo($tecnica['texto_tecnica']); ?></td>
                <td>
                    <a href="index.php?controller=tecnicas&action=mostrarFormulario&id=<?php echo $tecnica['codigo_getty_tecnica']; ?>" class="edit-button">Editar</a>
                    <?php if ($tecnica['activo']): ?>
                        <form action="index.php?controller=tecnicas&action=deshabilitar&id=<?php echo $tecnica['codigo_getty_tecnica']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar esta técnica?');">
                            <button type="submit" id="deshabilitar">Deshabilitar</button>
                        </form>
                    <?php else: ?>
                        <form action="index.php?controller=tecnicas&action=habilitar&id=<?php echo $tecnica['codigo_getty_tecnica']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres habilitar esta técnica?');">
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
