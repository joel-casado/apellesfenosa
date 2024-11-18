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


$pdf = new TCPDF('P', 'mm', 'A3', true, 'UTF-8', false);
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
    }

    $pdf->Ln(55); // Espacio después de la imagen
    
    // Crear tabla en HTML
    $html = '<table border="1" cellpadding="10" style="width:100%;">
                <tr>
                    <td style="width:33%;">Número de Registro: ' . $obra['numero_registro'] . '</td>
                    <td style="width:33%;">Clasificación Genérica: ' . $obra['texto_clasificacion'] . '</td>
                    <td style="width:33%;">Col·lecció de procedència: ' . $obra['coleccion_procedencia'] . '</td>
                </tr>
                <tr>
                    <td>Máxima altura: ' . $obra['maxima_altura'] . '</td>
                    <td>Máxima anchura: ' . $obra['maxima_anchura'] . '</td>
                    <td>Máxima profundidad: ' . $obra['maxima_profundidad'] . '</td>
                </tr>
                <tr>
                    <td>Material: ' . $obra['texto_material'] . '</td>
                    <td>Técnica: ' . $obra['texto_tecnica'] . '</td>
                    <td>Autor: ' . $obra['nombre_autor'] . '</td>
                </tr>
                <tr>
                    <td>Título: ' . $obra['titulo'] . '</td>
                    <td>Año Inicio: ' . $obra['ano_inicio'] . '</td>
                    <td>Año Final: ' . $obra['ano_final'] . '</td>
                </tr>
                <tr>
                    <td>Datación: ' . $obra['nombre_datacion'] . '</td>
                    <td>Ubicación: ' . $obra['ubicacion'] . '</td>
                    <td>Fecha de registro: ' . $obra['fecha_registro'] . '</td>
                </tr>
                <tr>
                    <td>Número de ejemplares: ' . $obra['numero_ejemplares'] . '</td>
                    <td>Forma de ingreso: ' . $obra['texto_forma_ingreso'] . '</td>
                    <td>Fecha de ingreso: ' . $obra['fecha_ingreso'] . '</td>
                </tr>
                <tr>
                    <td>Fuente de ingreso: ' . $obra['fuente_ingreso'] . '</td>
                    <td>Baja: ' . $obra['baja'] . '</td>
                    <td>Causa de baja: ' . $obra['causa_baja'] . '</td>
                </tr>
                <tr>
                    <td>Fecha de baja: ' . $obra['fecha_baja'] . '</td>
                    <td>Persona autorizada baja: ' . $obra['persona_aut_baja'] . '</td>
                    <td>Estado de conservación: ' . $obra['estado_conservacion'] . '</td>
                </tr>
                <tr>
                    <td>Lugar de ejecución: ' . $obra['lugar_ejecucion'] . '</td>
                    <td>Lugar de procedencia: ' . $obra['lugar_procedencia'] . '</td>
                    <td>Nº Tiraje: ' . $obra['num_tirada'] . '</td>
                </tr>
                <tr>
                    <td>Otros números de identificación: ' . $obra['otros_num_id'] . '</td>
                    <td>Valoración económica: ' . $obra['valoracion_econ'] . ' €</td>
                    <td>Exposiciones: ' . $obra['exposicion'] . '</td>
                </tr>
                <tr>
                    <td colspan="3"  style="height:150px;" >Bibliografía: ' . $obra['bibliografia'] . '</td>
                </tr>
                
                <tr>
                    <td colspan="3" style="height:150px;" >Descripción: ' . $obra['descripcion'] . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:150px;" >Historia de la obra: ' . $obra['historia_obra'] . '</td>
                </tr>
            </table>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    $pdf->Ln(10); // Espacio entre registros en la misma página
}

$pdf->Output('listado_obras.pdf', 'I');
