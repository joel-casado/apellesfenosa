<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/exposiciones/anadirObra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
    
<body>
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>
    <h1>Llistat d'obres</h1>
    <form method="POST" action="index.php?controller=Exposiciones&action=anadirObra">
        <input type="hidden" name="id_exposicion" value="<?php echo $id_exposicion; ?>">
        <table>
            <thead>
                <tr>
                    <th>Selecciona</th>
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
                <?php
                    // Asegúrate de que $id_exposicion esté definido
                    if (!isset($id_exposicion)) {
                        $id_exposicion = ''; // O un valor por defecto
                    }
                ?>
                <?php if (!empty($obras)): ?>
                    
                    <?php foreach ($obras as $obra): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="checkbox-obra" name="exposicion_ids[]" value="<?php echo $obra['numero_registro']; ?>">
                            </td>
                            <td>
                                <img src="https://www.museuapellesfenosa.cat/wp-content/uploads/2024/01/6.-Gran-tete-de-Paul-Eluard-1041x1536.jpg" style="max-width: 100px; height: auto;">
                            </td>
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
        <button type="submit" class="btn btn-success">Añadir</button>
    </form>

</body>
</html>