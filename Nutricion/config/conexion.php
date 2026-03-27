<?php

$host = "localhost";
$bd = "bd_dieta";
$usuario = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo "Error de conexion: " . $e->getMessage();

}

?>