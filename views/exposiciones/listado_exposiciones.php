<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Exposiciones</title>
    <link rel="stylesheet" href="styles/exposiciones/listado_exposiciones.css">
</head>
<body>
    <div class="header">
        <a href="index.php?controller=Obras&action=verObras"><img src="images/login/logo.png" alt="Museu Apel·les Fenosa"></a>
        <a href="index.php?controller=Login&action=logout" class="create-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="create-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="create-button">Obras</a><br>
        <div class="crear-expo">
            <a href="index.php?controller=Exposiciones&action=crea_expo" class="create-button">Crear exposició</a>
        </div>
    </div>

    <div class="expo_box">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
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
                        <td><?php echo $expo['id_exposicion']; ?></td>
                        <td><?php echo $expo['exposicion']; ?></td>
                        <td><?php echo $expo['fecha_inicio_expo']; ?></td>
                        <td><?php echo $expo['fecha_fin_expo']; ?></td>
                        <td><?php echo $expo['tipo_exposicion']; ?></td>
                        <td><?php echo $expo['sitio_exposicion']; ?></td>
                        <td>
                            <a href="index.php?controller=Usuaris&action=editarUsuario&nombre=<?= $user['nombre_usuario']; ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?controller=Usuaris&action=eliminarUsuario&id=<?= $user['nombre_usuario']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
