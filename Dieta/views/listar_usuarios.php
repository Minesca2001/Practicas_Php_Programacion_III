<link rel="stylesheet" href="../css/style.css">
<?php

require_once "../config/auth.php";
require_once "../config/roles.php";

esAdmin();


require_once "../models/Usuario.php";

$usuario = new Usuario();
$usuarios = $usuario->listar();

?>

<div class="dashboard">

    <h2>Lista de Usuarios</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>

        <?php foreach ($usuarios as $u) { ?>

            <tr>
                <td><?php echo $u["id"]; ?></td>
                <td><?php echo $u["nombre"]; ?></td>
                <td><?php echo $u["email"]; ?></td>
                <td><?php echo $u["rol"]; ?></td>
            </tr>

        <?php } ?>

    </table>

</div>