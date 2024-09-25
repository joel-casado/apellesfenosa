<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
</head>
<body>
    <h1>Lista de Obras</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Número de Registro</th>
                <th>Nombre del Objeto</th>
                <th>Título</th>
                <th>Año de Inicio</th>
                <th>Año Final</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?php echo $obra['numero_registro']; ?></td>
                    <td><?php echo $obra['nombre_objeto']; ?></td>
                    <td><?php echo $obra['titulo']; ?></td>
                    <td><?php echo $obra['ano_inicio']; ?></td>
                    <td><?php echo $obra['ano_final']; ?></td>
                    <td><?php echo $obra['descripcion']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
