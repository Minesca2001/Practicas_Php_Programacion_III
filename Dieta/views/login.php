<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <script src='main.js'></script>
</head>

<body>
    <div class="container">

        <form action="../controllers/LoginController.php" method="POST">

            <h2>Iniciar Sesión</h2>

            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            <p>
                ¿No tienes cuenta?
                <a href="registro.php">Registrarse</a>
            </p>


        </form>

    </div>
</body>

</html>