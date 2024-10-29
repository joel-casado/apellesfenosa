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
$obra = $obraModel->obtenerObra($id); // Obtén la obra aquí

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
    <tr>
        <th>Título</th>
        <td>{$obra['titulo']}</td>
    </tr>
    <tr>
        <th>Nº Registro</th>
        <td>{$obra['numero_registro']}</td>
    </tr>
    <tr>
        <th>Año Inicio</th>
        <td>{$obra['ano_inicio']}</td>
    </tr>
    <tr>
        <th>Año Final</th>
        <td>{$obra['ano_final']}</td>
    </tr>
    <tr>
        <th>Clasificación Genérica</th>
        <td>{$obra['classificacion_generica']}</td>
    </tr>
    <tr>
        <th>Nombre Autor</th>
        <td>{$obra['autor']}</td>
    </tr>
    <tr>
        <th>Colección de Procedencia</th>
        <td>{$obra['coleccion_procedencia']}</td>
    </tr>
    <tr>
        <th>Máxima Altura</th>
        <td>{$obra['maxima_altura']}</td>
    </tr>
    <tr>
        <th>Máxima Anchura</th>
        <td>{$obra['maxima_anchura']}</td>
    </tr>
    <tr>
        <th>Máxima Profundidad</th>
        <td>{$obra['maxima_profundidad']}</td>
    </tr>
    <tr>
        <th>Material</th>
        <td>{$obra['material']}</td>
    </tr>
    <tr>
        <th>Técnica</th>
        <td>{$obra['tecnica']}</td>
    </tr>
    <tr>
        <th>Datación</th>
        <td>{$obra['datacion']}</td>
    </tr>
    <tr>
        <th>Ubicación</th>
        <td>{$obra['ubicacion']}</td>
    </tr>
    <tr>
        <th>Fecha de Registro</th>
        <td>{$obra['fecha_registro']}</td>
    </tr>
    <tr>
        <th>Ejemplares</th>
        <td>{$obra['numero_ejemplares']}</td>
    </tr>
    <tr>
        <th>Forma de Ingreso</th>
        <td>{$obra['forma_ingreso']}</td>
    </tr>
    <tr>
        <th>Fecha Ingreso</th>
        <td>{$obra['fecha_ingreso']}</td>
    </tr>
    <tr>
        <th>Fuente de Ingreso</th>
        <td>{$obra['fuente_ingreso']}</td>
    </tr>
    <tr>
        <th>Estado de Conservación</th>
        <td>{$obra['estado_conservacion']}</td>
    </tr>
    <tr>
        <th>Lugar de Ejecución</th>
        <td>{$obra['lugar_ejecucion']}</td>
    </tr>
    <tr>
        <th>Lugar de Procedencia</th>
        <td>{$obra['lugar_procedencia']}</td>
    </tr>
    <tr>
        <th>Valoración Económica</th>
        <td>{$obra['valoracion_econ']}</td>
    </tr>
    <tr>
        <th>Exposición</th>
        <td>{$obra['id_exposicion']}</td>
    </tr>
    <tr>
        <th>Bibliografía</th>
        <td>{$obra['bibliografia']}</td>
    </tr>
    <tr>
        <th>Descripción</th>
        <td>{$obra['descripcion']}</td>
    </tr>
    <tr>
        <th>Historia de la Obra</th>
        <td>{$obra['historia_obra']}</td>
    </tr>
</table>
EOD;

// Generar PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean(); // Limpia el buffer antes de generar el PDF
$pdf->Output("Ficha_Obra_{$obra['numero_registro']}.pdf", 'I'); // 'I' para mostrar en navegador
