<?php

function esAdmin()
{

    if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != "admin") {

        echo "Acceso denegado";
        exit();

    }

}

?>