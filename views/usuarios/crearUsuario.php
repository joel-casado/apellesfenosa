<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="styles/usuarios/usuaris.css">
</head>
<body>
    <div class="header">
        <img src="views/obras/Logo2.png" alt="Logo">
    </div>

    <div class="usuaris_box">
        <form action="index.php?controller=Usuaris&action=createUser" method="POST" onsubmit="return validarFormulario()">
            <input type="text" name="name" id="username" required placeholder="Nombre de usuario">
            <span id="username-error" style="color: red;"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
            <select id="roles" name="roles">
                <option value="convidat">Convidat</option>
                <option value="tecnic">Tècnic</option>
                <option value="admin">Administrador</option>
            </select>
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit">Crear</button>
        </form>
        <div class="image_usuaris_box">
            <img src="images/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Statue">
        </div>
    </div>

    <script src="path/to/usuaris.js"></script>
</body>
</html>
