<?php

require_once "../config/conexion.php";

class Alimento
{

    public function obtenerPorTipo($tipo)
    {

        global $conexion;

        $sql = "SELECT * FROM alimentos WHERE tipo=? ORDER BY RAND() LIMIT 2";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$tipo]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>