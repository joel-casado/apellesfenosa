<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];
$obraModel = new ObrasModel($conn);
$obra = $obraModel->obtenerObra($id);
$autores = $obraModel->getAutores();
$clasificaciones_genericas = $obraModel->getClasificacionesGenericas();
$materiales = $obraModel->getMateriales();
$tecnicas = $obraModel->getTecnicas();
$dataciones = $obraModel->getdatacion();
$anoInicio = $obraModel->getAnoInicio();
$anoFinal = $obraModel->getAnoFinal();
$formasIngreso = $obraModel->getFormasIngreso();
$estadosConservacion = $obraModel->getEstadosConservacion();
$exposiciones = $obraModel->getexposicion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../../views/obras/obras.php">a</a>
    <h1>Editar Obra</h1>
    
    <img src="https://www.museuapellesfenosa.cat/wp-content/uploads/2024/01/6.-Gran-tete-de-Paul-Eluard-1041x1536.jpg">


    <form action="index.php?controller=Obras&action=actualizar" method="POST">

        <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" readonly>

        <label for="titulo">Nº Registro:</label>
        <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

        
        <label>Clasificación Seleccionada:</label>
        <span>
            <?php 
            // Buscar la clasificación seleccionada
            $clasificacionSeleccionada = '';
            foreach ($clasificaciones_genericas as $clasificacion) {
                if ($obra['classificacion_generica'] == $clasificacion['id_clasificacion']) {
                    $clasificacionSeleccionada = $clasificacion['texto_clasificacion'];
                    break; // Salir del bucle una vez encontrada la clasificación
                }
            }
            ?>
            <input type="text" id="n_registro" name="n_registro" value="<?php echo $clasificacionSeleccionada ?>" readonly>
        </span>

        <label for="autor">Nombre Autor:</label>
        <span>
            <?php 
            $autorseleccionado = '';
            foreach ($autores as $autor){
                 if ($obra['autor'] == $autor['codigo_autor']) {
                    $autorseleccionado = $autor['nombre_autor'];
                    break;
                 }
            }
            ?>
            <input type="text" id="autor" name="autor" value="<?php echo $autorseleccionado ?>" readonly >
    
            </span>

        <label for="coleccion_procedencia">Colección Procedencia:</label>
        <input type="text" id="coleccion_procedencia" name="coleccion_procedencia" value="<?php echo $obra['coleccion_procedencia']; ?>" readonly>
 
        <label for="maxima_altura">Máxima Altura:</label>
        <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>" readonly>

        <label for="maxima_anchura">Máxima Anchura:</label>
        <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>" readonly>

        <label for="maxima_profundidad">Máxima Profundidad:</label>
        <input type="text" id="maxima_profundidad" name="maxima_profundidad" value="<?php echo $obra['maxima_profundidad']; ?>" readonly>

        <label for="material">Material:</label>
        <select name="codigo_getty_material" id="codigo_getty_material" required>
            <?php foreach ($materiales as $material): ?>
                <option value="<?= $material['codigo_getty_material'] ?>" <?= $obra['material'] == $material['codigo_getty_material'] ? 'selected' : '' ?>>
                    <?= $material['texto_material'] ?>
                </option>
            <?php endforeach; ?>
        </select>


        <label for="tecnica">Técnica:</label>
        <select name="tecnica" id="tecnica" required>
            <?php foreach ($tecnicas as $tecnica): ?>
                <option value="<?= $tecnica['codigo_getty_tecnica'] ?>" <?= $obra['tecnica'] == $tecnica['codigo_getty_tecnica'] ? 'selected' : '' ?>>
                    <?= $tecnica['texto_tecnica'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="ano_inicio">Año inicio:</label>
        <select name="ano_inicio" id="ano_inicio">
            <?php foreach ($anoInicio as $inicio): ?>
                <option value="<?= $inicio['ano_inicio'] ?>" <?= $obra['ano_inicio'] == $inicio['ano_inicio'] ? 'selected' : '' ?>>
                    <?= $inicio['ano_inicio'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="ano_final">Año final:</label>
        <select name="ano_final" id="ano_final">
        <?php foreach ($anoFinal as $final): ?>
            <option value="<?= $final['ano_final'] ?>" <?= $obra['ano_final'] == $final['ano_final'] ? 'selected' : '' ?>>
                <?= $final['ano_final'] ?>
            </option>
        <?php endforeach; ?>
    </select>


        <label for="datacion">Datación:</label>
        <select name="datacion" id="datacion">
        <?php foreach ($dataciones as $datacion): ?>
            <option value="<?= $datacion['id_datacion'] ?>" <?= $obra['datacion'] == $datacion['id_datacion'] ? 'selected' : '' ?>>
                <?= $datacion['nombre_datacion']  . ' / ' . $datacion['ano_inicio']  . ' / ' . $datacion['ano_final'] ?>
            </option>
        <?php endforeach; ?>
        </select>
    
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>" readonly>

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>" readonly>

        <label for="numero_ejemplares">Número de Ejemplares:</label>
        <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>" readonly>

        <label for="forma_ingreso">Forma de Ingreso:</label>
        <select name="forma_ingreso" id="forma_ingreso">
        <?php foreach ($formasIngreso as $forma_ingreso): ?>
            <option value="<?= $forma_ingreso['id_forma_ingreso'] ?>" <?= $obra['forma_ingreso'] == $forma_ingreso['id_forma_ingreso'] ? 'selected' : '' ?> >
                <?= $forma_ingreso['texto_forma_ingreso'] ?>
            </option>
        <?php endforeach; ?>
        </select>



        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>" readonly>

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>" readonly>


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
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo $obra['lugar_ejecucion']; ?>" readonly>

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" readonly>

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ" value="<?php echo $obra['valoracion_econ']; ?>" readonly>

        <label for="exposicion">Tipo Exposición:</label>
        <select name="exposicion" id="exposicion">
        <?php foreach ($exposiciones as $exposicion): ?>
            <option value="<?= $exposicion['id_exposicion'] ?>" <?= $obra['id_exposicion'] == $exposicion['id_exposicion'] ? 'selected' : '' ?>>
                <?= $exposicion['tipo_exposicion']  . ' - ' . $exposicion['sitio_exposicion'] ?>
            </option>
        <?php endforeach; ?>
        </select>

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia" readonly><?php echo $obra['bibliografia']; ?></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" readonly><?php echo $obra['descripcion']; ?></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra" readonly><?php echo $obra['historia_obra']; ?></textarea>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>