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
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre o Sitio Web');
$pdf->SetTitle('Ficha de Obra');
$pdf->SetHeaderData('', 0, 'Ficha de Obra', '');

// Agregar una página
$pdf->AddPage();

// Agregar contenido
$html = "<h1>Ficha de la Obra</h1>";
$html .= "<p><strong>Título:</strong> {$obra['titulo']}</p>";
$html .= "<p><strong>Nº Registro:</strong> {$obra['numero_registro']}</p>";
$html .= "<p><strong>Año Inicio:</strong> {$obra['ano_inicio']}</p>";
$html .= "<p><strong>Año Final:</strong> {$obra['ano_final']}</p>";
$html .= "<p><strong>Descripción:</strong> {$obra['descripcion']}</p>";

// Generar PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean(); // Limpia el buffer antes de generar el PDF
$pdf->Output("Ficha_Obra_{$obra['numero_registro']}.pdf", 'I');