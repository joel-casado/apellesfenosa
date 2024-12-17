<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Restauració</title>
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
                        <label for="username">Codi restauració/conservació</label>
                        <input type="text" name="name" id="username" required placeholder="Codi">
                    </div>
                    <div class="input-group">
                        <label for="rol">Data inici restauració</label>
                        <input type="date" name="name" id="username" required placeholder="Inici">
                    </div>
                    <div class="input-group" id="contraBox">
                        <label for="password">Data fi restauració</label> 
                        <input type="date" name="password" required placeholder="Fí">
                    </div>
                    <div class="input-group">
                        <label for="username">Comentari restauració</label>
                        <input type="text" name="name" id="username" required placeholder="Comentari">
                    </div>
                    <div class="input-group">
                        <label for="username">Nom restaurador-conservador</label>
                        <input type="text" name="name" id="username" required placeholder="Nom restaurador">
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
