<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();
$datos = $usuario->listar();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <h2>Lista de Usuarios</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($datos as $fila) { ?>

            <tr>

                <td><?php echo $fila["id"]; ?></td>

                <td><?php echo $fila["nombre"]; ?></td>

                <td><?php echo $fila["email"]; ?></td>

                <td><?php echo $fila["peso"]; ?></td>

                <td><?php echo $fila["altura"]; ?></td>

                <td>

                    <a href="../controllers/GenerarDietaController.php?id=<?php echo $fila['nombre']; ?>">
                        <button class="btn-dieta">Generar Dieta</button>
                    </a>

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