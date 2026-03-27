<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="auth-page">

    <div class="auth-visual">
        <div class="auth-visual-deco"></div>
        <div class="auth-visual-text">
            <div class="logo-mark">NutriPlan</div>
            <h1>Empieza tu camino hacia el bienestar</h1>
            <p>Crea tu cuenta y obtén un plan de dieta adaptado a tus metas y estilo de vida.</p>
        </div>
    </div>

    <div class="auth-form-panel">
        <div class="auth-form-inner">
            <div class="form-heading">
                <h2>Crear cuenta</h2>
                <p>Completa los datos para registrarte</p>
            </div>

            <form action="../controllers/UsuarioController.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                </div>
                <div class="form-group">
                    <label for="confirmar">Confirmar contraseña</label>
                    <input type="password" id="confirmar" name="confirmar" placeholder="Repite tu contraseña" required>
                </div>
                <div class="form-group">
                    <label for="rol">Tipo de cuenta</label>
                    <select id="rol" name="rol">
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <button type="submit" name="guardar">Crear cuenta</button>
            </form>

            <p class="auth-link">
                ¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a>
            </p>
        </div>
    </div>

</div>
</body>
</html>
