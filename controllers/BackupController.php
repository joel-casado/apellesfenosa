<?php

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
        // Verificar si el usuario está autenticado y tiene permisos
        if (!isset($_SESSION['admin'])) {
            $_SESSION['error'] = 'No tienes permisos para realizar esta acción';
            header("Location: index.php?controller=Login&action=verLogin");
            exit();
        }
    
        // Llamar al modelo para crear la copia de seguridad
        $backupModel = new BackupModel();
        $backupFile = $backupModel->backupDatabase();
    
        if ($backupFile && file_exists($backupFile)) {
            // Configurar las cabeceras para la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/sql');
            header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backupFile));
            flush(); // Limpiar el buffer del sistema
            readfile($backupFile); // Leer el archivo y enviarlo al navegador
    
            // Eliminar el archivo después de la descarga (opcional)
            unlink($backupFile);
            exit();
        } else {
            $_SESSION['error'] = 'Error al crear la copia de seguridad o el archivo no existe.';
            header("Location: index.php?controller=Obras&action=verObras");
            exit();
        }
    }
}
?>