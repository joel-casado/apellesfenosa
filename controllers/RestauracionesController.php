<?php

class RestauracionesController
{
    private $db;

    public function __construct() {
        // Inicializar la conexión a la base de datos
        $this->db = (new Database())->conectar();
    }

    public function restauraciones()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = intval($_GET['id']);
            require_once 'models/ObrasModel.php';

            $obraModel = new ObrasModel($this->db);

            // Obtener información de la obra
            $obra = $obraModel->obtenerObra($id);
            if (!$obra) {
                echo "Error: La obra no existe.";
                return;
            }

            $imagen_url = $obraModel->obtenerImagen($id);

            // Depuración: Verificar URL de imagen en consola del navegador
            echo "<script>console.log('URL de imagen en el controlador: " . htmlspecialchars($imagen_url) . "');</script>";

            require_once 'views/Restauraciones/restauraciones.php';
        } else {
            echo "Error: ID no proporcionado o no válido.";
        }
    }

    public function formularioCrearRestauracion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario es administrador
        if (empty($_SESSION['admin'])) {
            header("Location: index.php?controller=Obras&action=verObras");
            exit();
        }

        require_once "views/Restauraciones/crearRestauracion.php";
    }

    public function crearRestauracion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar datos del formulario
            $numero_registro = $_POST['numero_registro'] ?? null;
            $codigo_restauracion = $_POST['codigo_restauracion'] ?? null;
            $fecha_inicio_restauracion = $_POST['fecha_inicio_restauracion'] ?? null;
            $fecha_fin_restauracion = $_POST['fecha_fin_restauracion'] ?? null;
            $comentario_restauracion = $_POST['comentario_restauracion'] ?? null;
            $nombre_restaurador = $_POST['nombre_restaurador'] ?? null;
    
            // Verificar si el numero_registro existe en la tabla obras
            $obraModel = new ObrasModel($this->db);
            $obra = $obraModel->obtenerObra($numero_registro);
            
            if (!$obra) {
                echo "Error: El número de registro de la obra no existe.";
                return;
            }
    
            // Verificar campos obligatorios
            if (!$codigo_restauracion || !$fecha_inicio_restauracion || !$comentario_restauracion || !$nombre_restaurador) {
                echo "Error: Todos los campos obligatorios deben ser completados.";
                return;
            }
    
            try {
                // Insertar los datos en la base de datos
                require_once 'models/RestauracionesModel.php';
                $restauracionesModel = new RestauracionesModel($this->db);
                $resultado = $restauracionesModel->crearRestauracion(
                    $numero_registro,
                    $codigo_restauracion,
                    $fecha_inicio_restauracion,
                    $fecha_fin_restauracion, // Puede ser NULL
                    $comentario_restauracion,
                    $nombre_restaurador
                );
    
                if ($resultado) {
                    echo "Restauración creada correctamente.";
                } else {
                    echo "Error al crear la restauración.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error: Método no permitido.";
        }
    }
    
}
