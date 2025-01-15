<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuaris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles/usuarios/listado_usuarios.css">
</head>
<body>

    <div class="search-bar-container">
        <form class="search-bar">
            <i class="fa fa-search"></i>
            <input type="text" id="q" placeholder="Buscador d'usuaris" onkeyup="search()">
        </form>
    </div>

    
    <div class="crear-usuario">
        <a href="index.php?controller=Usuaris&action=formularioCrearUsuario" class="btn btn-success">Crear Usuari</a>
    </div>

    <div class="usuaris_box">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom d'Usuari</th>
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
                    <td><?= $user['estado'] == 'activo' ? 'Activo' : 'Inactivo'; ?></td>
                    <td class="acciones">
                        <a href="index.php?controller=Usuaris&action=editarUsuario&nombre=<?= $user['nombre_usuario']; ?>" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="scripts/busqui.js"></script>
</body>
</html>
