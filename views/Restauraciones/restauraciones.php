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
        <a href="index.php?controller=Restauraciones&action=formularioCrearRestauracion&id=<?php echo $obra['numero_registro']; ?>" class="btn btn-success">Restauracions</a>
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
            <?php if (!empty($restauraciones) && is_array($restauraciones)): ?>
    <?php foreach ($restauraciones as $restauracion): ?>
        <tr>
            <td><?php echo $restauracion['codigo_restauracion']; ?></td>
            <td><?php echo $restauracion['fecha_inicio_restauracion']; ?></td>
            <td><?php echo $restauracion['fecha_fin_restauracion']; ?></td>
            <td><?php echo $restauracion['comentario_restauracion']; ?></td>
            <td><?php echo $restauracion['nombre_restaurador']; ?></td>
            <td>
                <a href="index.php?controller=Restauraciones&action=editar_restauracio&id=<?php echo $obra['numero_registro']; ?>" class="btn btn-primary">Editar restauració</a>
                <a href="index.php?controller=Restauraciones&action=ver_obras&id=<?php echo $obra['numero_registro']; ?>" class="btn btn-primary">Finalitzar restauració</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6" style="text-align: center;">No hay datos para mostrar.</td>
    </tr>
<?php endif; ?>

            </tbody>
        </table>
    </div>
    <script src="scripts/busqui.js"></script>
</body>
</html>
