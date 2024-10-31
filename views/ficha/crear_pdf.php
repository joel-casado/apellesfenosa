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

$ingresoseleccionado = array_column(array_filter($formasIngreso, fn($f) => $f['id_forma_ingreso'] === $obra['forma_ingreso']), 'texto_forma_ingreso')[0] ?? '';


// Iniciar PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre o Sitio Web');
$pdf->SetTitle('Ficha de Obra');
$pdf->SetHeaderData('', 0, 'Ficha de Obra', '');

// Agregar una página
$pdf->AddPage();

$html = <<<EOD
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #555;
    }
    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }
    .bold {
        font-weight: bold;
    }
    table {
        width: 100%;
        border-collapse: separate; /* Cambiado a 'separate' para usar los bordes de las celdas */
        border-spacing: 0 10px; /* Espaciado vertical entre filas */
        margin-top: 20px;
    }
    th {
        padding: 10px;
        vertical-align: middle; /* Alinear el texto verticalmente */
    }
    td {
        border: 1px solid #dddddd;
        padding: 12px; /* Aumentar padding para más espacio interno */
        text-align: left;
        vertical-align: top;
        background-color: #f9f9f9; /* Fondo claro para las celdas */
    }
</style>

<h1>Ficha de la Obra</h1>

<table>
  <tr><th>Nº Registro</th><td>{$obra['numero_registro']}</td></tr>
    <tr><th>Nombre del Objeto</th><td>{$obra['nombre_objeto']}</td></tr>
    <tr><th>Autor</th><td>$autorseleccionado</td></tr>
    <tr><th>Título</th><td>{$obra['titulo']}</td></tr>
    <tr><th>Máxima Altura</th><td>{$obra['maxima_altura']}</td></tr>
    <tr><th>Máxima Anchura</th><td>{$obra['maxima_anchura']}</td></tr>
    <tr><th>Máxima Profundidad</th><td>{$obra['maxima_profundidad']}</td></tr>
    <tr><th>Material</th><td>$materialseleccionado</td></tr>
    <tr><th>Estado de Conservación</th><td>{$obra['estado_conservacion']}</td></tr>
    <tr><th>Datación</th><td>$datacionseleccionado</td></tr>
    <tr><th>Forma de Ingreso</th><td>$ingresoseleccionado</td></tr>
    <tr><th>Fecha de Ingreso</th><td>{$obra['fecha_ingreso']}</td></tr>
    <tr><th>Fuente de Ingreso</th><td>{$obra['fuente_ingreso']}</td></tr>
    <tr><th>Lugar de Procedencia</th><td>{$obra['lugar_procedencia']}</td></tr>
    <tr><th>Fecha Registro</th><td>{$obra['fecha_registro']}</td></tr>
    <tr><th>Usuario que ha registrado</th><td>{$obra['persona_aut_baja']}</td></tr>
</table>
EOD;

// Generar PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean(); // Limpia el buffer antes de generar el PDF
$pdf->Output("Ficha_Obra_{$obra['numero_registro']}.pdf", 'I'); // 'I' para mostrar en navegador
