<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriPlan — Crear Cuenta</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="page-blobs"><div class="blob blob-1"></div><div class="blob blob-2"></div><div class="blob blob-3"></div></div>

<div class="auth-page">
  <div class="auth-card fade-up">

    <div class="auth-left">
      <div class="auth-brand">
        <div class="auth-brand-icon">🥗</div>
        <span class="auth-brand-name">NutriPlan</span>
      </div>
      <div class="auth-copy">
        <h1>Tu cuerpo,<br><em>tu plan.</em></h1>
        <p>Únete a miles de personas que ya transformaron sus hábitos alimenticios con planes nutricionales inteligentes.</p>
        <div class="auth-food-icons">
          <div class="food-icon-pill">🥕</div>
          <div class="food-icon-pill">🍇</div>
          <div class="food-icon-pill">🥝</div>
          <div class="food-icon-pill">🍋</div>
          <div class="food-icon-pill">🌿</div>
        </div>
        <div class="auth-badges">
          <span class="auth-badge"><span class="auth-badge-dot"></span>100% gratuito</span>
          <span class="auth-badge"><span class="auth-badge-dot"></span>Resultados inmediatos</span>
          <span class="auth-badge"><span class="auth-badge-dot"></span>Sin compromisos</span>
        </div>
      </div>
    </div>

    <div class="auth-right">
      <h2>Crear tu cuenta 🌱</h2>
      <p class="auth-sub">Completa los datos y empieza hoy mismo</p>

      <form action="../controllers/UsuarioController.php" method="POST">
        <div class="fg">
          <label>Nombre completo</label>
          <input class="fi" type="text" name="nombre" placeholder="Tu nombre completo" required>
        </div>
        <div class="fg">
          <label>Correo electrónico</label>
          <input class="fi" type="email" name="email" placeholder="correo@ejemplo.com" required>
        </div>
        <div class="fr">
          <div class="fg">
            <label>Contraseña</label>
            <input class="fi" type="password" name="password" placeholder="Mínimo 8 caracteres" required>
          </div>
          <div class="fg">
            <label>Confirmar contraseña</label>
            <input class="fi" type="password" name="confirmar" placeholder="Repite tu contraseña" required>
          </div>
        </div>
        <div class="fg">
          <label>Tipo de cuenta</label>
          <select class="fi" name="rol">
            <option value="usuario">👤 Usuario</option>
            <option value="admin">🛡 Administrador</option>
          </select>
        </div>
        <button type="submit" name="guardar" class="btn btn-primary">Crear mi cuenta gratis →</button>
      </form>

      <p class="auth-footer-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>

  </div>
</div>
</body>
</html>
