<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuari</title>
    <link rel="stylesheet" href="styles/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="container">
        <div class="login-box">
            <div class="form-container">
                <?php if (!empty($errorMessage)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>
                <form action="index.php?controller=Usuaris&action=updateUser" method="POST">
                    <div class="input-group">
                        <label for="username">Usuari</label>
                        <i class="fas fa-user"></i>
                        <input type="hidden" name="nombre_original" value="<?= $user['nombre_usuario']; ?>"> <!--atencion-->
                        <input type="text" name="name" value="<?= $user['nombre_usuario']; ?>" required placeholder="Nom d'usuari">
                    </div>
                    <div class="input-group">
                        <label for="rol">Rol</label>
                        <i class="fa-solid fa-star"></i>
                        <select id="rol" name="rol">
                            <option value="convidat" <?= $user['rol_usuario'] == 'convidat' ? 'selected' : '' ?>>Convidat</option>
                            <option value="tecnic" <?= $user['rol_usuario'] == 'tecnic' ? 'selected' : '' ?>>Tècnic</option>
                            <option value="admin" <?= $user['rol_usuario'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </div>
                    <div class="input-group" id="contraBox">
                        <label for="password">Nova contrasenya (opcional)</label>
                        <i class="fas fa-lock"></i> 
                        <input type="password" name="password" id="password" placeholder="Deixeu en blanc per a no canviar">
                    </div>
                    <div class="input-group">
                        <label for="rol">Estatus</label>
                        <i class="fa-solid fa-star"></i>
                        <select name="activo">
                            <option value="activo" <?= $user['estado'] == 'activo' ? 'selected' : '' ?>>Actiu</option>
                            <option value="inactivo" <?= $user['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactiu</option>
                        </select>
                    </div>
                    <button type="submit" class="login-btn">Guardar Canvis</button>
                </form>
            </div>
            <div class="image_usuaris_box">
                <img src="images/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Petite Tete de Jean Cocteau">
            </div>
        </div>
    </div>

</body>
</html>