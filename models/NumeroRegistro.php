<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

error_log("Iniciando ObtenerNumeroRegistro.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Método POST recibido.");

    // Decodificar el JSON recibido
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Datos recibidos en JSON: " . print_r($data, true));

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Error al decodificar JSON: " . json_last_error_msg());
        echo json_encode(["success" => false, "message" => "Error al decodificar JSON."]);
        exit();
    }

    error_log("Datos recibidos después de decodificar: " . print_r($data, true));

    // Incluir las clases necesarias
    require_once "ObrasModel.php";
    require_once "Database.php";
    error_log("Clases ObrasModel y Database incluidas.");

    // Crear una instancia de la clase Database y obtener la conexión
    $database = new Database();
    error_log("Instancia de Database creada.");

    $db = $database->conectar();  // Obtener la conexión a la base de datos
    error_log("Conexión a la base de datos establecida.");

    if (!$db) {
        error_log("Error al conectar con la base de datos.");
        echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
        exit();
    }

    // Pasar la conexión al modelo
    $obras = new ObrasModel($db);
    error_log("Instancia de ObrasModel creada.");

    if (isset($data['letra'])) {
        $letra = $data['letra'];
        error_log("Letra recibida: $letra");

        // Obtener el último número de registro para la letra proporcionada
        $resultado = $obras->obtenerUltimoNumeroRegistro($letra);
        error_log("Resultado de obtenerUltimoNumeroRegistro: " . print_r($resultado, true));

        if (isset($resultado['numero_registro'])) {
            $numeroMaximo = $resultado['numero_registro'];
            error_log("Número máximo encontrado: $numeroMaximo");

            // Guardar el número de registro en una variable
            $numeroRegistroCompleto = $numeroMaximo;
            error_log("Número de registro completo: $numeroRegistroCompleto");

            // Separar la letra, el número y los decimales
            $letra = substr($numeroRegistroCompleto, 0, 1); // Obtener la primera letra
            $resto = substr($numeroRegistroCompleto, 1);    // Obtener el resto del número
            $partes = explode('.', $resto);                 // Separar el número y los decimales

            if (count($partes) === 2) {
                $numero = $partes[0];
                $decimal = $partes[1];
                error_log("Partes separadas: letra=$letra, numero=$numero, decimal=$decimal");

                // Incrementar el número y los decimales según corresponda
                if ($decimal < 99) {
                    $decimal = str_pad($decimal + 1, 2, '0', STR_PAD_LEFT); // Incrementar decimales
                } else {
                    $decimal = '00'; // Reiniciar decimales
                    if ($numero < 9999) {
                        $numero = str_pad($numero + 1, 4, '0', STR_PAD_LEFT); // Incrementar número
                    } else {
                        $numero = '0001'; // Reiniciar número
                        $letra = chr(ord($letra) + 1); // Cambiar a la siguiente letra
                    }
                }

                // Formar el nuevo número de registro
                $nuevoNumeroRegistro = $letra . $numero . '.' . $decimal;
                error_log("Nuevo número de registro recomendado: $nuevoNumeroRegistro");

                echo json_encode([
                    "numero_registro_recomendado" => $nuevoNumeroRegistro
                ]);
            } else {
                error_log("Error: El número de registro no tiene el formato esperado.");
                echo json_encode([
                    "numero_registro_recomendado" => ""
                ]);
            }
        } else {
            error_log("No se encontró un número de registro para la letra proporcionada.");
            echo json_encode([
                "numero_registro_recomendado" => ""
            ]);
        }
    } else {
        error_log("Parámetros inválidos recibidos.");
        echo json_encode([
            "numero_registro_recomendado" => ""
        ]);
    }
}
?>