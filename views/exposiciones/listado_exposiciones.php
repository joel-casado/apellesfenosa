<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Llistat de Exposicions</title>
    <link rel="stylesheet" href="styles/usuarios/listado_usuarios.css">
</head>
<body>
    
    <div class="header">
        <img src="views/obras/Logo2.png" alt="Logo">
    </div>

    <div class="search-bar-container">
        <form class="search-bar">
            <i class="fa fa-search"></i>
            <input type="text" id="q" placeholder="Buscador de obra" onkeyup="search()">
        </form>
    </div>


    <div class="crear-usuario">
        <a href="index.php?controller=Usuaris&action=formularioCrearUsuario" class="btn btn-success">Exposició</a>
    </div>

    <div class="usuaris_box">
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
                        <td><?php echo $expo['id_exposicion']; ?></td>
                        <td><?php echo $expo['fecha_inicio_expo']; ?></td>
                        <td><?php echo $expo['fecha_fin_expo']; ?></td>
                        <td><?php echo $expo['tipo_exposicion']; ?></td>
                        <td><?php echo $expo['sitio_exposicion']; ?></td> 
                        <td class="acciones">
                            <a href="index.php?controller=Exposiciones&action=editar_expo&id=<?= $expo['id_exposicion']; ?>" class="btn btn-primary">Editar exposició</a>
                            <a href="index.php?controller=Exposiciones&action=ver_obras&id=<?= $expo['id_exposicion']; ?>" class="btn btn-primary">Afegir obra</a>
                        </td>  
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="scripts/busqui.js"></script>
</body>
</html>
