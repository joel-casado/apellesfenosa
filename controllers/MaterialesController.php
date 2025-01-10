<?php

class MaterialesController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conectar();
    }

    public function mostrarMateriales() {
        $materialModel = new MaterialModel($this->conn);

        $materiales = $materialModel->getMateriales();

        require_once "views/vocabulario/materiales/material.php";
    }

    public function actualizar() {
        $codigo_getty_material = $_POST['codigo_getty_material'];
        $texto_material = $_POST['texto_material'];

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
        
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->deshabilitarMaterial($codigo_getty_material);
        
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");
            exit();
        } else {
            echo "Error al deshabilitar el material.";
        }
    }

    public function habilitar() {
        $codigo_getty_material = $_GET['id'];
        
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->habilitarMaterial($codigo_getty_material);
        
         // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: index.php?controller=Materiales&action=mostrarMateriales");
            exit();
        } else {
            echo "Error al habilitar el material.";
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
                require_once 'views/vocabulario/materiales/editar_material.php';
            } else {
                echo "Obra no encontrada.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }
}
?>
