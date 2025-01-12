<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Restauración</title>
    <link rel="stylesheet" href="styles/restauraciones/restauraciones.css">
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
                    <form action="index.php?controller=Restauraciones&action=editarRestauracion" method="POST">
                    <input type="hidden" name="numero_registro" value="<?php echo $restauracion['numero_registro']; ?>">
                    <div class="input-group">
                        <label for="codigo_restauracion">Codi restauració/conservació</label>
                        <input type="text" name="codigo_restauracion" id="codigo_restauracion" required placeholder="Codi">
                    </div>
                    <div class="input-group">
                        <label for="fecha_inicio_restauracion">Data inici restauració</label>
                        <input type="date" name="fecha_inicio_restauracion" id="fecha_inicio_restauracion" required placeholder="Inici">
                    </div>
                    <div class="input-group" id="contraBox">
                        <label for="fecha_fin_restauracion">Data fi restauració</label> 
                        <input type="date" name="fecha_fin_restauracion" placeholder="Fí">
                    </div>
                    <div class="input-group">
                        <label for="comentario_restauracion">Comentari restauració</label>
                        <input type="text" name="comentario_restauracion" id="comentario_restauracion" required placeholder="Comentari">
                    </div>
                    <div class="input-group">
                        <label for="nombre_restaurador">Nom restaurador-conservador</label>
                        <input type="text" name="nombre_restaurador" id="nombre_restaurador" required placeholder="Nom restaurador">
                    </div>
                    <button type="submit" class="login-btn">Guardar Cambios</button>
                </form>
            </div>
            <div class="image_usuaris_box">
                <img src="images/prueb.jpg" alt="prueba">
            </div>
        </div>
    </div>
</body>
</html>
