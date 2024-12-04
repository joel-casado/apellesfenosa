<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuari</title>
    <link rel="stylesheet" href="styles/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="LogoMuseu Apel·les Fenosa">
    </div>
    <div class="container">
        <div class="login-box">
            <div class="form-container">
                <?php if (!empty($errorMessage)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>
                <form action="index.php?controller=Usuaris&action=createUser" method="POST" onsubmit="return validarFormulario()">
                    <div class="input-group">
                        <label for="username">Usuari</label>
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" id="username" required placeholder="Nom d'usuari">
                    </div>
                    <div class="input-group">
                        <label for="rol">Rol</label>
                        <i class="fa-solid fa-star"></i>
                        <select id="rol" name="rol">
                        <option value="convidat">Convidat</option>
                        <option value="tecnic">Tècnic</option>
                        <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div class="input-group" id="contraBox">
                        <label for="password">Contrasenya</label>
                        <i class="fas fa-lock"></i> 
                        <input type="password" name="password" required placeholder="Contrasenya">
                    </div>
                    <button type="submit" class="login-btn">Crear</button>
                </form>
            </div>
            <div class="image_usuaris_box">
                <img src="images/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Petite Tete de Jean Cocteau">
            </div>
        </div>
    </div>

</body>
</html>
