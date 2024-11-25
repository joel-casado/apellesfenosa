<?php

require_once 'models/PrestecModel.php';
require_once 'vendor/autoload.php'; // PhpOffice\PhpWord

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class PrestecController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new PrestecModel($db);
    }


    public function procesarFormulario()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación y obtención de datos del formulario
            $datos = [
                'institucion_solicitante' => $_POST['institucion_solicitante'],
                'responsable_prestamo'    => $_POST['responsable_prestamo'],
                'cargo'                   => $_POST['cargo'],
                'exposicion'              => $_POST['exposicion'],
                'lugar'                   => $_POST['lugar'],
                'fecha_prestacion'        => $_POST['fecha_prestacion'],
                'fecha_devolucion'        => $_POST['fecha_devolucion'],
                'numero_registro'         => $_POST['numero_registro'],
                'nombre_objeto'           => $_POST['nombre_objeto'],
                'dimensiones'             => $_POST['dimensiones'],
                'materiales'              => $_POST['materiales'],
                'datacion'                => $_POST['datacion'],
                'direccion_recogida'      => $_POST['direccion_recogida'],
                'direccion_devolucion'    => $_POST['direccion_devolucion'],
                'telefono_recogida'       => $_POST['telefono_recogida'],
                'telefono_devolucion'     => $_POST['telefono_devolucion'],
                'observaciones'           => $_POST['observaciones']
            ];

            try {
                if ($this->model->guardarPrestec($datos)) {
                    $registro = $this->model->obtenerUltimoRegistro();
                    $this->generarWord($registro);
                } else {
                    throw new Exception("Error al guardar los datos en la base de datos.");
                }
            } catch (Exception $e) {
                echo "Ocurrió un error: " . $e->getMessage();
            }
            
        }else {
            require_once 'views/prestec/prestec.php';
        }
    }

    public function generarWord($registro)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Agregar contenido al documento
        $section->addText("Formulario de Préstec");
        $section->addText("Institución solicitante: " . $registro['institucion_solicitante']);
        $section->addText("Responsable del préstamo: " . $registro['responsable_prestamo']);
        $section->addText("Cargo: " . $registro['cargo']);
        $section->addText("Exposición: " . $registro['exposicion']);
        $section->addText("Lugar: " . $registro['lugar']);
        $section->addText("Fecha Inicio: " . $registro['fecha_prestacion']);
        $section->addText("Fecha Final: " . $registro['fecha_devolucion']);
        $section->addText("Número de registro: " . $registro['numero_registro']);
        $section->addText("Nombre del objeto: " . $registro['nombre_objeto']);
        $section->addText("Dimensiones: " . $registro['dimensiones']);
        $section->addText("Materiales: " . $registro['materiales']);
        $section->addText("Datación: " . $registro['datacion']);
        $section->addText("Dirección de recogida: " . $registro['direccion_recogida']);
        $section->addText("Dirección de devolución: " . $registro['direccion_devolucion']);
        $section->addText("Teléfono recogida: " . $registro['telefono_recogida']);
        $section->addText("Teléfono devolución: " . $registro['telefono_devolucion']);
        $section->addText("Observaciones: " . $registro['observaciones']);

        // Guardar el documento temporalmente
        $tempFile = tempnam(sys_get_temp_dir(), 'prestec') . '.docx';
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        // Forzar la descarga del archivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="FormularioPrestec.docx"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($tempFile));
        readfile($tempFile);

        // Eliminar el archivo temporal
        unlink($tempFile);
        exit;
    }
}
