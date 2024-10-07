<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museu Apel·les Fenosa</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
