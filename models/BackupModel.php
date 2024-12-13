<?php
require_once 'models/database.php';
require 'vendor/autoload.php'; 
use Spatie\DbDumper\Databases\MySql;

class BackupModel extends Database {
    private $db;

    public function __construct() {
        $this->db = $this->conectar();
    }

    public function backupDatabase() {
        $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

        try {
            // Generar el respaldo con Spatie\DbDumper
            MySql::create()
                ->setHost('localhost')         // Cambia esto según tu configuración
                ->setDbName('apellesfenosa')   // Nombre de tu base de datos
                ->setUserName('root')          // Usuario de la base de datos
                ->setPassword('')              // Contraseña de la base de datos
                ->dumpToFile($backupFile);

            // Agregar el comando CREATE DATABASE al inicio del archivo
            $this->prependCreateDatabase($backupFile, 'apellesfenosa');

            return $backupFile;
        } catch (Exception $e) {
            error_log("Error al realizar el respaldo: " . $e->getMessage());
            return false;
        }
    }

    private function prependCreateDatabase($backupFile, $databaseName) {
        // Comando CREATE DATABASE
        $createDatabaseCommand = "CREATE DATABASE IF NOT EXISTS `$databaseName`;\nUSE `$databaseName`;\n\n";

        // Leer el contenido actual del archivo
        $backupContent = file_get_contents($backupFile);
        if ($backupContent === false) {
            error_log("Error al leer el archivo de respaldo.");
            return false;
        }

        // Agregar el comando CREATE DATABASE al principio del contenido
        $updatedBackupContent = $createDatabaseCommand . $backupContent;

        // Escribir el contenido actualizado al archivo
        $writeResult = file_put_contents($backupFile, $updatedBackupContent);
        if ($writeResult === false) {
            error_log("Error al escribir el comando CREATE DATABASE en el archivo de respaldo.");
            return false;
        }

        return true;
    }

    private function configBBDD() {
        return [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname' => 'apellesfenosa',
        ];
    }
}

?>



