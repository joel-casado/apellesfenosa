<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restauracions</title>
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
        <a href="index.php?controller=Obras&action=formularioCrearRestauracion" class="btn btn-success">Restauracions</a>
    </div>

    <div class="usuaris_box">
        <table class="table">
            <thead>
                <tr> 
                    <th>Codi</th>
                    <th>Data Inici</th>
                    <th>Data Fí</th>
                    <th>Comentari</th>
                    <th>Nom resataurador</th>
                    <th class="acciones-header">Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restauraciones as $restauracion): ?>
                    <tr>
                       
                        <td><?php echo $expo['codigo_restauracion']; ?></td>
                        <td><?php echo $expo['fecha_inicio_restauracion']; ?></td>
                        <td><?php echo $expo['fecha_fin_restauracion']; ?></td>
                        <td><?php echo $expo['comentario_restauracion']; ?></td>
                        <td><?php echo $expo['nommbre_restauracion']; ?></td>
                        <td>
                            <a href="index.php?controller=Obras&action=editar_restauracio&id=<?= $restauracion['id_exposicion']; ?>" class="btn btn-primary">Editar restauració</a>
                            <a href="index.php?controller=Obras&action=ver_obras&id=<?= $restauracion['id_exposicion']; ?>" class="btn btn-primary">Finalitzar restauració</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="scripts/busqui.js"></script>
</body>
</html>
