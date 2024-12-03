<?php

class BackupModel extends Database {

    private $db;
    public function __construct() {
        $this->db = $this->conectar(); // Conectar a la base de datos
    }

    public function backupDatabase() {
        // Obtener la configuración de la base de datos
        $config = $this->configBBDD();
        $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

        // Comando para crear la copia de seguridad
        $command = sprintf(
            'mysqldump --opt -h %s -u %s -p%s %s > %s',
            escapeshellarg($config['host']),
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['dbname']),
            escapeshellarg($backupFile)
        );

        // Ejecutar el comando
        system($command, $output);

        // Verificar si hubo un error
        if ($output !== 0) {
            error_log("Error al ejecutar el comando de copia de seguridad: " . $output);
            return false;
        }

        return true; // Retorna verdadero si la copia de seguridad fue exitosa
    }
    
    private function configBBDD() {
        return [
            'host' => 'localhost',
            'dbname' => 'apellesfenosa',
            'username' => 'root',
            'password' => '',
        ];
    }
}
?>