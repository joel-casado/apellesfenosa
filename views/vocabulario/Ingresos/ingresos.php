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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/vocabulario/tabla_vocabulario.css">
</head>
<body>

<a href="index.php?controller=vocabulario&action=mostrarVocabulario" class="edit-button">Tornar</a>

<h1>Listado de Ingresos</h1>

<div class="actions">
    <form class="search-bar">
        <input type="text" id="q" placeholder="Cerca d'ingressos" onkeyup="search()">
    </form>
    <a href="index.php?controller=ingresos&action=crearIngreso" class="edit-button">Crear</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Codi Ingres</th>
                <th>Nom Ingres</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody id="the_table_body">
            <?php foreach ($ingresos as $ingreso): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingreso['id_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['texto_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="action-icons">
                        <a href="index.php?controller=ingresos&action=mostrarFormulario&id=<?php echo htmlspecialchars($ingreso['id_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?>" class="edit-button" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="index.php?controller=ingresos&action=<?php echo $ingreso['activo'] ? 'deshabilitar' : 'habilitar'; ?>&id=<?php echo htmlspecialchars($ingreso['id_forma_ingreso'], ENT_QUOTES, 'UTF-8'); ?>" method="post" class="inline-form" onsubmit="return confirm('Estàs segur de què vols <?php echo $ingreso['activo'] ? 'deshabilitar' : 'habilitar'; ?> aquest ingres?');">
                            <button type="submit" class="edit-button" title="<?php echo $ingreso['activo'] ? 'Deshabilitar' : 'Habilitar'; ?>">
                                <i class="fas fa-<?php echo $ingreso['activo'] ? 'times' : 'check'; ?>"></i>
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
