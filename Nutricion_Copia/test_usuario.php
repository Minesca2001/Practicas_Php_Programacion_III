<?php

require_once "config/conexion.php";
require_once "models/Usuario.php";

$modelo = new Usuario($conexion);

// INSERTAR USUARIO
$modelo->insertar(
    "Juan Perez",
    "juan@test.com",
    70,
    1.75,
    "Masculino",
    "Moderado",
    "Mantener"
);


// CONSULTAR USUARIOS
$usuarios = $modelo->obtenerUsuarios();

echo "<h2>Usuarios registrados</h2>";

foreach ($usuarios as $u) {

    echo $u["nombre"] . " - " . $u["email"] . "<br>";

}

?>