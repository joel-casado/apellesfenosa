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
    <title>Vocabulario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/obras/obras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>.actions {
  margin-right: 540px;
  margin-top: 100px;
  margin-bottom: 20px;
  display: flex;
  justify-content: flex-end; /* Alinea a la derecha */
  margin-bottom: -90px;
}</style>
<body>

    <div class="header">
        <img src="../../images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="../../index.php?controller=Login&action=logout" class="logout-link">Cerrar sesión</a>
        <a href="../../index.php?controller=Obras&action=verObras&admin" class="logout-link">Obras</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Materiales</td>
                    <td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=materiales&action=mostrarMateriales" class="edit-button">Editar</a></td>
                </tr>
                <tr><td>Autores</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=autores&action=mostrarautores" class="edit-button">Editar</a></td></tr>
                <tr><td>Dataciones</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=dataciones&action=mostrardataciones" class="edit-button">Editar</a></td></tr>
                <tr><td>Clasificaciones genericas</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=clasificaciones&action=mostrarclasificaciones" class="edit-button">Editar</a></td></tr>
                <tr><td>Exposiciones</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=Exposiciones&action=mostrarExposiciones" class="edit-button">Editar</a></td></tr>
                <tr><td>Prestamos</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=prestamos&action=mostrarprestamos" class="edit-button">Editar</a></td></tr>
                <tr><td>Tecnicas</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=tecnicas&action=mostrartecnicas" class="edit-button">Editar</a></td></tr>
                <tr><td>Ubicaciones</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=ubicaciones&action=mostrarubicaciones" class="edit-button">Editar</a></td></tr>
                <tr><td>Formas de ingreso</td><td><a href="/Crea%20una%20carpeta/apellesfenosa/index.php?controller=ingresos&action=mostraringresos" class="edit-button">Editar</a></td></tr>
                    

        </tbody>
    </table>
</body>
</html>