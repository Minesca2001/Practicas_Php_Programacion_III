<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriPlan — Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="page-blobs"><div class="blob blob-1"></div><div class="blob blob-2"></div><div class="blob blob-3"></div></div>

<div class="auth-page">
  <div class="auth-card fade-up">

    <!-- Panel izquierdo — marca vibrante -->
    <div class="auth-left">
      <div class="auth-brand">
        <div class="auth-brand-icon">🥗</div>
        <span class="auth-brand-name">NutriPlan</span>
      </div>

      <div class="auth-copy">
        <h1>Come bien,<br><em>vive mejor.</em></h1>
        <p>Genera planes de alimentación personalizados según tu cuerpo, objetivos y estilo de vida. Nutrición inteligente para cada persona.</p>
        <div class="auth-food-icons">
          <div class="food-icon-pill">🥑</div>
          <div class="food-icon-pill">🍓</div>
          <div class="food-icon-pill">🥦</div>
          <div class="food-icon-pill">🍊</div>
          <div class="food-icon-pill">🌽</div>
        </div>
        <div class="auth-badges">
          <span class="auth-badge"><span class="auth-badge-dot"></span>Planes personalizados con IA</span>
          <span class="auth-badge"><span class="auth-badge-dot"></span>3 comidas diarias balanceadas</span>
          <span class="auth-badge"><span class="auth-badge-dot"></span>Seguimiento de IMC y calorías</span>
        </div>
      </div>
    </div>

    <!-- Panel derecho — formulario -->
    <div class="auth-right">
      <h2>Bienvenido de vuelta 👋</h2>
      <p class="auth-sub">Ingresa tus credenciales para continuar</p>

      <form action="../controllers/LoginController.php" method="POST">
        <div class="fg">
          <label>Correo electrónico</label>
          <input class="fi" type="email" name="email" placeholder="correo@ejemplo.com" required>
        </div>
        <div class="fg">
          <label>Contraseña</label>
          <input class="fi" type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar a NutriPlan →</button>
      </form>

      <p class="auth-footer-link">¿No tienes cuenta? <a href="registro.php">Crear cuenta gratis</a></p>
    </div>

  </div>
</div>
</body>
</html>
