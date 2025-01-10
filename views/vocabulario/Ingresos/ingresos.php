<?php

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$ingresoModel = new IngresoModel($conn);
$ingresos = $ingresoModel->getIngresos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="views/vocabulario/ver_vocabulario.php" class="edit-button">Vocabulario</a>

<h1>Listado de Ingresos</h1>

<div class="actions">
    <a href="index.php?controller=ingresos&action=crearIngreso" class="edit-button">Crear</a>
</div>
<form class="search-bar">
    <input type="text" id="q" placeholder="Busca Ingreso" onkeyup="search()">
</form>
<table>
    <thead>
        <tr>
            <th>Código Ingreso</th>
            <th>Nombre Ingreso</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody id="the_table_body">
        <?php foreach ($ingresos as $ingreso): ?>
            <tr>
                <td><?php echo($ingreso['id_forma_ingreso']); ?></td>
                <td><?php echo($ingreso['texto_forma_ingreso']); ?></td>
                <td>
                    <a href="index.php?controller=ingresos&action=mostrarFormulario&id=<?php echo $ingreso['id_forma_ingreso']; ?>" class="edit-button">Editar</a>
                    <?php if ($ingreso['activo']): ?>
                        <form action="index.php?controller=ingresos&action=deshabilitar&id=<?php echo $ingreso['id_forma_ingreso']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres deshabilitar este ingreso?');">
                            <button type="submit" id="deshabilitar">Deshabilitar</button>
                        </form>
                    <?php else: ?>
                        <form action="index.php?controller=ingresos&action=habilitar&id=<?php echo $ingreso['id_forma_ingreso']; ?>" method="post" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres habilitar este ingreso?');">
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
