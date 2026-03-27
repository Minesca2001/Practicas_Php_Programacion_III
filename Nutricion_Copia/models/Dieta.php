<?php

require_once "../config/conexion.php";

class Dieta
{

    public function dieta($usuario_id, $calorias, $descripcion)
    {

        global $conexion;

        $sql = "INSERT INTO dietas
        (usuario_id, calorias, descripcion)
        VALUES (?,?,?)";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$usuario_id, $calorias, $descripcion]);

    }

    public function listar()
    {

        global $conexion;

        $sql = "SELECT dietas.id,
                       usuarios.nombre,
                       dietas.calorias,
                       dietas.descripcion,
                       dietas.fecha
                FROM dietas
                INNER JOIN usuarios
                ON dietas.usuario_id = usuarios.id";

        return $conexion->query($sql);

    }

}
?>