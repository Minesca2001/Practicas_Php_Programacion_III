<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="auth-page">

    <!-- Panel visual izquierdo -->
    <div class="auth-visual">
        <div class="auth-visual-deco"></div>
        <div class="auth-visual-text">
            <div class="logo-mark">NutriPlan</div>
            <h1>Tu plan de nutrición personalizado</h1>
            <p>Genera dietas adaptadas a tus objetivos, controla tu alimentación y alcanza tu bienestar.</p>
        </div>
    </div>

    <!-- Panel de formulario -->
    <div class="auth-form-panel">
        <div class="auth-form-inner">
            <div class="form-heading">
                <h2>Bienvenido de vuelta</h2>
                <p>Ingresa tus credenciales para continuar</p>
            </div>

            <form action="../controllers/LoginController.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>

            <p class="auth-link">
                ¿No tienes cuenta? <a href="registro.php">Crear cuenta gratis</a>
            </p>
        </div>
    </div>

</div>
</body>
</html>
