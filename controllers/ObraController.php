
<?php

class ObrasController {
    
    public function verObras() {
        // Crear una instancia de la clase de base de datos para obtener la conexión
        $db = (new Database())->conectar();  // Asegúrate de que el método conectar() devuelve un objeto PDO

        // Crear instancia de ObrasModel y pasarle la conexión a la base de datos
        $obrasModel = new ObrasModel($db);

        // Obtener las obras desde el modelo
        $obras = $obrasModel->getObras();

        // Cargar la vista y pasarle los datos de las obras
        require_once "views/obras/obras.php";
    }
}
