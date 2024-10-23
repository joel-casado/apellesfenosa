<?php
require_once "../../models/database.php";
require_once "../../models/ObrasModel.php";
require_once "../../controllers/ObrasController.php";

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$obraModel = new ObrasModel($conn);
$autores = $obraModel->getAutores();
$clasificaciones_genericas = $obraModel->getClasificacionesGenericas();
$materiales = $obraModel->getMateriales();
$tecnicas = $obraModel->getTecnicas();
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
    <title>Crear Obra</title>
    <link href="../../SCSS/prueba/prueba.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear Obra</h1>
    
    <form action="../../index.php?controller=Obras&action=crear" method="POST">

        <!-- Información Principal -->
        <h2 class="section-title">Informació Principal</h2>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="n_registro">Nº Registro:</label>
        <input type="text" id="n_registro" name="n_registro" required>

        <label for="classificacion_generica">Clasificación Genérica:</label>
        <select name="classificacion_generica" id="classificacion_generica" required>
            <option value="">Selecciona Clasificación</option>
            <?php foreach ($clasificaciones_genericas as $clasificacion): ?>
                <option value="<?= $clasificacion['id_clasificacion'] ?>">
                    <?= $clasificacion['texto_clasificacion'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="codigo_autor">Código Autor:</label>
        <select name="codigo_autor" id="codigo_autor" required>
            <option value="">Selecciona Autor</option>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['codigo_autor'] ?>">
                    <?= $autor['nombre_autor'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="coleccion_procedencia">Colección Procedencia:</label>
        <input type="text" id="coleccion_procedencia" name="coleccion_procedencia">

        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion">

        <!-- Detalles Realización -->
        <h2  class="section-title">Detalles Realización</h2>

        <label for="maxima_altura">Máxima Altura:</label>
        <input type="text" id="maxima_altura" name="maxima_altura">

        <label for="maxima_anchura">Máxima Anchura:</label>
        <input type="text" id="maxima_anchura" name="maxima_anchura">

        <label for="maxima_profundidad">Máxima Profundidad:</label>
        <input type="text" id="maxima_profundidad" name="maxima_profundidad">

        <label for="codigo_getty_material">Material:</label>
        <select name="codigo_getty_material" id="codigo_getty_material" required>
            <option value="">Selecciona Material</option>
            <?php foreach ($materiales as $material): ?>
                <option value="<?= $material['codigo_getty_material'] ?>">
                    <?= $material['texto_material'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        

        <label for="tecnica">Técnica:</label>
        <select name="tecnica" id="tecnica" required>
            <option value="">Selecciona Técnica</option>
            <?php foreach ($tecnicas as $tecnica): ?>
                <option value="<?= $tecnica['codigo_getty_tecnica'] ?>">
                    <?= $tecnica['texto_tecnica'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="numero_ejemplares">Número de Ejemplares:</label>
        <input type="number" id="numero_ejemplares" name="numero_ejemplares">


        <h2 class="section-title">Datación</h2>

        <label for="ano_inicio">Año Inicio:</label>
        <select name="ano_inicio" id="ano_inicio">
            <option value="">Selecciona Año Inicio</option>
            <?php foreach ($anoInicio as $inicio): ?>
                <option value="<?= $inicio['ano_inicio'] ?>">
                    <?= $inicio['ano_inicio'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="ano_final">Año Final:</label>
        <select name="ano_final" id="ano_final">
            <option value="">Selecciona Año Final</option>
            <?php foreach ($anoFinal as $final): ?>
                <option value="<?= $final['ano_final'] ?>">
                    <?= $final['ano_final'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro">

        <label for="datacion">Datación:</label>
        <select name="datacion" id="datacion">
            <option value="">Selecciona Datación</option>
            <?php foreach ($dataciones as $datacion): ?>
                <option value="<?= $datacion['id_datacion'] ?>">
                    <?= $datacion['nombre_datacion'] . ' / ' . $datacion['ano_inicio'] . ' / ' . $datacion['ano_final'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <h2  class="section-title" >Ingreso</h2>

        <label for="forma_ingreso">Forma de Ingreso:</label>
        <select name="forma_ingreso" id="forma_ingreso">
            <option value="">Selecciona Forma de Ingreso</option>
            <?php foreach ($formasIngreso as $forma_ingreso): ?>
                <option value="<?= $forma_ingreso['id_forma_ingreso'] ?>">
                    <?= $forma_ingreso['texto_forma_ingreso'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso">

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso">

        <label for="estado_conservacion">Estado de Conservación:</label>
        <input list="estados" name="estado" id="estado">
            <datalist id="estados">
                <option value="Bo">
                <option value="Dolent">
                <option value="Excel·lent">
                <option value="Indeterminat">
                <option value="Desconeguda">
                <option value="Regular">
            </datalist>


        <label for="lugar_ejecucion">Lugar de Ejecución:</label>
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion">

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia">

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ">

        <label for="exposicion">Tipo Exposición:</label>
        <select name="exposicion" id="exposicion">
            <option value="">Selecciona Exposición</option>
            <?php foreach ($exposiciones as $exposicion): ?>
                <option value="<?= $exposicion['id_exposicion'] ?>">
                    <?= $exposicion['tipo_exposicion'] . ' - ' . $exposicion['sitio_exposicion'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia"></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"></textarea>

        <button type="submit">Crear</button>
    </form>
</body>
</html>

