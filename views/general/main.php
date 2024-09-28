<?php
require_once 'controllers/ObraController.php';

$controller = new ObraController();
$obras = $controller->mostrarTodas(); // Llama al método para obtener las obras

echo "<h1>Lista de Obras</h1>";
echo "<table border='1'>";
echo "<thead>
        <tr>
            <th>Número de Registro</th>
            <th>Nombre del Objeto</th>
            <th>Título</th>
            <th>Año de Inicio</th>
            <th>Año Final</th>
            <th>Descripción</th>
        </tr>
      </thead>
      <tbody>";

foreach ($obras as $obra) {
    echo "<tr>";
    echo "<td>" . $obra['numero_registro'] . "</td>";
    echo "<td>" . $obra['nombre_objeto'] . "</td>";
    echo "<td>" . $obra['titulo'] . "</td>";
    echo "<td>" . $obra['ano_inicio'] . "</td>";
    echo "<td>" . $obra['ano_final'] . "</td>";
    echo "<td>" . $obra['descripcion'] . "</td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
