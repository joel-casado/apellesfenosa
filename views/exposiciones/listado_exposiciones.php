<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Llistat de Exposicions</title>
    <link rel="stylesheet" href="styles/exposiciones/listado_exposiciones.css">
</head>
<body>
    <div class="header">
        <img src="views/obras/Logo2.png" alt="Logo">
        <!-- Contenedor para el botón de crear usuario -->
        <div class="crear-expo">
            <a href="index.php?controller=Exposiciones&action=crea_expo" class="btn btn-success">Crear exposició</a>
        </div>
    </div>

    <div class="expo_box">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Exposició</th>
                    <th>Data Inici</th>
                    <th>Data Fi</th>
                    <th>Tipus</th>
                    <th>Lloc</th>
                    <th class="acciones-header">Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exposiciones as $expo): ?>
                    <tr>
                        
                        <td><?php echo $expo['exposicion']; ?></td>
                        <td><?php echo $expo['fecha_inicio_expo']; ?></td>
                        <td><?php echo $expo['fecha_fin_expo']; ?></td>
                        <td><?php echo $expo['tipo_exposicion']; ?></td>
                        <td><?php echo $expo['sitio_exposicion']; ?></td>
                        
                        <td>
                            <a href="index.php?controller=Exposiciones&action=editar_expo&id=<?= $expo['id_exposicion']; ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?controller=Exposiciones&action=ver_obras&id=<?= $expo['id_exposicion']; ?>" class="btn btn-primary">Ver</a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
