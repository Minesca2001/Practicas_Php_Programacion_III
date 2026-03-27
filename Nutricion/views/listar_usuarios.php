<?php
require_once "../middleware/auth.php";
require_once "../models/Usuario.php";

$usuario = new Usuario();
$datos = $usuario->listar();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Lista de Usuarios</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 30px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #4facfe;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-dieta {
            background: #28a745;
            color: white;
        }

        .btn-editar {
            background: #ffc107;
        }

        .btn-eliminar {
            background: #dc3545;
            color: white;
        }
    </style>

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

                    <a href="../controllers/GenerarDietaController.php?id=<?php echo $fila['id']; ?>">
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