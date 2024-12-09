<?php
require 'vendor/autoload.php'; // Carga las dependencias instaladas por Composer

use Spatie\DbDumper\Databases\MySql;

try {
    $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

    MySql::create()
        ->setHost('localhost')         // Cambia según tu configuración
        ->setDbName('apellesfenosa')   // Nombre de tu base de datos
        ->setUserName('root')          // Usuario de la base de datos
        ->setPassword('')              // Contraseña de la base de datos
        ->dumpToFile($backupFile);

    echo "Backup creado con éxito: $backupFile";
} catch (Exception $e) {
    echo "Error al realizar el backup: " . $e->getMessage();
}
?>