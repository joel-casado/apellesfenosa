<?php
class PrestecController {
    public function generarWord() {
        $model = new PrestecModel();
        $filePath = $model->crearDocumentoWord();

        if (file_exists($filePath)) {
            ob_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename="FormularioPrestamo.docx"');
            header('Cache-Control: max-age=0');
            readfile($filePath);
            unlink($filePath);
        } else {
            echo "Error al generar el archivo.";
        }
        exit();
    }
}

