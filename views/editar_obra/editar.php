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
    <link rel="stylesheet" href="SCSS/prueba/prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="edit-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a><br>
    </div>

    <h1>Editar Obra</h1>
    
    <form action="index.php?controller=Obras&action=actualizar" method="POST">

    <h2 class="section-title" onclick="toggleSection(this)">Información Principal  <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">

        <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>">
        
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required>

        <label for="titulo">Nº Registro:</label>
        <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" required>

        
        <label for="autor">Nombre Autor:</label>
        <select name="codigo_autor" id="codigo_autor" required>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['codigo_autor'] ?>" <?= $obra['autor'] == $autor['codigo_autor'] ? 'selected' : '' ?>                >
                    <?= $autor['nombre_autor'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="coleccion_procedencia">Colección Procedencia:</label>
        <input type="text" id="coleccion_procedencia" name="coleccion_procedencia" value="<?php echo $obra['coleccion_procedencia']; ?>">
 
        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Detalles Realización <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

        <label for="maxima_altura">Máxima Altura:</label>
        <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>">

        <label for="maxima_anchura">Máxima Anchura:</label>
        <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>">

        <label for="maxima_profundidad">Máxima Profundidad:</label>
        <input type="text" id="maxima_profundidad" name="maxima_profundidad" value="<?php echo $obra['maxima_profundidad']; ?>">

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

                
        <label for="numero_ejemplares">Número de Ejemplares:</label>
        <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>">

        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Datación <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

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

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>">


        <label for="datacion">Datación:</label>
        <select name="datacion" id="datacion">
        <?php foreach ($dataciones as $datacion): ?>
            <option value="<?= $datacion['id_datacion'] ?>" <?= $obra['datacion'] == $datacion['id_datacion'] ? 'selected' : '' ?>>
                <?= $datacion['nombre_datacion']  . ' / ' . $datacion['ano_inicio']  . ' / ' . $datacion['ano_final'] ?>
            </option>
        <?php endforeach; ?>
        </select>
    

        <label value="">Selecciona Clasificación</label>
            <select name="classificacion_generica" id="classificacion_generica">
            <?php foreach ($clasificaciones_genericas as $clasificacion): ?>
                <option value="<?= $clasificacion['id_clasificacion'] ?>" <?= $obra['classificacion_generica'] == $clasificacion['id_clasificacion'] ? 'selected' : '' ?>>
                    <?= $clasificacion['texto_clasificacion']?>
                </option>
            <?php endforeach; ?>
            </select>

        </div>
        </div>
        <!-- Ingreso -->
        <h2 class="section-title" onclick="toggleSection(this)">Ingreso <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">
        
        <label for="forma_ingreso">Forma de Ingreso:</label>
        <select name="forma_ingreso" id="forma_ingreso">
        <?php foreach ($formasIngreso as $forma_ingreso): ?>
            <option value="<?= $forma_ingreso['id_forma_ingreso'] ?>" <?= $obra['forma_ingreso'] == $forma_ingreso['id_forma_ingreso'] ? 'selected' : '' ?>>
                <?= $forma_ingreso['texto_forma_ingreso'] ?>
            </option>
        <?php endforeach; ?>
        </select>



        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>">

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>">


        <label for="estado_conservacion">Estado de Conservación:</label>
        <input list="estado_conservacion" id="estado_conservacion" name="estado_conservacion" value="<?php echo $obra['estado_conservacion']; ?>">
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

        <label for="exposicion">Tipo Exposición:</label>
        <select name="exposicion" id="exposicion">
        <?php foreach ($exposiciones as $exposicion): ?>
            <option value="<?= $exposicion['id_exposicion'] ?>" <?= $obra['id_exposicion'] == $exposicion['id_exposicion'] ? 'selected' : '' ?>>
                <?= $exposicion['tipo_exposicion']  . ' - ' . $exposicion['sitio_exposicion'] ?>
            </option>
        <?php endforeach; ?>
        </select>

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia"><?php echo $obra['bibliografia']; ?></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $obra['descripcion']; ?></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"><?php echo $obra['historia_obra']; ?></textarea>

        </div>
        </div>

        <button type="submit">Actualizar</button>
    </form>

    <script src="scripts/formulario.js"></script>
</body>
</html>