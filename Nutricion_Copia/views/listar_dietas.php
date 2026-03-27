<?php

require_once "../models/Dieta.php";

$datos = $dieta->listar();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Lista de Dietas</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <h2>Lista de Dietas</h2>

    <table>

        <tr>
            <th>Nombre</th>
            <th>Calorias</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($datos as $fila) { ?>

            <tr>
                <td>
                    <?php echo $fila["nombre"]; ?>
                </td>

                <td>
                    <?php echo $fila["calorias"]; ?>
                </td>

                <td>
                    <?php echo $fila["descripcion"]; ?>
                </td>
                <td>
                    <a href="editar_usuario.php?id=<?php echo $fila['id']; ?>">
                        <button class="btn-editar">Editar</button>
                    </a>

                    <a href="../controllers/EliminarUsuarioController.php?id=<?php echo $fila['id']; ?>">
                        <button class="btn-eliminar">Eliminar</button>
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>