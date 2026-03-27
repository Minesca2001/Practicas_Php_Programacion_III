<?php

$host = "localhost";
$db = "bd_dieta";
$user = "root";
$pass = "";

try {

    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}

?>