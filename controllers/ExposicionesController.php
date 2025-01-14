<?php

class ExposicionesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Exposiciones();
    }

    public function listado_exposiciones() {
        $exposiciones = $this->modelo->getExposiciones();
        require_once 'views/exposiciones/listado_exposiciones.php';
    }

    public function anadirObra() {
        // Verificar que el id_exposicion esté en la URL
        if (isset($_GET['id_exposicion'])) {
            $id_exposicion = $_GET['id_exposicion'];
        } else {
            echo "Error: ID de exposición no válido.";
            exit();
        }
    
        // Verificar que se haya enviado el formulario y que haya obras seleccionadas
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exposicion_ids'])) {
            $obras = $_POST['exposicion_ids']; // Obtener las IDs de las obras seleccionadas
            
            // Verificar que el ID de la exposición no esté vacío
            if (empty($id_exposicion)) {
                echo "No se ha recibido el ID de la exposición.";
                return;
            }
    
            // Añadir cada obra a la exposición
            foreach ($obras as $numero_registro) {
                $this->modelo->addObraToExposicion($numero_registro, $id_exposicion);
            }
            echo "Obres afegides correctament.";
        }
    
        // Obtener las obras que no están adscritas a ninguna exposición
        $obras = $this->modelo->getObrasSinExposicion();
    
        // Cargar la vista y pasarle el id_exposicion
        require_once 'views/exposiciones/añadir_obra.php';
    }
    
    public function crea_expo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos del formulario
            $expo = [
                'exposicion' => $_POST['exposicion'],
                'inicio' => $_POST['inicio'],
                'fin' => $_POST['fin'],
                'tipo' => $_POST['tipo'],
                'lugar' => $_POST['lugar'],
            ];
    
            // Llamar al método para crear la exposición
            $this->modelo->createExposicion($expo);
    
            // Redirigir a la lista de exposiciones después de crear
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    
        // Si no es un POST, mostrar el formulario
        require_once 'views/exposiciones/crea_expo.php';
    }
    
    public function editar_expo() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $expo = $this->modelo->getExposicionById($id);
            require_once 'views/exposiciones/editar_expo.php';
        } else {
            // Manejar el caso en que no se proporciona un ID
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    }

    public function update() {
        if (isset($_POST['id_exposicion'])) {
            $id = $_POST['id_exposicion']; // ID obtenido del formulario
            $expo = [
                'exposicion' => $_POST['exposicion'],
                'inicio' => $_POST['inicio'],
                'fin' => $_POST['fin'],
                'tipo' => $_POST['tipo'],
                'lugar' => $_POST['lugar'],
            ]; // Recoge todos los datos del formulario
            $this->modelo->updateExposicion($id, $expo); // Actualiza la exposición
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones'); // Redirige a la lista
            exit();
        } else {
            // Manejar el caso en que no se proporciona un ID
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    }

    public function ver_obras() {
        if (isset($_GET['id'])) {
            $id_exposicion = $_GET['id'];
            // Llamar al método del modelo para obtener las obras
            $obras = $this->modelo->ver_obras($id_exposicion);
        } else {
            header('Location: index.php?controller=Exposiciones&action=listado_exposiciones');
            exit();
        }
    
        // Cargar la vista y pasarle los datos de las obras
        require_once "views/exposiciones/ver_obras.php";
    }

    public function generarPdf() {
        require_once('tcpdf/tcpdf.php');
    
        // Obtener las exposiciones desde el modelo
        $exposiciones = $this->modelo->getExposiciones(); // O datos filtrados si corresponde
    
        // Configuración básica de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Museu Apel·les Fenosa');
        $pdf->SetTitle('Listado de Exposiciones');
        $pdf->SetHeaderData('', 0, 'Listado de Exposiciones', '');
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
    
        // Crear el contenido del PDF
        $html = '<h1>Listado de Exposiciones</h1>
                <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Exposició</th>
                            <th>Data Inici</th>
                            <th>Data Fi</th>
                            <th>Tipus</th>
                            <th>Lloc</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($exposiciones as $expo) {
            $html .= '<tr>
                        <td>' . $expo['exposicion'] . '</td>
                        <td>' . $expo['id_exposicion'] . '</td>
                        <td>' . $expo['fecha_inicio_expo'] . '</td>
                        <td>' . $expo['fecha_fin_expo'] . '</td>
                        <td>' . $expo['tipo_exposicion'] . '</td>
                        <td>' . $expo['sitio_exposicion'] . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>';
    
        // Añadir el contenido al PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('listado_exposiciones.pdf', 'D'); // Descargar el PDF
        exit;
    }
    
    public function removeObra() {
        if (isset($_GET['id_exposicion']) && isset($_GET['numero_registro'])) {
            $id_exposicion = $_GET['id_exposicion'];
            $numero_registro = $_GET['numero_registro'];
            
            // Remove the obra from the exposición
            $this->modelo->removeObraFromExposicion($numero_registro);
            
            // Redirect back to the ver_obras page
            header("Location: index.php?controller=Exposiciones&action=ver_obras&id=$id_exposicion");
            exit();
        } else {
            echo "Error: ID de exposición o número de registro no válido.";
            exit();
        }
    }
}
?>