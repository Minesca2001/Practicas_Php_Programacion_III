<?php
require_once "../middleware/auth.php";
?>
<h2>Bienvenido
    <?php echo $_SESSION["nombre"]; ?>
    <!DOCTYPE html>
    <html>


    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Dashboard</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='../style.css'>
        </he ad>
        <div class="sidebar">
            <a href="#">📊 Dashboard</a>
            <a href="../views/listar_usuarios.php">👤 Usuarios</a>
            <a href="../">⚙️ Configuración</a>
            <a href="../controllers/LogoutController.php">Cerrar sesión</a>

        </div>

        <style>
            /* C SS */
            .sidebar {
                height: 100vh;
                width: 200px;
                position: fixed;
                left: 0;
                top: 0;
                background-color: #111;
                padding-top: 20px;
            }

            .sidebar a {
                padding: 15px;
                text-decoration: none;
                color: #818181;
                display: block;
            }

            .sidebar a:hover {
                color: white;
                background-color: #222;
            }
        </style>

    <body>
        <div class="container">

            <a href="../controllers/LogoutController.php">Cerrar sesión</a>
        </div>
    </body>

    </html>