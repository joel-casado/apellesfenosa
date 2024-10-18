<?php

class MaterialesController {
    private $conn;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->conn = (new Database())->conectar();
    }

    // Método que obtiene los materiales y los pasa a la vista
    public function mostrarMateriales() {
        // Instanciamos el modelo y pasamos la conexión
        $materialModel = new MaterialModel($this->conn);

        // Obtenemos los materiales desde el modelo
        $materiales = $materialModel->getMateriales();

        // Pasamos los datos a la vista
        require_once "views/vocabulario/materiales/material.php";
    }

    // Método para actualizar el material
    public function actualizar() {
        // Recibir datos del formulario
        $codigo_getty_material = $_POST['codigo_getty_material'];
        $texto_material = $_POST['texto_material'];

        // Instanciar el modelo
        $materialModel = new MaterialModel($this->conn);

        // Llamar al método del modelo para actualizar el material
        $resultado = $materialModel->actualizarMaterial($codigo_getty_material, $texto_material);

        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el material.";
        }
    }

    public function crearMaterial() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $codigo_getty_material = $_POST['codigo_getty_material'];
            $texto_material = $_POST['texto_material'];
    
            // Instanciar el modelo
            $MaterialesModel = new MaterialModel($this->conn);
    
            // Insertar el nuevo autor en la base de datos
            $resultado = $MaterialesModel->crearMaterial($codigo_getty_material, $texto_material);
    
            // Redirigir a la lista de autores si la inserción fue exitosa
            if ($resultado) {
                header("Location: index.php?controller=Materiales&action=mostrarMateriales");
                exit();
            } else {
                echo "Error al agregar el material.";
            }
        } else {
            // Si no es una petición POST, simplemente mostrar el formulario
            require_once "views/vocabulario/materiales/crear_material.php";
        }
    }


    public function deshabilitar() {
        $codigo_getty_material = $_GET['id'];
        
        $materialModel = new materialModel($this->conn);
        $resultado = $materialModel->deshabilitarmaterial($codigo_getty_material);
        
        if ($this->esAjax()) {
            header('Content-Type: application/json');
            if ($resultado) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al deshabilitar material.']);
            }
            exit();
        } else {
            if ($resultado) {
                header("Location: index.php?controller=materiales&action=mostrarmateriales");
                exit();
            } else {
                echo "Error al deshabilitar la técnica.";
            }
        }
    }
    
    // Método para verificar si es una petición AJAX
    private function esAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public function mostrarFormulario() {
        // Capturar el ID de la URL 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el 'id' desde la URL
    
            // Obtener los valores desde el modelo utilizando el ID
            $MaterialModel = new MaterialModel($this->conn);
            $material = $MaterialModel->obtenerMaterial($id);  // Suponemos que este método obtiene la obra completa
    
            // Validar si se encontró la obra
            if ($material) {
                // Cargar la vista de edición con los datos de la obra
                require_once 'views/vocabulario/materiales/editar_vocabulario.php';
            } else {
                echo "Obra no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
    
    
    



}
