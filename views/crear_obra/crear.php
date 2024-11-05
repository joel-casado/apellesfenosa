<?php
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
$dataciones = $obraModel->getdatacion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ficha</title>
    <link rel="stylesheet" href="SCSS/prueba/prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Crear Ficha</h1>
    
    <form id="crearObraForm" action="index.php?controller=Obras&action=crear" method="POST" enctype="multipart/form-data">

        <h2 class="section-title" onclick="toggleSection(this)">Información Principal  <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">
            
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="n_registro">Nº Registro:</label>
            <input type="text" id="n_registro" name="n_registro" required>

            <label for="codigo_autor">Código Autor:</label>
            <select name="codigo_autor" id="codigo_autor" required>
                <option value="">Selecciona Autor</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['codigo_autor'] ?>"><?= $autor['nombre_autor'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="coleccion_procedencia">Colección Procedencia:</label>
            <input type="text" id="coleccion_procedencia" name="coleccion_procedencia"required>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion"required>

        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Detalles Realización <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">
            

            <label for="maxima_altura">Máxima Altura:</label>
            <input type="text" id="maxima_altura" name="maxima_altura"required>

            <label for="maxima_anchura">Máxima Anchura:</label>
            <input type="text" id="maxima_anchura" name="maxima_anchura"required>

            <label for="maxima_profundidad">Máxima Profundidad:</label>
            <input type="text" id="maxima_profundidad" name="maxima_profundidad"required>

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
            <input type="number" id="numero_ejemplares" name="numero_ejemplares"required>

        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Datación <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

           

            <label for="ano_inicio">Año Inicio:</label>
            <select name="ano_inicio" id="ano_inicio"required>
                <option value="">Selecciona Año Inicio</option>
                <?php foreach ($anoInicio as $inicio): ?>
                    <option value="<?= $inicio['ano_inicio'] ?>">
                        <?= $inicio['ano_inicio'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="ano_final">Año Final:</label>
            <select name="ano_final" id="ano_final"required>
                <option value="">Selecciona Año Final</option>
                <?php foreach ($anoFinal as $final): ?>
                    <option value="<?= $final['ano_final'] ?>">
                        <?= $final['ano_final'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        

            <label for="fecha_registro">Fecha Registro:</label>
            <input type="date" id="fecha_registro" name="fecha_registro"required>


        </div>
        </div>
        <!-- Ingreso -->
        <h2 class="section-title" onclick="toggleSection(this)">Ingreso <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">

        

        <label for="forma_ingreso">Forma de Ingreso:</label>
        <select name="forma_ingreso" id="forma_ingreso"required>
            <option value="">Selecciona Forma de Ingreso</option>
            <?php foreach ($formasIngreso as $forma_ingreso): ?>
                <option value="<?= $forma_ingreso['id_forma_ingreso'] ?>">
                    <?= $forma_ingreso['texto_forma_ingreso'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso"required>

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso"required>

        <label for="estado_conservacion">Estado de Conservación:</label>
        <input list="estados" name="estado" id="estado"required>
            <datalist id="estados">
                <option value="Bo">
                <option value="Dolent">
                <option value="Excel·lent">
                <option value="Indeterminat">
                <option value="Desconeguda">
                <option value="Regular">
            </datalist>


        <label for="lugar_ejecucion">Lugar de Ejecución:</label>
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion"required>

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia"required>

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ"required>

      

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia"required></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"required></textarea>


            
        </div>
        </div>
        <button type="submit">Crear Obra</button>
    </form>

    <div id="crearResponseMessage"></div>

    <script src="scripts/formulario.js"></script>

</body>
</html>
