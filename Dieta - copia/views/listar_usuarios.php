<?php require_once "../config/auth.php"; ?>
<?php
require_once "../models/Usuario.php";
$usuario = new Usuario();
$usuarios = $usuario->listar();
?>

<!DOCTYPE html>
<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <h2 class="mb-4">Lista de Usuarios</h2>

        <table class="table table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($usuarios as $u) { ?>

                    <tr>
                        <td><?php echo $u["id"]; ?></td>
                        <td><?php echo $u["nombre"]; ?></td>
                        <td><?php echo $u["email"]; ?></td>
                        <td><?php echo $u["rol"]; ?></td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>