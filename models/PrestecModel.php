<?php

class PrestecModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db; // Inyección de dependencia de la conexión a la base de datos
    }

    public function guardarPrestec($datos)
    {
    

        $query = "INSERT INTO prestamos (
            institucion_solicitante, responsable_prestamo, cargo, 
            exposicion, lugar, fecha_prestacion, fecha_devolucion, numero_registro, 
            nombre_objeto, dimensiones, materiales, datacion, 
            direccion_recogida, direccion_devolucion, telefono_recogida, 
            telefono_devolucion, observaciones
        ) VALUES (
            :institucion_solicitante, :responsable_prestamo, :cargo, 
            :exposicion, :lugar, :fecha_prestacion, :fecha_devolucion, :numero_registro, 
            :nombre_objeto, :dimensiones, :materiales, :datacion, 
            :direccion_recogida, :direccion_devolucion, :telefono_recogida, 
            :telefono_devolucion, :observaciones
        )";

        $stmt = $this->db->prepare($query);


        return $stmt->execute([
            ':institucion_solicitante' => $datos['institucion_solicitante'],
            ':responsable_prestamo'    => $datos['responsable_prestamo'],
            ':cargo'                   => $datos['cargo'],
            ':exposicion'              => $datos['exposicion'],
            ':lugar'                   => $datos['lugar'],
            ':fecha_prestacion'        => $datos['fecha_prestacion'],
            ':fecha_devolucion'        => $datos['fecha_devolucion'],
            ':numero_registro'         => $datos['numero_registro'],
            ':nombre_objeto'           => $datos['nombre_objeto'],
            ':dimensiones'             => $datos['dimensiones'],
            ':materiales'              => $datos['materiales'],
            ':datacion'                => $datos['datacion'],
            ':direccion_recogida'      => $datos['direccion_recogida'],
            ':direccion_devolucion'    => $datos['direccion_devolucion'],
            ':telefono_recogida'       => $datos['telefono_recogida'],
            ':telefono_devolucion'     => $datos['telefono_devolucion'],
            ':observaciones'           => $datos['observaciones']
        ]);
    }

    public function obtenerUltimoRegistro()
    {
        $query = "SELECT * FROM prestamos ORDER BY id_prestamo DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
