<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriPlan — Crear Cuenta</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="auth-bg">
  <div class="auth-shell fade-up">

    <div class="auth-left">
      <div class="auth-logo">
        <div class="auth-logo-icon">🥗</div>
        <span class="auth-logo-name">NutriPlan</span>
      </div>
      <div>
        <div class="auth-left-copy">
          <h1>Empieza tu camino hacia el <span>bienestar</span></h1>
          <p>Crea tu cuenta en segundos y obtén acceso a planes nutricionales diseñados para ti.</p>
        </div>
        <div class="auth-stats">
          <div class="auth-stat">
            <div class="val">100%</div>
            <div class="lbl">Gratis</div>
          </div>
          <div class="auth-stat">
            <div class="val">3</div>
            <div class="lbl">Comidas / día</div>
          </div>
        </div>
      </div>
    </div>

    <div class="auth-right">
      <h2>Crear cuenta</h2>
      <p class="sub">Completa los datos para registrarte</p>

      <form action="../controllers/UsuarioController.php" method="POST">
        <div class="fgroup">
          <label>Nombre completo</label>
          <input class="finput" type="text" name="nombre" placeholder="Tu nombre completo" required>
        </div>
        <div class="fgroup">
          <label>Correo electrónico</label>
          <input class="finput" type="email" name="email" placeholder="correo@ejemplo.com" required>
        </div>
        <div class="frow">
          <div class="fgroup">
            <label>Contraseña</label>
            <input class="finput" type="password" name="password" placeholder="Mínimo 8 caracteres" required>
          </div>
          <div class="fgroup">
            <label>Confirmar</label>
            <input class="finput" type="password" name="confirmar" placeholder="Repetir contraseña" required>
          </div>
        </div>
        <div class="fgroup">
          <label>Tipo de cuenta</label>
          <select class="finput" name="rol">
            <option value="usuario">👤 Usuario</option>
            <option value="admin">🛡 Administrador</option>
          </select>
        </div>
        <button type="submit" name="guardar" class="btn btn-primary">Crear mi cuenta →</button>
      </form>

      <p class="auth-footer">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>

  </div>
</div>
</body>
</html>
