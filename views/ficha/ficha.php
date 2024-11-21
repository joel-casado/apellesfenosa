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
    <link rel="stylesheet" href="styles/editar_obras/editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
        <a href="index.php?controller=Login&action=logout" class="edit-button">Cerrar sesión</a>
        <a href="views/vocabulario/ver_vocabulario.php?id=" class="edit-button">Vocabulario</a>
        <a href="index.php?controller=Obras&action=verObras&admin" class="edit-button">Obras</a>
        <a href="index.php?controller=Exposiciones&action=listado_exposiciones" class="edit-button">Exposiciones</a>
        <a href="index.php?controller=Ubicacion&action=verArbol" class="edit-button">Ubicaciones</a>
    </div>
    <div class="actions">
    <a class="edit-button" href="index.php?controller=Obras&action=mostrarpdfGeneral&id=<?php echo $obra['numero_registro']; ?>" class="download-button">Descargar PDF</a>
    </div>

    <br>
    <div class="form-container"> 


    <h1>FICHA BASICA OBRA</h1>
    <br>

    <form>
    
    <?php if (!empty($imagen_url)): ?>
    <div class="image-container">
        <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>">
    </div>
        <?php else: ?>
            <div class="image-container">
                <img src="ruta/a/la/imagen/por_defecto.jpg" alt="Sin imagen disponible">
                <p>Sin imagen disponible</p>
            </div>
        <?php endif; ?>



    <h2 class="section-title" onclick="toggleSection(this)">Información Principal  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

            <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

            <label for="titulo">Nº Registro:</label>
            <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

            <label for="objeto">Nombre del objeto:</label>
            <input type="text" id="objeto" name="objeto" value="<?php echo $obra['nombre_objeto']; ?>" readonly>

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

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" readonly>

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

                
        <label for="estado_conservacion">Estado de Conservación:</label>
        <input type="text" id="estado_conservacion" name="estado_conservacion" value="<?php echo $obra['estado_conservacion']; ?>" readonly>


        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Datación <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

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

        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" readonly>

        <label for="fecha_registro">Fecha Registro:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>" readonly>

        <label for="persona_registro">Usuario que ha registrado</label>
        <input type="text" id="persona_registro" name="persona_registro" value="<?php echo $obra['persona_aut_baja']; ?>" readonly>

        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Otros archivos <span class="arrow">▼</span></h2>
            <div class="section-content">
                <div class="grid-container">
                    <label for="otros_archivos">Archivos asociados:</label>
                    <div id="otros_archivos">
                        <?php
                        $archivos = $obraModel->getArchivos($id); // Llama al método del modelo.
                        if (!empty($archivos)) {
                            foreach ($archivos as $archivo) {
                                echo '<p><a href="' . htmlspecialchars($archivo['enlace']) . '" target="_blank">'
                                    . basename($archivo['enlace'])
                                    . '</a></p>';
                            }
                        } else {
                            echo '<p>No hay archivos asociados para esta obra.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
    </form>

    </div>

    <script src="scripts/formulario.js"></script>



</body>
</html>