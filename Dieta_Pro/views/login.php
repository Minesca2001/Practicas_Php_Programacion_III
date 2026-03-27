<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriPlan — Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="auth-bg">
  <div class="auth-shell fade-up">

    <!-- Panel izquierdo -->
    <div class="auth-left">
      <div class="auth-logo">
        <div class="auth-logo-icon">🥗</div>
        <span class="auth-logo-name">NutriPlan</span>
      </div>
      <div>
        <div class="auth-left-copy">
          <h1>Nutrición que <span>transforma</span> tu vida</h1>
          <p>Genera planes de alimentación personalizados basados en tu cuerpo, estilo de vida y objetivos.</p>
        </div>
        <div class="auth-stats">
          <div class="auth-stat">
            <div class="val">98%</div>
            <div class="lbl">Precisión</div>
          </div>
          <div class="auth-stat">
            <div class="val">+2K</div>
            <div class="lbl">Dietas</div>
          </div>
          <div class="auth-stat">
            <div class="val">IA</div>
            <div class="lbl">Powered</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Panel derecho — formulario -->
    <div class="auth-right">
      <h2>Bienvenido de vuelta</h2>
      <p class="sub">Ingresa tus credenciales para continuar</p>

      <form action="../controllers/LoginController.php" method="POST">
        <div class="fgroup">
          <label for="email">Correo electrónico</label>
          <input class="finput" type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
        </div>
        <div class="fgroup">
          <label for="password">Contraseña</label>
          <input class="finput" type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar →</button>
      </form>

      <p class="auth-footer">
        ¿No tienes cuenta? <a href="registro.php">Crear cuenta gratis</a>
      </p>
    </div>

  </div>
</div>
</body>
</html>
