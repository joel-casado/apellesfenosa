<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/exposiciones/ver_obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="logout-link">Cerrar sesión</a>
        
    </div>
    <h1>Exposició seleccionada</h1> 
    <?php
// Asegurémonos de que $id_exposicion tiene un valor
        if (!isset($id_exposicion) || empty($id_exposicion)) {
            echo "El ID de exposición no está definido o está vacío.";
            return; // Detener la ejecución si no se tiene el ID
        }
    ?>
   
    <a  href="index.php?controller=Exposiciones&action=anadirObra&id_exposicion=<?php echo $id_exposicion; ?>" class="btn btn-success">Afegir obra</a>
    <table>
        <thead>
            <tr>
                <th>Obra</th>
                <th>Número Registre</th>
                <th>Nom Objecte</th>
                <th>Títol</th>
                <th>Autor</th>
                <th>Datació</th>
                <th>Ubicació</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($obras)): ?>
                <?php foreach ($obras as $obra): ?>
                    <tr>>
                        <td><?php echo '<img src="https://www.museuapellesfenosa.cat/wp-content/uploads/2024/01/6.-Gran-tete-de-Paul-Eluard-1041x1536.jpg" alt="obra" width="100" height="150">'; ?></td>

                        <td><?php echo $obra["numero_registro"]; ?></td>
                        <td><?php echo $obra["nombre_objeto"]; ?></td>
                        <td><?php echo $obra['titulo']; ?></td>
                        <td><?php echo $obra['nombre_autor']; ?></td>
                        <td><?php echo $obra['nombre_datacion']; ?></td>
                        <td><?php echo $obra['ubicacion']; ?></td>
                        <td><?php echo $obra['texto_material']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No hay obras disponibles para esta exposición.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>