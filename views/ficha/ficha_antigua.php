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
$imagen_url = $obraModel->obtenerImagen($obra['numero_registro']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha</title>
    <link rel="stylesheet" href="styles/obras/obras.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="edit-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a><br>
    </div>

    <div class="actions">
    <a href="index.php?controller=Obras&action=mostrarpdf&id=<?php echo $obra['numero_registro']; ?>" class="download-button">Descargar PDF</a>
    </div>


    <div class="form-container">


    <h1>FICHA OBRA</h1>

   

    
    


    <form>
        <?php
        // Depuración: Verificar si la URL de la imagen está presente en la vista
        echo "<script>console.log('URL de imagen en la vista: " . htmlspecialchars($imagen_url) . "');</script>";
        ?>

        <?php if (!empty($imagen_url)): ?>
            <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>" style="width: 100px; height: auto;">
        <?php else: ?>
            <img src="ruta/a/la/imagen/por_defecto.jpg" alt="Sin imagen disponible" style="width: 100px; height: auto;">
            <p>Sin imagen disponible</p>
        <?php endif; ?>





    <h2 class="section-title" onclick="toggleSection(this)">Información Principal  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

            <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>
            
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" readonly>

            <label for="titulo">Nº Registro:</label>
            <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

            
            <label>Clasificación:</label>
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
                <input type="text" id="classificacion_generica" name="classificacion_generica" value="<?php echo $clasificacionSeleccionada ?>" readonly>
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

            
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>" readonly>

        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Detalles de Realización  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">
    
            <label for="maxima_altura">Máxima Altura:</label>
            <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>" readonly>

            <label for="maxima_anchura">Máxima Anchura:</label>
            <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>" readonly>

            <label for="maxima_profundidad">Máxima Profundidad:</label>
            <input type="text" id="maxima_profundidad" name="maxima_profundidad" value="<?php echo $obra['maxima_profundidad']; ?>" readonly>

            <label for="material">Material:</label>

            <span>
                <?php 
                $materialseleccionado = '';
                foreach ($materiales as $material){
                    if ($obra['material'] == $material['codigo_getty_material']) {
                        $materialseleccionado = $material['texto_material'];
                        break;
                    }
                }
                ?>
                <input type="text" id="codigo_getty_material" name="codigo_getty_material" value="<?php echo $materialseleccionado ?>" readonly >
        
                </span>


            <label for="tecnica">Técnica:</label>
            <span>
                <?php 
                $tecnicaseleccionado = '';
                foreach ($tecnicas as $tecnica){
                    if ($obra['tecnica'] == $tecnica['codigo_getty_tecnica']) {
                        $tecnicaseleccionado = $tecnica['texto_tecnica'];
                        break;
                    }
                }
                ?>
                <input type="text" id="codigo_getty_tecnica" name="codigo_getty_tecnica" value="<?php echo $tecnicaseleccionado ?>" readonly >
        
                </span>

            <label for="numero_ejemplares">Número de Ejemplares:</label>
            <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>" readonly>

        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Datación <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

        

        <label for="ano_inicio">Año inicio:</label>
        <span>
            <?php 
            $inicioseleccionado = '';
            foreach ($anoInicio as $inicio){
                 if ($obra['ano_inicio'] == $inicio['ano_inicio']) {
                    $inicioseleccionado = $inicio['ano_inicio'];
                    break;
                 }
            }
            ?>
            <input type="text" id="ano_inicio" name="ano_inicio" value="<?php echo $inicioseleccionado ?>" readonly >
    
            </span>

        <label for="ano_final">Año final:</label>
        <span>
            <?php 
            $finalseleccionado = '';
            foreach ($anoFinal as $final){
                 if ($obra['ano_final'] == $final['ano_final']) {
                    $finalseleccionado = $final['ano_final'];
                    break;
                 }
            }
            ?>
            <input type="text" id="ano_final" name="ano_final" value="<?php echo $finalseleccionado ?>" readonly >
    
            </span>


        <label for="datacion">Datación:</label>

        <span>
            <?php 
            $datacionseleccionado = '';
            foreach ($dataciones as $datacion){
                 if ($obra['datacion'] == $datacion['id_datacion']) {
                    $datacionseleccionado = $datacion['nombre_datacion']  . ' / ' . $datacion['ano_inicio']  . ' / ' . $datacion['ano_final'];
                    break;
                 }
            }
            ?>
            <input type="text" id="ano_inicio" name="ano_inicio" value="<?php echo $datacionseleccionado ?>" readonly >
    
            </span>

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>" readonly>

        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Ingreso  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

        <label for="formas_ingreso">Forma de Ingreso:</label>
        <span>
            <?php 
            $ingresoseleccionado = '';
            foreach ($formasIngreso as $forma_ingreso){
                 if ($obra['forma_ingreso'] == $forma_ingreso['id_forma_ingreso']) {
                    $ingresoseleccionado = $forma_ingreso['texto_forma_ingreso'];
                    break;
                 }
            }
            ?>
            <input type="text" id="formas_ingreso" name="formas_ingreso" value="<?php echo $ingresoseleccionado ?>" readonly >
    
            </span>


        <label for="fecha_ingreso">Fecha de Ingreso:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>" readonly>

        <label for="fuente_ingreso">Fuente de Ingreso:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>" readonly>


        <label for="estado_conservacion">Estado de Conservación:</label>
        <input type="text" id="estado_conservacion" name="estado_conservacion" value="<?php echo $obra['estado_conservacion']; ?>" readonly>

        <label for="lugar_ejecucion">Lugar de Ejecución:</label>
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo $obra['lugar_ejecucion']; ?>" readonly>

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" readonly>

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ" value="<?php echo $obra['valoracion_econ']; ?>" readonly>

        <label for="exposicion">Tipo Exposición:</label>
        <span>
            <?php 
            $exposicionseleccionado = '';
            foreach ($exposiciones as $exposicion){
                 if ($obra['id_exposicion'] == $exposicion['id_exposicion']) {
                    $exposicionseleccionado = $exposicion['tipo_exposicion']  . ' - ' . $exposicion['sitio_exposicion'] ;
                    break;
                 }
            }
            ?>
            <input type="text" id="exposicion" name="exposicion" value="<?php echo $exposicionseleccionado ?>" readonly >
    
            </span>

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia" readonly><?php echo $obra['bibliografia']; ?></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" readonly><?php echo $obra['descripcion']; ?></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra" readonly><?php echo $obra['historia_obra']; ?></textarea>

        </div>
        </div>

    </form>

    </div>

    <script src="scripts/formulario.js"></script>



</body>
</html>