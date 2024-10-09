<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['tecnic']) && !isset($_SESSION['convidat'])) {
    
    header("Location: index.php?controller=Login&action=verLogin");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>.actions {
  margin-right: 430px;
  margin-top: 100px;
  display: flex;
  justify-content: flex-end; /* Alinea a la derecha */
  margin-bottom: -90px;
}</style>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="logout-link">Cerrar sesión</a>
    </div>

    <div class="actions">
        <a href="views/crear_obra/crear.php?id=" class="edit-button">Crear</a>
    </div>
    
    <table>
        <thead>
            <tr>
               
                <th></th>
                <th>Número Registre</th>
                <th>Nom Objecte</th>
                <th>Títol</th>
                <th>Autor</th>
                <th>Datació</th>
                <th>Ubicació</th>
                <th>Material</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo '<img src="https://www.museuapellesfenosa.cat/wp-content/uploads/2024/01/6.-Gran-tete-de-Paul-Eluard-1041x1536.jpg" ">'; ?></td>
                    <td><?php echo $obra["numero_registro"]; ?></td>
                    <td><?php echo $obra["nombre_objeto"]; ?></td>
                    <td><?php echo $obra['titulo']; ?></td>
                    <td><?php echo $obra['nombre_autor']; ?></td>
                    <td><?php echo $obra['nombre_datacion']; ?></td>
                    <td><?php echo $obra['ubicacion']; ?></td>
                    <td><?php echo $obra['texto_material']; ?></td>
                    <td><a href="views/editar_obra/editar.php?id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Editar</a>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>