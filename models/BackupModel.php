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
            // Configuración de la base de datos y generación del respaldo
            MySql::create()
                ->setHost('localhost')         // Cambia esto según tu configuración
                ->setDbName('apellesfenosa')   // Nombre de tu base de datos
                ->setUserName('root')          // Usuario de la base de datos
                ->setPassword('')              // Contraseña de la base de datos
                ->dumpToFile($backupFile);

            return $backupFile;
        } catch (Exception $e) {
            error_log("Error al realizar el respaldo: " . $e->getMessage());
            return false;
        }
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



