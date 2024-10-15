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
        require_once "views/vocabulario/material.php";
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
            header("Location: views/vocabulario/material.php");  // Redirige de vuelta a la página de obras
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al actualizar el material.";
        }
    }

    public function crearMaterial() {
        // Recibir datos del formulario
        $codigo_getty_material = $_POST['codigo_getty_material'];
        $texto_material = $_POST['texto_material'];
    
        // Instanciar el modelo
        $materialModel = new MaterialModel($this->conn);
    
        // Llamar al método del modelo para insertar el nuevo material
        $resultado = $materialModel->crearMaterial($codigo_getty_material, $texto_material);
    
        // Redirigir a una página de confirmación o de listado
        if ($resultado) {
            header("Location: views/vocabulario/material.php");  // Redirige a la lista de materiales
            exit(); // Asegúrate de usar exit después de redirigir
        } else {
            echo "Error al agregar el material.";
        }
    }


    public function deshabilitar() {
        $codigo_getty_material = $_GET['id'];  // Asegúrate de que el id se pase correctamente en la URL
    
        $materialModel = new MaterialModel($this->conn);
        $resultado = $materialModel->deshabilitarMaterial($codigo_getty_material);
    
        // Redirigir a la lista de materiales después de deshabilitar
        if ($resultado) {
            header("Location: views/vocabulario/ver_vocabulario.php"); // Cambia esta ruta según tu estructura
            exit();
        } else {
            echo "Error al deshabilitar el material.";
        }
    }
    
    



}
