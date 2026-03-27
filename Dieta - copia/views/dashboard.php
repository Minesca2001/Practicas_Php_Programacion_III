<?php require_once "../config/auth.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            background: #212529;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #0d6efd;
        }

        .content {
            padding: 20px;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">

                <h4 class="text-center">Nutrición</h4>

                <p class="text-center"><?php echo $_SESSION["nombre"]; ?></p>

                <a href="dashboard.php">🏠 Inicio</a>
                <a href="../controllers/MenuController.php">🍽 Menú</a>
                <a href="generar_dieta.php">🔥 Dieta</a>
                <a href="listar_usuarios.php">👥 Usuarios</a>
                <a href="../controllers/LogoutController.php">🚪 Salir</a>

            </div>

            <!-- Contenido -->
            <div class="col-md-9 col-lg-10 content">

                <h2>Bienvenido al sistema</h2>

                <div class="row mt-4">

                    <div class="col-md-4">
                        <div class="card shadow p-3">
                            <h5>Usuarios</h5>
                            <p>Gestiona usuarios del sistema</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow p-3">
                            <h5>Dieta</h5>
                            <p>Genera dietas personalizadas</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow p-3">
                            <h5>Menú</h5>
                            <p>Menú automático diario</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>