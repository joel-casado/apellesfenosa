<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuari</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/usuarios/crear_usuario.css">
</head>
<body>
    <div class="container">
        <a href="index.php?controller=Usuaris&action=listar_usuarios" class="edit-button">Tornar</a>
        <h1>Creació d'usuari</h1>
        <div class="user_box">
            <?php if (!empty($errorMessage)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
            <form action="index.php?controller=Usuaris&action=createUser" method="POST" onsubmit="return validarFormulario()">
                <label for="username">Usuari</label>
                <input type="text" name="name" id="username" required placeholder="Nom d'usuari">
                <label for="rol">Rol</label>
                <select id="rol" name="rol">
                    <option value="convidat">Convidat</option>
                    <option value="tecnic">Tècnic</option>
                    <option value="admin">Administrador</option>
                </select>
                <label for="password">Contrasenya</label>
                <input type="password" name="password" id="password" required placeholder="Contrasenya">
                <input type="hidden" name="activo" value="<?= 'activo'; ?>">
                <button type="submit">Crear usuari</button>
            </form>
            <div class="image_user_box">
                <img src="images/6.-Gran-tete-de-Paul-Eluard.jpg" alt="User">
            </div>
        </div>
    </div>
</body>
</html>
