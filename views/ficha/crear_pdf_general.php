<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start(); // Iniciar el buffer de salida

require_once("vendor/autoload.php");

$pdf = new TCPDF();

$dbConnection = new Database();
$conn = $dbConnection->conectar();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Error: Parámetro 'id' no especificado o inválido.");
}

$obraModel = new ObrasModel($conn);
$obra = $obraModel->obtenerObra($id);
$autores = $obraModel->getAutores();
$clasificaciones_genericas = $obraModel->getClasificacionesGenericas();
$materiales = $obraModel->getMateriales();
$tecnicas = $obraModel->getTecnicas();
$dataciones = $obraModel->getdatacion();
$formasIngreso = $obraModel->getFormasIngreso();
$estadosConservacion = $obraModel->getEstadosConservacion();
$imagen_url = $obraModel->obtenerImagen($obra['numero_registro']);

// Selección de valores de listas
$autorseleccionado = array_column(array_filter($autores, fn($a) => $a['codigo_autor'] === $obra['autor']), 'nombre_autor')[0] ?? '';
$materialseleccionado = array_column(array_filter($materiales, fn($m) => $m['codigo_getty_material'] === $obra['material']), 'texto_material')[0] ?? '';                
$datacionseleccionado = '';
foreach ($dataciones as $datacion) {
    if ($obra['datacion'] == $datacion['id_datacion']) {
        $datacionseleccionado = "{$datacion['nombre_datacion']} / {$datacion['ano_inicio']} / {$datacion['ano_final']}";
        break;
    }
}

$clasificacionSeleccionada = '';
                foreach ($clasificaciones_genericas as $clasificacion) {
                    if ($obra['classificacion_generica'] == $clasificacion['id_clasificacion']) {
                        $clasificacionSeleccionada = $clasificacion['texto_clasificacion'];
                        break; // Salir del bucle una vez encontrada la clasificación
                    }
                }
                $tecnicaseleccionado = '';
                foreach ($tecnicas as $tecnica){
                    if ($obra['tecnica'] == $tecnica['codigo_getty_tecnica']) {
                        $tecnicaseleccionado = $tecnica['texto_tecnica'];
                        break;
                    }
                }

$ingresoseleccionado = array_column(array_filter($formasIngreso, fn($f) => $f['id_forma_ingreso'] === $obra['forma_ingreso']), 'texto_forma_ingreso')[0] ?? '';

$estadosSeleccionado = '';
foreach ($estadosConservacion as $estadoConservacion) {
    if ($obra['estado_conservacion'] == $estadoConservacion['id_estado']) {
        $estadosSeleccionado = $estadoConservacion['nombre_estado'];
        break;
    }
}

// Iniciar PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Apelles Fenosa');
$pdf->SetTitle('Ficha de Obra');
$pdf->SetHeaderData('', 0, '', '');

// Agregar una página
$pdf->AddPage();

// Comprobamos si la imagen existe antes de añadirla
$imagen_html = '';
if (file_exists($imagen_url)) {
    // Generar el HTML para la imagen centrada con margen superior
    $imagen_html = '<div class="imagen" style="text-align: center; margin-botom: 100px; margin-top: 300px;"><img src="' . $imagen_url . '" width="100" height="100"/></div>'; // Ajusta '20px' según sea necesario
} else {
    $imagen_html = '<div style="text-align: center;">No disponible</div>'; // Añadir margen también aquí
}



        
$html ='<h1>Ficha de Obra</h1>
<h2 class="section-title">Informació Principal</h2>
<table><tr><td>'.$imagen_html.'</td></tr></table>
<table border="1" cellpadding="6">
    <tr><th>Nº de registre:</th><td>'.$obra['numero_registro'].'</td></tr>
    <tr><th>Nom objecte:</th><td>'.$obra['nombre_objeto'].'</td></tr>
    <tr><th>Títol:</th><td>'.$obra['titulo'].'</td></tr>
    <tr><th>Classificació genèrica:</th><td>'.$clasificacionSeleccionada.'</td></tr>
    <tr><th>Nombre Autor:</th><td>'.$autorseleccionado.'</td></tr>
    <tr><th>Col·lecció de procedència:</th><td>'.$obra['coleccion_procedencia'].'</td></tr>
    <tr><th>Ubicació Actual:</th><td>'.$obra['ubicacion'].'</td></tr>
</table>

<h2 class="section-title">Detalls de Realizació</h2>
<table border="1" cellpadding="6">
    <tr><th>Máxima Altura:</th><td>'.$obra['maxima_altura'].'</td></tr>
    <tr><th>Máxima Anchura:</th><td>'.$obra['maxima_anchura'].'</td></tr>
    <tr><th>Máxima Profundidad:</th><td>'.$obra['maxima_profundidad'].'</td></tr>
    <tr><th>Material:</th><td>'.$materialseleccionado.'</td></tr>
    <tr><th>Tècnica:</th><td>'.$tecnicaseleccionado.'</td></tr>
    <tr><th>Nombre exemplars:</th><td>'.$obra['numero_ejemplares'].'</td></tr><br>
</table>

<h2 class="section-title">Datació</h2>
<table border="1" cellpadding="6">
    <tr><th>Any inici:</th><td>'.$obra['ano_inicio'].'</td></tr>
    <tr><th>Any final:</th><td>'.$obra['ano_final'].'</td></tr>
    <tr><th>Datación:</th><td>'.$datacionseleccionado.'</td></tr>
    <tr><th>Data de registre:</th><td>'.$obra['fecha_registro'].'</td></tr>
</table>

<h2 class="section-title">Ingrés</h2>
<table border="1" cellpadding="6">
    <tr><th>Forma ingrés:</th><td>'.$ingresoseleccionado.'</td></tr>
    <tr><th>Data ingrés:</th><td>'.$obra['fecha_ingreso'].'</td></tr>
    <tr><th>Font ingrés:</th><td>'.$obra['fuente_ingreso'].'</td></tr>
</table>

<h2 class="section-title">Baixa</h2>
<table border="1" cellpadding="6">
    <tr><th>Baixa:</th><td>'.$obra['baja'].'</td></tr>
    <tr><th>Causa de Baixa:</th><td>'.$obra['causa_baja'].'</td></tr>
    <tr><th>Data de baixa:</th><td>'.$obra['fecha_baja'].'</td></tr>
    <tr><th>Persona autoritz. baixa:</th><td>'.$obra['persona_aut_baja'].'</td></tr>
</table>

<h2 class="section-title">Altre informació</h2>
<table border="1" cellpadding="6">
    <tr><th>Estat de conservació:</th><td>'.$estadosSeleccionado.'</td></tr>
    <tr><th>Lloc execució:</th><td>'.$obra['lugar_ejecucion'].'</td></tr>
    <tr><th>Lloc de procedència:</th><td>'.$obra['lugar_procedencia'].'</td></tr>
    <tr><th>Nº Tiratge:</th><td>'.$obra['num_tirada'].'</td></tr>
    <tr><th>Altres números identificació:</th><td>'.$obra['otros_num_id'].'</td></tr>
    <tr><th>Valoración Económica:</th><td>'.$obra['valoracion_econ'].'</td></tr>
    <tr><th>Exposicions:</th><td>'.$exposicionseleccionado.'</td></tr>
    <tr><th>Bibliografía:</th><td>'.$obra['bibliografia'].'</td></tr>
    <tr><th>Descripción:</th><td>'.$obra['descripcion'].'</td></tr>
    <tr><th>Historia de la Obra:</th><td>'.$obra['historia_obra'].'</td></tr>
</table>
';
// Generar PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean(); // Limpia el buffer antes de generar el PDF
$pdf->Output("Ficha_Obra_{$obra['numero_registro']}.pdf", 'I'); // 'I' para mostrar en navegador

