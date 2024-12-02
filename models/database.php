<?php

class Database {
    private $db;

    public function conectar() {
        if ($this->db === null) {
            $config = $this->configBBDD();

            try {
                $this->db = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']}",
                    $config['username'],
                    $config['password']
                );
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Connexió a la base dades fallida " . $e->getMessage());
                throw new Exception("Error en la connexió de la base de dades");
            }
        }

        return $this->db;
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
