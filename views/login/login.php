<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sessió</title>
    <link rel="stylesheet" href="styles/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="LogoMuseu Apel·les Fenosa">
    </div>
    <div class="container">
        <div class="login-box">
            <div class="form-container">
                <?php if (!empty($error_message)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?controller=Login&action=login" method="post" class="signin-form">
                    <div class="input-group">
                        <label for="username">Usuari</label>
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Usuari" required>
                    </div>
                    <div class="input-group" id="contraBox">
                        <label for="password">Contrasenya</label>
                        <i class="fas fa-lock"></i> 
                        <input type="password" name="password" id="password" placeholder="Contrasenya" required>
                    </div>
                    <button type="submit" class="login-btn">Inicia Sessió</button>
                </form>
            </div>
            <div class="image-container">
                <img src="images/login/metamorphose.jpg" alt="Statue">
            </div>
        </div>
    </div>

</body>
</html>
