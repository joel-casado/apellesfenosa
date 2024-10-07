<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="views/variables/usuaris.css">
    <div class="header">
        <img src="views/general/imagenes/Logo.png" alt="Logo">
    </div>
</head>
<body>

    <div class="usuaris_box">
        
        
        <form action="index.php?controller=Usuaris&action=createUser" method="POST">
            <input type="text" name="name" required placeholder="Nombre de usuario">
            <select id="roles" name="roles">
                <div class="usurol">
                    <option value="seleccion_rol"></option>
                    <option value="usuari_cpnvidat">Convidat</option>
                    <option value="usuari_tecnic">Tècnic</option>
                    <option value="usuari_admin">Administrador</option>
                </div>
            </selct>
            <input type="password" name="password" required placeholder="Contraseña">
            
            <button type="submit">Crear</button>
        </form>
        <div class="image_usuaris_box">
            <img src="views/general/imagenes/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Statue">
        </div>

    </div>
</body>
</html>
