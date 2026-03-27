<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
</head>

<body>
    <?php require_once "../config/auth.php"; ?>

    <div class="layout">

        <!-- Sidebar -->
        <div class="sidebar">

            <h2>Nutrición</h2>

            <p><?php echo $_SESSION["nombre"]; ?></p>

            <a href="dashboard.php">Inicio</a>
            <a href="../controllers/MenuController.php">Menú</a>
            <a href="generar_dieta.php">Dietas</a>
            <a href="listar_dietas.php">Historial Dietas</a>
            <a href="historial.php">Historial Dietas</a>
            <?php if ($_SESSION["rol"] == "admin") { ?>
                <a href="listar_usuarios.php">Usuarios</a>
            <?php } ?>
            <a href="../controllers/LogoutController.php">Salir</a>

        </div>

        <!-- Contenido -->
        <div class="contenido">

            <h1>Bienvenido al sistema
                <?php echo $_SESSION["nombre"]; ?>
                </p>
            </h1>

            <p>Selecciona una opción del menú</p>

        </div>

    </div>
</body>

</html>