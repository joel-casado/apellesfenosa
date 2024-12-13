<?php
require_once 'models/BackupModel.php';
    
    class BackupController {
        public function __construct() {
            $this->startSession();
        }
    
        private function startSession() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
        public function createBackup() {
            $backupModel = new BackupModel();
            $backupFile = $backupModel->backupDatabase();
    
            if ($backupFile && file_exists($backupFile)) {
                // Log para depuración
                error_log("Archivo de respaldo generado: $backupFile (Tamaño: " . filesize($backupFile) . " bytes)");
                // Configurar cabeceras para la descarga
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream'); // Tipo MIME genérico
                header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($backupFile));
    
                // Limpiar buffers y enviar archivo
                ob_clean();
                flush();
                readfile($backupFile);
    
                // Eliminar archivo después de la descarga
                unlink($backupFile);
                exit();
            } else {
                error_log("Error: No se pudo generar el archivo de respaldo o no existe.");
                $_SESSION['error'] = 'Error al crear la copia de seguridad.';
                header("Location: index.php?controller=Obras&action=verObras");
                exit();
            }
        }
    }
    ?>