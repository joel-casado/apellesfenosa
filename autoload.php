<?php

function autocargar($nombreClase) {
    // Directoris base que mira
    $baseDirectories = ['controllers', 'models', 'core'];

    // Normalització de noms i espais
    $normalizedClassName = str_replace("\\", DIRECTORY_SEPARATOR, $nombreClase);

    foreach ($baseDirectories as $directory) {
        $file = "$directory/$normalizedClassName.php";

        if (file_exists($file)) {
            include $file;
            return;
        }
    }

    // Loggeja error i mostra excepció
    error_log("No s'ha trobat cap archiu de la clase: $nombreClase");
    throw new Exception("Autoload fallat: La classe $nombreClase no s'ha trobat.");
}

// Registra l'autoloader
spl_autoload_register("autocargar");
?>
