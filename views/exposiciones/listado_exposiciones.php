<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Llistat de Exposicions</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/exposiciones/listado_exposiciones.css">
</head>
<body>

<a href="index.php?controller=Obras&action=verObras" class="edit-button">Tornar</a>

<h1>Llistat de Exposicions</h1>

<div class="search-bar-container">
    <form class="search-bar">
        <input type="text" id="q" placeholder="Buscador de obra" onkeyup="search()">
    </form>
    <div class="crear-usuario">
        <a href="index.php?controller=Exposiciones&action=crea_expo" class="btn btn-success">Crear</a>
    </div>
</div>

<div class="usuaris_box">
    <table class="table">
        <thead>
            <tr> 
                <th>Nom</th>
                <th>Exposició</th>
                <th>Data d'inici</th>
                <th>Data de fi</th>
                <th>Tipus</th>
                <th>Lloc</th>
                <th class="acciones-header">Accions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exposiciones as $expo): ?>
                <tr>
                    <td><?php echo $expo['exposicion']; ?></td>
                    <td><?php echo $expo['id_exposicion']; ?></td>
                    <td><?php echo $expo['fecha_inicio_expo']; ?></td>
                    <td><?php echo $expo['fecha_fin_expo']; ?></td>
                    <td><?php echo $expo['tipo_exposicion']; ?></td>
                    <td><?php echo $expo['sitio_exposicion']; ?></td> 
                    <td class="acciones">
                        <div class="action-icons">
                            <a href="index.php?controller=Exposiciones&action=editar_expo&id=<?= $expo['id_exposicion']; ?>" class="i-button" title="Editar exposició">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=Exposiciones&action=ver_obras&id=<?= $expo['id_exposicion']; ?>" class="i-button" title="Afegir obra">
                                <i class="fas fa-plus"></i>
                            </a>
                            <form action="index.php?controller=Exposiciones&action=habilitarDeshabilitar&id=<?= $expo['id_exposicion']; ?>" method="post" class="inline-form" onsubmit="return confirm('Estàs segur de què vols habilitar/deshabilitar aquesta exposició?');">
                                <button type="submit" class="i-button" title="Habilitar/Deshabilitar">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>  
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="scripts/busqui.js"></script>
</body>
</html>
