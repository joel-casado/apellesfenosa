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
    <title>Editar Obra</title>
    <link rel="stylesheet" href="SCSS/prueba/fichas.css">
    <link rel="stylesheet" href="styles/sidebar/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <img src="images/login/logo.png" alt="Museu Apel·les Fenosa">
    </div>
    <ul class="menu">
        <li><a href="index.php?controller=Obras&action=verObras"><i class="fas fa-palette"></i> <span>Obres</span></a></li>
        <li><a href="index.php?controller=vocabulario&action=mostrarVocabulario"><i class="fas fa-book"></i> <span>Vocabulari</span></a></li>
        <li><a href="index.php?controller=Exposiciones&action=listado_exposiciones"><i class="fas fa-university"></i> <span>Exposicions</span></a></li>
        <li><a href="index.php?controller=Ubicacion&action=verArbol"><i class="fas fa-map-marker-alt"></i> <span>Ubicacions</span></a></li>
        <li><a href="index.php?controller=usuaris&action=listar_usuarios"><i class="fa-solid fa-user"></i> <span>Usuaris</span></a></li>
        <li><a href="index.php?controller=Backup&action=createBackup"><i class="fa-solid fa-file"></i> <span>Backup</span></a></li>
        <li><a href="index.php?controller=Login&action=logout"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a></li>
    </ul>
    <div class="toggle-btn">
        <i class="fas fa-angle-double-right"></i>
    </div>
</div>

<div class="content">
<div class="button-bar">
    <?php if (isset($rol) && ($rol == 'admin' || $rol == 'tecnic')): ?>
        <a href="index.php?controller=Obras&action=crear">Crear</a>
    <?php endif; ?>
    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $obra['numero_registro']; ?>">Fitxa Bàsica</a>
    <a href="index.php?controller=Obras&action=mostrarFichaGeneral&id=<?php echo $obra['numero_registro']; ?>">Fitxa General</a>
    <a href="index.php?controller=Restauraciones&action=restauraciones&id=<?php echo $obra['numero_registro']; ?>">Restauracions</a>
</div>

<h1>Editar Obra "<?php echo $obra['titulo']; ?>"</h1>

<form id="editarObraForm" action="index.php?controller=Obras&action=actualizar" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="n_registro" value="<?php echo $obra['numero_registro']; ?>">

    <?php if (!empty($imagen_url)): ?>
        <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($obra['titulo']); ?>" style="width: 100px; height: auto;">
    <?php else: ?>
        <img src="images/login/default.png" alt="Sin imagen disponible" style="width: 100px; height: auto;">
    <?php endif; ?>

    <h2 class="section-title" onclick="toggleSection(this)">Informació Principal  <span class="arrow">▼</span></h2>
    <div class="section-content">
        <div class="grid-container">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <label for="titulo">Titol:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required>

            <label for="n_registro">Nº Registro:</label>
            <input type="text" id="n_registro" name="n_registro" value="<?php echo $obra['numero_registro']; ?>" required>

            <label for="codigo_autor">Autor:</label>
            <select name="codigo_autor" id="codigo_autor" required>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['codigo_autor'] ?>" <?= $obra['autor'] == $autor['codigo_autor'] ? 'selected' : '' ?>>
                        <?= $autor['nombre_autor'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="classificacion_generica">Clasificación Genérica:</label>
            <select name="classificacion_generica" id="classificacion_generica">
                <option value="">Selecciona Clasificación</option>
                <?php foreach ($clasificaciones_genericas as $clasificacion_generica): ?>
                    <option value="<?= $clasificacion_generica['id_clasificacion'] ?>" <?= $obra['classificacion_generica'] == $clasificacion_generica['id_clasificacion'] ? 'selected' : '' ?>>
                        <?= $clasificacion_generica['texto_clasificacion'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="coleccion_procedencia">Colecció de procedencia:</label>
            <input type="text" id="coleccion_procedencia" name="coleccion_procedencia" value="<?php echo $obra['coleccion_procedencia']; ?>">

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>" readonly>
            <button type="button" onclick="openUbicacionSelector()">Seleccionar Ubicación</button>
        </div>
    </div>

    <!-- Detalles Realización -->
    <h2 class="section-title" onclick="toggleSection(this)">Detalls De Realització <span class="arrow">▼</span></h2>
    <div class="section-content">
        <div class="grid-container">
            <label for="maxima_altura">Màxima Alçada:</label>
            <input type="text" id="maxima_altura" name="maxima_altura" value="<?php echo $obra['maxima_altura']; ?>">

            <label for="maxima_anchura">Màxima Amplada:</label>
            <input type="text" id="maxima_anchura" name="maxima_anchura" value="<?php echo $obra['maxima_anchura']; ?>">

            <label for="maxima_profundidad">Màxima profunditat:</label>
            <input type="text" id="maxima_profundidad" name="maxima_profundidad" value="<?php echo $obra['maxima_profundidad']; ?>">

            <label for="codigo_getty_material">Material:</label>
            <select name="codigo_getty_material" id="codigo_getty_material" required>
                <?php foreach ($materiales as $material): ?>
                    <option value="<?= $material['codigo_getty_material'] ?>" <?= $obra['material'] == $material['codigo_getty_material'] ? 'selected' : '' ?>>
                        <?= $material['texto_material'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tecnica">Tècnica:</label>
            <select name="tecnica" id="tecnica" required>
                <?php foreach ($tecnicas as $tecnica): ?>
                    <option value="<?= $tecnica['codigo_getty_tecnica'] ?>" <?= $obra['tecnica'] == $tecnica['codigo_getty_tecnica'] ? 'selected' : '' ?>>
                        <?= $tecnica['texto_tecnica'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="numero_ejemplares">Nombre d'Exemplars:</label>
            <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>">
        </div>
    </div>

    <!-- Datación -->
    <h2 class="section-title" onclick="toggleSection(this)">Datació <span class="arrow">▼</span></h2>
    <div class="section-content">
        <div class="grid-container">
            <label for="ano_inicio">Any inici:</label>
            <select name="ano_inicio" id="ano_inicio">
                <?php foreach ($anoInicio as $inicio): ?>
                    <option value="<?= $inicio['ano_inicio'] ?>" <?= $obra['ano_inicio'] == $inicio['ano_inicio'] ? 'selected' : '' ?>>
                        <?= $inicio['ano_inicio'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="ano_final">Any final:</label>
            <select name="ano_final" id="ano_final">
                <?php foreach ($anoFinal as $final): ?>
                    <option value="<?= $final['ano_final'] ?>" <?= $obra['ano_final'] == $final['ano_final'] ? 'selected' : '' ?>>
                        <?= $final['ano_final'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_registro">Data Registre:</label>
            <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>">

            <label for="datacion">Datació:</label>
            <select name="datacion" id="datacion">
                <?php foreach ($dataciones as $datacion): ?>
                    <option value="<?= $datacion['id_datacion'] ?>" <?= $obra['datacion'] == $datacion['id_datacion'] ? 'selected' : '' ?>>
                        <?= $datacion['nombre_datacion']  . ' / ' . $datacion['ano_inicio']  . ' / ' . $datacion['ano_final'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="classificacion_generica">Selecciona Classificació:</label>
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
    <h2 class="section-title" onclick="toggleSection(this)">Ingrés <span class="arrow">▼</span></h2>
    <div class="section-content">
        <div class="grid-container">
            <label for="forma_ingreso">Forma d'ingrés:</label>
            <select name="forma_ingreso" id="forma_ingreso">
                <?php foreach ($formasIngreso as $forma_ingreso): ?>
                    <option value="<?= $forma_ingreso['id_forma_ingreso'] ?>" <?= $obra['forma_ingreso'] == $forma_ingreso['id_forma_ingreso'] ? 'selected' : '' ?>>
                        <?= $forma_ingreso['texto_forma_ingreso'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_ingreso">Data d'ingrés:</label>
            <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>">

            <label for="fuente_ingreso">Font d'Ingrés:</label>
            <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>">

            <label for="estado_conservacion">Estat de Conservació:</label>
            <input type="text" id="estado_conservacion" name="estado_conservacion" value="<?php echo $obra['estado_conservacion']; ?>">

            <label for="lugar_ejecucion">Lloc d'execució:</label>
            <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo $obra['lugar_ejecucion']; ?>">

            <label for="lugar_procedencia">Lloc de Procedència:</label>
            <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>">

            <label for="valoracion_econ">Valoració Econòmica:</label>
            <input type="text" id="valoracion_econ" name="valoracion_econ" value="<?php echo $obra['valoracion_econ']; ?>">

            <label for="exposicion">Tipus Exposició:</label>
            <select name="exposicion" id="exposicion">
                <?php foreach ($exposiciones as $exposicion): ?>
                    <option value="<?= $exposicion['id_exposicion'] ?>" <?= $obra['id_exposicion'] == $exposicion['id_exposicion'] ? 'selected' : '' ?>>
                        <?= $exposicion['tipo_exposicion']  . ' - ' . $exposicion['sitio_exposicion'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="bibliografia">Bibliografia:</label>
            <textarea id="bibliografia" name="bibliografia"><?php echo $obra['bibliografia']; ?></textarea>

            <label for="descripcion">Descripció:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $obra['descripcion']; ?></textarea>

            <label for="historia_obra">Història de l'Obra:</label>
            <textarea id="historia_obra" name="historia_obra"><?php echo $obra['historia_obra']; ?></textarea>
        </div>
    </div>

    <!-- Otro archivos -->
    <h2 class="section-title" onclick="toggleSection(this)">Otro archivos <span class="arrow">▼</span></h2>
    <div class="section-content">
        <div class="grid-container">
            <label for="archivos_extra">Otros archivos:</label>
            <input type="file" id="archivos_extra" name="archivos_extra[]" multiple>
        </div>
    </div>

    <button type="submit" class="edit-button">Actualitzar</button>
</form>

<div id="editarResponseMessage"></div>

<script src="scripts/formulario.js"></script>
<script>
function openUbicacionSelector() {
    window.open('index.php?controller=ubicacion&action=selectUbicacion', 'Seleccionar Ubicación', 'width=800,height=600');
}
</script>

</body>
</html>