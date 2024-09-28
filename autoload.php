<?php

function autocargar($nombreClase){
    // Directories to search for classes
    $directories = ['controllers', 'models', 'core'];

    foreach ($directories as $directory) {
        $file = "$directory/$nombreClase.php";

         // Depuración: imprime las rutas que se están buscando
         error_log("Buscando: $file");


        if (file_exists($file)) {
            include $file;
            return;
        }
    }
    
    // If the file is not found, throw an error for easier debugging
    throw new Exception("File for class $nombreClase not found.");
}
spl_autoload_register("autocargar");

?>
