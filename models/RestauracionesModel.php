<?php

class RestauracionesModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function crearRestauracion($numero_registro, $codigo_restauracion, $fecha_inicio_restauracion, $fecha_fin_restauracion, $comentario_restauracion, $nombre_restaurador)
    {
        // Mostrar valores enviados para depuración
        error_log("Datos enviados al modelo:");
        error_log("numero_registro: " . $numero_registro);
        error_log("codigo_restauracion: " . $codigo_restauracion);
        error_log("fecha_inicio_restauracion: " . $fecha_inicio_restauracion);
        error_log("fecha_fin_restauracion: " . $fecha_fin_restauracion);
        error_log("comentario_restauracion: " . $comentario_restauracion);
        error_log("nombre_restaurador: " . $nombre_restaurador);

        // Incluir numero_registro en la consulta SQL
        $sql = "INSERT INTO restauraciones (numero_registro, codigo_restauracion, fecha_inicio_restauracion, fecha_fin_restauracion, comentario_restauracion, nombre_restaurador)
                VALUES (:numero_registro, :codigo_restauracion, :fecha_inicio_restauracion, :fecha_fin_restauracion, :comentario_restauracion, :nombre_restaurador)";

        $stmt = $this->conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':numero_registro', $numero_registro);
        $stmt->bindParam(':codigo_restauracion', $codigo_restauracion);
        $stmt->bindParam(':fecha_inicio_restauracion', $fecha_inicio_restauracion);
        $stmt->bindParam(':fecha_fin_restauracion', $fecha_fin_restauracion);
        $stmt->bindParam(':comentario_restauracion', $comentario_restauracion);
        $stmt->bindParam(':nombre_restaurador', $nombre_restaurador);

        // Ejecutar consulta
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error en la consulta SQL: " . print_r($stmt->errorInfo(), true));
            return false;
        }
    }
    public function obtenerObra($numero_registro)
    {
        $sql = "SELECT * FROM restauraciones WHERE numero_registro = :numero_registro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve la obra si existe
    }
    public function obtenerRestauracionesPorNumeroRegistro($numero_registro)
    {
        $sql = "SELECT * FROM restauraciones WHERE numero_registro = :numero_registro";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':numero_registro', $numero_registro, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array con las restauraciones
    }



}
