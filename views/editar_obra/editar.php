<?php
require_once "../../models/database.php";
require_once "../../models/ObrasModel.php";
require_once "../../controllers/ObrasController.php";

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];
$obraModel = new ObrasModel($conn);
$obra = $obraModel->obtenerObra($id);
$autores = $obraModel->getAutores();
$clasificaciones_genericas = $obraModel->getClasificacionesGenericas();
$materiales = $obraModel->getMateriales();
$tecnicas = $obraModel->getTecnicas();
$anoInicio = $obraModel->getAnoInicio();
$anoFinal = $obraModel->getAnoFinal();
$formasIngreso = $obraModel->getFormasIngreso();
$estadosConservacion = $obraModel->getEstadosConservacion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/obras/obras.css">
</head>
<body>
    <a href="../../views/obras/obras.php" class="back-button">Volver a Obras</a>
    <h1>Editar Obra</h1>
    
    <img src="https://www.museuapellesfenosa.cat/wp-content/uploads/2024/01/6.-Gran-tete-de-Paul-Eluard-1041x1536.jpg"  style="height="150px" width="150px"">


    <form action="../../index.php?controller=Obras&action=actualizar" method="POST">

        <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>">
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required>

        <label for="titulo">Nº Registro:</label>
        <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" required>

        <select name="clasificaciones_generica" id="clasificaciones_generica">
            <option value="">Selecciona Clasificación</option>
            <input type="text" id="classificacion_generica" name="classificacion_generica" value="<?php echo $obra['classificacion_generica']; ?>">

        <label for="autor">Codigo Autor:</label>
        <input type="text" id="nombre_autor" name="nombre_autor" value="<?php echo $obra['autor']; ?>">




        <label for="coleccion_procedencia">Colección Procedencia:</label>
        <input type="text" id="coleccion_procedencia" name="coleccion_procedencia" value="<?php echo $obra['coleccion_procedencia']; ?>">
 
        <label for="maxima_altura">Máxima Altura:</label>
        <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>">

        <label for="maxima_anchura">Máxima Anchura:</label>
        <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>">

        <label for="maxima_profundidad">Máxima Profundidad:</label>
        <input type="text" id="maxima_profundidad" name="maxima_profundidad" value="<?php echo $obra['maxima_profundidad']; ?>">

        <label for="material">[Material] text (sense valor per defecte):</label>
        <input type="text" id="id_material" name="id_material" value="<?php echo $obra['material']; ?>">

        <label for="material">Nombre Material:</label>
        <input type="text" id="id_material" name="id_material" value="<?php echo $obra['material']; ?>">


        <label for="tecnica">Técnica:</label>
        <input type="text" id="tecnica" name="tecnica" value="<?php echo $obra['tecnica']; ?>">

        <label for="material">[Tècnica] text (sense valor per defecte)<label>
        

        <label for="ano_inicio">Año inicio:</label>
        <select name="ano_inicio" id="ano_inicio">
            <option value="">Año inicio</option>
            <?php foreach ($anoInicio as $inicio): ?>
                <option value="<?= $inicio['ano_inicio'] ?>" <?= $obra['ano_inicio'] == $inicio['ano_inicio'] ? 'selected' : '' ?>>
                    <?= $inicio['ano_inicio'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="ano_final">Año final:</label>
        <select name="ano_final" id="ano_final">
        <option value="">Fecha Final</option>
        <?php foreach ($anoFinal as $final): ?>
            <option value="<?= $final['ano_final'] ?>" <?= $obra['ano_final'] == $final['ano_final'] ? 'selected' : '' ?>>
                <?= $final['ano_final'] ?>
            </option>
        <?php endforeach; ?>
    </select>


        <label for="datacion">Datación:</label>
        <textarea id="datacion" name="datacion" required><?php echo $obra['datacion']; ?></textarea>
    
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>">

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>">

        <label for="numero_ejemplares">Número de Ejemplares:</label>
        <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>">

        <label for="forma_ingreso">Acabar Forma de Ingreso:</label>
        <input list="formas_ingreso" name="forma_ingreso" id="forma_ingreso" value="<?= $obra['forma_ingreso']; ?>">
        <datalist id="formas_ingreso">
            <?php foreach ($formasIngreso as $forma): ?>
                <option value="<?= $forma['texto_forma_ingreso'] ?>">
                    <?= $forma['texto_forma_ingreso'] ?>
                </option>
            <?php endforeach; ?>
        </datalist>



        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>">

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>">


        <label for="estado_conservacion">Estado de Conservación:</label>
        <input list="estados" name="estado" id="estado">
            <datalist id="estados">
                <option value="Bo">
                <option value="Dolent">
                <option value="Excel·lent">
                <option value="Indeterminat">
                <option value="desconeguda">
                <option value="Regular">
            </datalist>

        <label for="lugar_ejecucion">Lugar de Ejecución:</label>
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo $obra['lugar_ejecucion']; ?>">

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>">

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ" value="<?php echo $obra['valoracion_econ']; ?>">

        <label for="id_exposicion">ID de Exposición:</label>
        <input type="text" id="id_exposicion" name="id_exposicion" value="<?php echo $obra['id_exposicion']; ?>">

        <label for="id_exposicion">Tipus de Exposición:</label>
        <input type="text" id="id_exposicion" name="id_exposicion" value="<?php echo $obra['id_exposicion']; ?>">

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia"><?php echo $obra['bibliografia']; ?></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $obra['descripcion']; ?></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"><?php echo $obra['historia_obra']; ?></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"><?php echo $obra['historia_obra']; ?></textarea>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>