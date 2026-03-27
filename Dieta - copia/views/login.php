<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
        }
    </style>

</head>

<body>

    <div class="card shadow p-4" style="width:350px;">

        <h3 class="text-center mb-3">Iniciar Sesión</h3>

        <form action="../controllers/LoginController.php" method="POST">

            <input type="email" name="email" class="form-control mb-3" placeholder="Correo" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>

            <button class="btn btn-primary w-100">Ingresar</button>

        </form>

        <p class="text-center mt-3">
            ¿No tienes cuenta? <a href="registro.php">Registrarse</a>
        </p>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>