<?php
session_start(); // Asegúrate de que esto esté al principio

$dbConnection = new Database();
$conn = $dbConnection->conectar(); 

$id = $_GET['id'];
$obraModel = new ObrasModel($conn);
$obra = $obraModel->obtenerObra($id);
$baixa = $obraModel->obtenObras();
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
    <title>Editar Obra</title>
    <link rel="stylesheet" href="SCSS/prueba/fichas.css">
    <link rel="stylesheet" href="styles/header/sidebar_header.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header/sidebar_header.php'; ?>
<div class="sidebar">
    <ul class="menu">
        <li><a href="index.php?controller=Obras&action=verObras"><i class="fas fa-palette"></i> <span>Obres</span></a></li>
        <li><a href="index.php?controller=vocabulario&action=mostrarVocabulario"><i class="fas fa-book"></i> <span>Vocabulari</span></a></li>
        <li><a href="index.php?controller=Exposiciones&action=listado_exposiciones"><i class="fas fa-university"></i> <span>Exposicions</span></a></li>
        <li><a href="index.php?controller=Ubicacion&action=verArbol"><i class="fas fa-map-marker-alt"></i> <span>Ubicacions</span></a></li>
        <li><a href="index.php?controller=usuaris&action=listar_usuarios"><i class="fa-solid fa-user"></i> <span>Usuaris</span></a></li>
        <li><a href="index.php?controller=Backup&action=createBackup"><i class="fa-solid fa-file"></i> <span>Backup</span></a></li>
        <li><a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras"><i class="fa-regular fa-file-pdf"></i><span>Llibre-registre</span></a></li>
        <li><a href="index.php?action=exportarCsv"> <i class="fas fa-file-export"></i> <span>Exportar Obras (CSV)</span></a></li>
        <li><a href="index.php?controller=Prestec&action=generarWord"><i class="fas fa-book-open"></i><span>Prestec</span></a></li>
        <li><a href="index.php?controller=Obras&action=mostrarPdfTodasLasObras"> <i class="fas fa-file-pdf"></i><span>Generar libro-registro</span></a></li>
        <li><a href="index.php?controller=Login&action=logout"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a></li> 
    </ul>
    <div class="toggle-btn">
        <i class="fas fa-angle-double-right"></i>
    </div>
</div>

<div class="content">
    <div class="header">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>


    <br>
    <div class="button-bar">
    <?php if (isset($rol) && ($rol == 'admin' || $rol == 'tecnic')): ?>
        <a class="edit-button" href="index.php?controller=Obras&action=mostrarpdfGeneral&id=<?php echo $obra['numero_registro']; ?>" class="download-button">Descarregar PDF</a>
        
        <?php if ($obra['baja'] == 0): ?>
            <a href="index.php?controller=Baixa&action=mostrarFormularioalta&id=<?php echo $obra['numero_registro']; ?>">Donar d'alta</a>
        <?php else: ?>
            <a href="index.php?controller=Baixa&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>">Donar de Baixa</a>
        <?php endif; ?>

    <?php endif; ?>

    <a href="index.php?controller=Obras&action=mostrarFormulario&id=<?php echo $obra['numero_registro']; ?>" class="edit-button">Tornar</a>
</div>
</div>

<br>
    <div class="form-container">


    <h1>FICHA BASICA "<?php echo $obra['titulo']; ?>"</h1>


    <form>
    
        <?php if (!empty($imagen_url)): ?>
            <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>" style="width: 100px; height: auto;">
        <?php else: ?>
            <img src="images/login/default.png" alt="Sin imagen disponible" style="width: 100px; height: auto;">
            
        <?php endif; ?>


    <h2 class="section-title" onclick="toggleSection(this)">Informació Principal   <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

            <input type="hidden" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

            <label for="titulo">Nº Registro:</label>
            <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" readonly>

            <label for="objeto">Nom de l'objecte:</label>
            <input type="text" id="objeto" name="objeto" value="<?php echo $obra['nombre_objeto']; ?>" readonly>

            <label for="autor">Nom Autor:</label>
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

            <label for="titulo">Títol:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" readonly>

        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Detalls de Realizació  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

        <label for="maxima_altura">Alçada Màxima:</label>
            <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>" readonly>

            <label for="maxima_anchura">Amplada Màxima:</label>
            <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>" readonly>

            <label for="maxima_profundidad">Profunditat Màxima:</label>
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

                
        <label for="estado_conservacion">Estat de Conservació:</label>
        <input type="text" id="estado_conservacion" name="estado_conservacion" value="<?php echo $obra['estado_conservacion']; ?>" readonly>


        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Datació <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

        <label for="datacion">Datació:</label>

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

        <h2 class="section-title" onclick="toggleSection(this)">Ingrès  <span class="arrow">▼</span></h2>

        <div class="section-content">
        <div class="grid-container">

        <label for="formas_ingreso">Forma d'ingrés:</label>
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


        <label for="fecha_ingreso">Data d'ingrés:</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>" readonly>

        <label for="fuente_ingreso">Font d'ingrés:</label>
        <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>" readonly>

        <label for="lugar_procedencia">Lloc de procedència:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" readonly>

        <label for="fecha_registro">Data de Registre:</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>" readonly>

        <label for="persona_registro">Usuari que ha registrat</label>
        <input type="text" id="persona_registro" name="persona_registro" value="<?php echo $obra['persona_aut_baja']; ?>" readonly>

        </div>
        </div>

    </form>

    </div>

    <script src="scripts/formulario.js"></script>



</body>
</html>