<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="views/general/general.css">
</head>
<body>
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>
    <div class="container">
        <div class="login-box">
            <div class="form-container">
                <form action="index.php?controller=Login&action=login" method="post" class="signin-form"> <!-- Enlace de envío del formulario -->
                    <div class="input-group">
                        <label for="username">Usuari</label>
                        <i class="fas fa-user"></i> <!-- Icono del usuario -->
                        <input type="text" name="username" id="username" placeholder="Usuari" required>
                    </div>
                    <div class="input-group">
                        <label for="rol">Rol</label>
                        <input type="rol" name="rol" id="rol" placeholder="Rol" required>
                        <select id="rol" name="rol">
                        <option value="">Seleccione datació...</option>
                        <option value="segle IV ante ">Segle IV ante </option>
                        <option value="primera meita segle IV ante ">Primera meitat Segle IV ante..........-400....-301</option>
                    </div>
                    <div class="input-group">
                        <label for="password">Contrasenya</label>
                        <i class="fas fa-lock"></i> <!-- Ícono de candado -->
                        <input type="password" name="password" id="password" placeholder="Contrasenya" required>
                    </div>
                  
                    <button type="submit" class="login-btn">Inicia Sessió</button> <!-- Botón con funcionalidad PHP -->
                </form>
            </div>
            <div class="image-container">
                <img src="images/login/metamorphose.jpg" alt="Statue">
            </div>
        </div>
    </div>
</body>
</html>
