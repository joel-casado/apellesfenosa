<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("vendor/autoload.php");

$dbConnection = new Database();
$conn = $dbConnection->conectar();
$obraModel = new ObrasModel($conn);
$obras = $obraModel->obtenerTodasLasObras();

if (!$obras || count($obras) === 0) {
    error_log("No se encontraron obras para el PDF.");
} else {
    error_log("Obras encontradas: " . count($obras));
}


$pdf = new TCPDF('L', 'mm', 'A3', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Apel·les Fenosa');
$pdf->SetTitle('Listado de Obras');
$pdf->SetHeaderData('', 0, 'Listado de Obras', '');

$pdf->SetFont('helvetica', '', 10);

foreach ($obras as $obra) {
    $pdf->AddPage();  // Nueva página para cada obra

    // Agregar imagen si está disponible
    if (!empty($obra['imagen_url'])) {
        $pdf->Image($obra['imagen_url'], '', '', 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    }else{
        $pdf->Image('images/default.jpg');
    }

    $pdf->Ln(55); // Espacio después de la imagen
    
    // Crear tabla en HTML
    $html = '<table border="1" cellpadding="8" style="width:100%;">
                <tr>
                    <td><b>Número de Registro:</b> ' . $obra['numero_registro'] . '</td>
                    <td ><b>Clasificación Genérica:</b> ' . $obra['texto_clasificacion'] . '</td>
                    <td ><b>Col·lecció de procedència:</b> ' . $obra['coleccion_procedencia'] . '</td>
                </tr>
                <tr>
                    <td><b>Máxima altura:</b> ' . $obra['maxima_altura'] . '</td>
                    <td><b>Máxima anchura:</b> ' . $obra['maxima_anchura'] . '</td>
                    <td><b>Máxima profundidad:</b> ' . $obra['maxima_profundidad'] . '</td>
                </tr>
                <tr>
                    <td><b>Material:</b> ' . $obra['texto_material'] . '</td>
                    <td><b>Técnica: </b>' . $obra['texto_tecnica'] . '</td>
                    <td><b>Autor: </b>' . $obra['nombre_autor'] . '</td>
                </tr>
                <tr>
                    <td><b>Título:</b> ' . $obra['titulo'] . '</td>
                    <td><b>Año Inicio:</b> ' . $obra['ano_inicio'] . '</td>
                    <td><b>Año Final:</b> ' . $obra['ano_final'] . '</td>
                </tr>
                <tr>
                    <td><b>Datación:</b> ' . $obra['nombre_datacion'] . '</td>
                    <td><b>Ubicación:</b> ' . $obra['ubicacion'] . '</td>
                    <td><b>Fecha de registro:</b> ' . $obra['fecha_registro'] . '</td>
                </tr>
                <tr>
                    <td><b>Número de ejemplares:</b> ' . $obra['numero_ejemplares'] . '</td>
                    <td><b>Forma de ingreso:</b> ' . $obra['texto_forma_ingreso'] . '</td>
                    <td><b>Fecha de ingreso:</b> ' . $obra['fecha_ingreso'] . '</td>
                </tr>
                <tr>
                    <td><b>Fuente de ingreso: </b>' . $obra['fuente_ingreso'] . '</td>
                    <td><b>Baja:</b> ' . $obra['baja'] . '</td>
                    <td><b>Causa de baja:</b> ' . $obra['causa_baja'] . '</td>
                </tr>
                <tr>
                    <td><b>Fecha de baja:</b> ' . $obra['fecha_baja'] . '</td>
                    <td><b>Persona autorizada baja:</b> ' . $obra['persona_aut_baja'] . '</td>
                    <td><b>Estado de conservación: </b>' . $obra['nombre_estado'] . '</td>
                </tr>
                <tr>
                    <td><b>Lugar de ejecución:</b> ' . $obra['lugar_ejecucion'] . '</td>
                    <td><b>Lugar de procedencia:</b> ' . $obra['lugar_procedencia'] . '</td>
                    <td><b>Nº Tiraje:</b> ' . $obra['num_tirada'] . '</td>
                </tr>
                <tr>
                    <td><b>Otros números de identificación:</b> ' . $obra['otros_num_id'] . '</td>
                    <td><b>Valoración económica:</b> ' . $obra['valoracion_econ'] . ' €</td>
                    <td><b>Exposiciones:</b> ' . $obra['exposicion'] . '</td>
                </tr>
                <tr>
                   <td colspan="3"  style="height:100px;" ><b>Bibliografía:</b> ' . $obra['bibliografia'] . '</td>
                </tr>
                
                <tr>
                    <td colspan="3" style="height:100px;" ><b>Descripción:</b> ' . $obra['descripcion'] . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:100px;" ><b>Historia de la obra:</b> ' . $obra['historia_obra'] . '</td>
                </tr>
            </table>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
}

$pdf->Output('listado_obras.pdf', 'I');
