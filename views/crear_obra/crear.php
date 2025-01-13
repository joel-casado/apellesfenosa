<?php
$dbConnection = new Database();
$conn = $dbConnection->conectar(); 
$username = $_SESSION['username'];
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
    <title>Crear Obra</title>
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
    <h1>Crear Ficha</h1>
    
    <form id="crearObraForm" action="index.php?controller=Obras&action=crear" method="POST" enctype="multipart/form-data">

        <h2 class="section-title" onclick="toggleSection(this)">Información Principal  <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">
            
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="nombre_objeto">Nombre:</label>
            <input type="text" id="nombre_objeto" name="nombre_objeto" >


            <div>
            <label for="n_registro">Nº de registre <span>*</span></label>
            <div id="camposNumeroRegistro">
                <input type="text" name="letra" id="letra" placeholder="[A-Z]">
                <input type="text" id="n_registro" name="n_registro" required>
                <input type="text" name="decimales" id="decimales" placeholder="[01-99]">
                <img src="images/lupa.png" alt="Sugerir número de registro" id="sugerirNumeroRegistro" title="Sugerir número de registre">
                <p id="errorFormatoNumRegistro"></p>
            </div>

            </div>

            <label for="codigo_autor">Código Autor:</label>
            <select name="codigo_autor" id="codigo_autor" autocomplete="off" >
                <option value="">Selecciona Autor</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['codigo_autor'] ?>"><?= $autor['nombre_autor'] ?> </option>
                <?php endforeach; ?>
            </select>

            <label for="classificacion_generica">Clasificación Genérica:</label>
            <select name="classificacion_generica" id="classificacion_generica" >
                <option value="">Selecciona Clasificación</option>
                <?php foreach ($clasificaciones_genericas as $clasificacion_generica): ?>
                    <option value="<?= $clasificacion_generica['id_clasificacion'] ?>"><?= $clasificacion_generica['texto_clasificacion'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="coleccion_procedencia">Colección Procedencia:</label>
            <input type="text" id="coleccion_procedencia" name="coleccion_procedencia">
            
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" readonly>
            <button type="button" onclick="openUbicacionSelector()">Seleccionar Ubicación</button>

        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Detalles Realización <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">
            

            <label for="maxima_altura">Máxima Altura:</label>
            <input type="text" id="maxima_altura" name="maxima_altura">

            <label for="maxima_anchura">Máxima Anchura:</label>
            <input type="text" id="maxima_anchura" name="maxima_anchura">

            <label for="maxima_profundidad">Máxima Profundidad:</label>
            <input type="text" id="maxima_profundidad" name="maxima_profundidad">

            <label for="codigo_getty_material">Material:</label>
            <select name="codigo_getty_material" id="codigo_getty_material" >
                <option value="">Selecciona Material</option>
                <?php foreach ($materiales as $material): ?>
                    <option value="<?= $material['codigo_getty_material'] ?>">
                        <?= $material['texto_material'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            

            <label for="tecnica">Técnica:</label>
            <select name="tecnica" id="tecnica" >
                <option value="">Selecciona Técnica</option>
                <?php foreach ($tecnicas as $tecnica): ?>
                    <option value="<?= $tecnica['codigo_getty_tecnica'] ?>">
                        <?= $tecnica['texto_tecnica'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="numero_ejemplares">Número de Ejemplares:</label>
            <input type="number" id="numero_ejemplares" name="numero_ejemplares">

        </div>
        </div>

        <!-- Detalles Realización -->
        <h2 class="section-title" onclick="toggleSection(this)">Datación <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

           
        

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

           
            <label for="datacion">Datación:</label>
            <select name="datacion" id="datacion" >
                <option value="">Selecciona Datación</option>
                <?php foreach ($dataciones as $datacion): ?>
                    <option value="<?= $datacion['id_datacion'] ?>"
                            data-ano-inicio="<?= $datacion['ano_inicio'] ?>"
                            data-ano-final="<?= $datacion['ano_final'] ?>">
                        <?= $datacion['nombre_datacion'] . ' / ' . $datacion['ano_inicio'] . ' / ' . $datacion['ano_final'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            
        

            <label for="fecha_registro">Fecha Registro:</label>
            <input type="date" id="fecha_registro" name="fecha_registro">


        </div>
        </div>
        <!-- Ingreso -->
        <h2 class="section-title" onclick="toggleSection(this)">Ingreso <span class="arrow">▼</span></h2>
        <div class="section-content">

        <div class="grid-container">

        

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
        <select name="estado_conservacion" id="estado_conservacion">
            <option value="">Selecciona Estado de Conservación</option>
            <?php foreach ($estadosConservacion as $estadoConservacion): ?>
                <option value="<?= $estadoConservacion['id_estado'] ?>">
                    <?= $estadoConservacion['nombre_estado'] ?>
                </option>
            <?php endforeach; ?>
        </select>
            


        <label for="lugar_ejecucion">Lugar de Ejecución:</label>
        <input type="text" id="lugar_ejecucion" name="lugar_ejecucion">
        
        <label for="lugar_procedencia">Lugar de Procedencia:</label>
        <input type="text" id="lugar_procedencia" name="lugar_procedencia">

        <label for="valoracion_econ">Valoración Económica:</label>
        <input type="text" id="valoracion_econ" name="valoracion_econ">

      

        <label for="bibliografia">Bibliografía:</label>
        <textarea id="bibliografia" name="bibliografia"></textarea>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" ></textarea>
        
        <label for="historia_obra">Historia de la Obra:</label>
        <textarea id="historia_obra" name="historia_obra"></textarea>
            
        </div>
        </div>

        <h2 class="section-title" onclick="toggleSection(this)">Otro archivos <span class="arrow">▼</span></h2>
        <div class="section-content">
        <div class="grid-container">

            <label for="archivos_extra">Otros archivos:</label>
            <input type="file" id="archivos_extra" name="archivos_extra[]" multiple>

        </div>
        </div>
        <input type="hidden" name="usuario" value="<?= $username; ?>">



        <button type="submit"  class="edit-button" >Crear Obra</button>
    </form>

    <div id="crearResponseMessage"></div>

    <script src="scripts/formulario.js"></script>
    <script>
    function openUbicacionSelector() {
        window.open('index.php?controller=ubicacion&action=selectUbicacion', 'Seleccionar Ubicación', 'width=800,height=600');
    }
    </script>

</body>
</html>
