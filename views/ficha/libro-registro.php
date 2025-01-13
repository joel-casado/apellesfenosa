<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("vendor/autoload.php");

// Extender TCPDF para personalizar el encabezado
class MyPDF extends TCPDF {
    protected $headerText = '';

    // Método para establecer el texto del encabezado
    public function setHeaderText($text) {
        $this->headerText = $text;
    }

    // Sobrescribir el método Header()
    public function Header() {
        // Configurar el estilo del encabezado
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 10, $this->headerText, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}

$dbConnection = new Database();
$conn = $dbConnection->conectar();
$obraModel = new ObrasModel($conn);
$obras = $obraModel->obtenerTodasLasObras();

if (!$obras || count($obras) === 0) {
    error_log("No s'han trobat obres per al PDF.");
} else {
    error_log("Obres trobades: " . count($obras));
}

// Usar la clase personalizada
$pdf = new MyPDF('P', 'mm', 'A3', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Apel·les Fenosa');
$pdf->SetTitle('Llistat d\'Obres');
$pdf->SetFont('helvetica', '', 10);
$pdf->setPrintHeader(true); // Habilitar el encabezado
$pdf->SetHeaderMargin(10); // Margen del encabezado

foreach ($obras as $obra) {
    $numeroRegistro = $obra['numero_registro']; // Obtener el número de registro
    error_log("Número de Registre: " . $obra['numero_registro']); // Log para depuración

    // Establecer el texto del encabezado para esta página
    $pdf->setHeaderText('Número de Registre: ' . $numeroRegistro);

    // Agregar una nueva página
    $pdf->AddPage();



    // Afegir imatge si està disponible
    if (!empty($obra['imagen_url'])) {
        $pdf->Image($obra['imagen_url'], '', '', 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    } else {
        $pdf->Image('images/login/default.png', '', '', 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    }

    $pdf->Ln(55); // Espai després de la imatge
    
    // Crear taula en HTML
    $html = '<table border="1" cellpadding="10" style="width:100%;">
                <tr>
                    <td><b>Número de Registre:</b> ' . $obra['numero_registro'] . '</td>
                    <td ><b>Classificació Genèrica:</b> ' . $obra['texto_clasificacion'] . '</td>
                    <td ><b>Col·lecció de procedència:</b> ' . $obra['coleccion_procedencia'] . '</td>
                </tr>
                <tr>
                    <td><b>Alçada màxima:</b> ' . $obra['maxima_altura'] . '</td>
                    <td><b>Amplada màxima:</b> ' . $obra['maxima_anchura'] . '</td>
                    <td><b>Profunditat màxima:</b> ' . $obra['maxima_profundidad'] . '</td>
                </tr>
                <tr>
                    <td><b>Material:</b> ' . $obra['texto_material'] . '</td>
                    <td><b>Tècnica: </b>' . $obra['texto_tecnica'] . '</td>
                    <td><b>Autor: </b>' . $obra['nombre_autor'] . '</td>
                </tr>
                <tr>
                    <td><b>Títol:</b> ' . $obra['titulo'] . '</td>
                    <td><b>Any Inici:</b> ' . $obra['ano_inicio'] . '</td>
                    <td><b>Any Final:</b> ' . $obra['ano_final'] . '</td>
                </tr>
                <tr>
                    <td><b>Datació:</b> ' . $obra['nombre_datacion'] . '</td>
                    <td><b>Ubicació:</b> ' . $obra['ubicacion'] . '</td>
                    <td><b>Data de registre:</b> ' . $obra['fecha_registro'] . '</td>
                </tr>
                <tr>
                    <td><b>Número d\'exemplars:</b> ' . $obra['numero_ejemplares'] . '</td>
                    <td><b>Forma d\'ingrés:</b> ' . $obra['texto_forma_ingreso'] . '</td>
                    <td><b>Data d\'ingrés:</b> ' . $obra['fecha_ingreso'] . '</td>
                </tr>
                <tr>
                    <td><b>Font d\'ingrés: </b>' . $obra['fuente_ingreso'] . '</td>
                    <td><b>Baixa:</b> ' . $obra['baja'] . '</td>
                    <td><b>Causa de baixa:</b> ' . $obra['causa_baja'] . '</td>
                </tr>
                <tr>
                    <td><b>Data de baixa:</b> ' . $obra['fecha_baja'] . '</td>
                    <td><b>Persona autoritzada baixa:</b> ' . $obra['persona_aut_baja'] . '</td>
                    <td><b>Estat de conservació: </b>' . $obra['nombre_estado'] . '</td>
                </tr>
                <tr>
                    <td><b>Lloc d\'execució:</b> ' . $obra['lugar_ejecucion'] . '</td>
                    <td><b>Lloc de procedència:</b> ' . $obra['lugar_procedencia'] . '</td>
                    <td><b>Nº Tiratge:</b> ' . $obra['num_tirada'] . '</td>
                </tr>
                <tr>
                    <td><b>Altres números d\'identificació:</b> ' . $obra['otros_num_id'] . '</td>
                    <td><b>Valoració econòmica:</b> ' . $obra['valoracion_econ'] . ' €</td>
                    <td><b>Exposicions:</b> ' . $obra['exposicion'] . '</td>
                </tr>
                <tr>
                   <td colspan="3"  style="height:150px;" ><b>Bibliografia:</b> ' . $obra['bibliografia'] . '</td>
                </tr>
                
                <tr>
                    <td colspan="3" style="height:150px;" ><b>Descripció:</b> ' . $obra['descripcion'] . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="height:150px;" ><b>Història de l\'obra:</b> ' . $obra['historia_obra'] . '</td>
                </tr>
            </table>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
}

$pdf->Output('llistat_obres.pdf', 'I');
