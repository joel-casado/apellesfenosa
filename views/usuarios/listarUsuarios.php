<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="styles/usuarios/listado_usuarios.css">
</head>
<body>
    <div class="header">
        <img src="views/obras/Logo2.png" alt="Logo">
        <!-- Contenedor para el botón de crear usuario -->
        <div class="crear-usuario">
            <a href="index.php?controller=Usuaris&action=formularioCrearUsuario" class="btn btn-success">Crear Usuario</a>
        </div>
    </div>

    <div class="usuaris_box">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de Usuari</th>
                    <th>Rol</th>
                    <th>Estat</th>
                    <th class="acciones-header">Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $user): ?>
                <tr>
                    <td><?= $user['nombre_usuario']; ?></td>
                    <td><?= $user['rol_usuario']; ?></td>
                    <td><?= $user['activo'] == 'activo' ? 'Activo' : 'Inactivo'; ?></td>
                    <td class="acciones">
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
