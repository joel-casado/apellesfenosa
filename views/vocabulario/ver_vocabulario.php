<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocabulari</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/vocabulario/ver_vocabulario.css">
    <link rel="stylesheet" href="styles/header/sidebar_header.css">
</head>
<body>
    <?php include 'views/header/sidebar_header.php'; ?>
    <table>
        <thead>
            <tr>
                <th>Tipus</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Materials</td>
                <td><a href="index.php?controller=materiales&action=mostrarMateriales" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
            <tr>
                <td>Autories</td>
                <td><a href="index.php?controller=autores&action=mostrarautores" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
            <tr>
                <td>Datacions</td>
                <td><a href="index.php?controller=dataciones&action=mostrardataciones" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
            <tr>
                <td>Classificacions genèriques</td>
                <td><a href="index.php?controller=clasificaciones&action=mostrarclasificaciones" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
            <tr>
                <td>Tècniques</td>
                <td><a href="index.php?controller=tecnicas&action=mostrartecnicas" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
            <tr>
                <td>Formes d'ingrés</td>
                <td><a href="index.php?controller=ingresos&action=mostraringresos" class="edit-button"><i class="fas fa-edit"></i> Editar</a></td>
            </tr>
        </tbody>
    </table>
    <script src="scripts/sidebar.js"></script>
</body>
</html>
