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
        
        
    <form action="index.php?controller=Usuaris&action=createUser " method="POST">
        <input type="text" name="name" required placeholder="Nombre de usuario">
        <select id="roles" name="roles">
            <div class="usurol">
                <option value="seleccion_rol"></option>
                <option value="convidat">Convidat</option>
                <option value="tecnic">Tècnic</option>
                <option value="admin">Administrador</option>
            </div>
        </select>
        <input type="password" name="password" required placeholder="Contraseña">
        
        <button type="submit">Crear</button>
    </form>
        <div class="image_usuaris_box">
            <img src="images/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Statue">
        </div>

    </div>
</body>
</html>
