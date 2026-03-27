<?php

$host = "localhost";
$db = "nutricion";
$user = "root";
$pass = "";

try {

    $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo "Error de conexión: " . $e->getMessage();

}

?>