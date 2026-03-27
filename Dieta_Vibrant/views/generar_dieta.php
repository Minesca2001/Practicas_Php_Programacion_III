<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generar Dieta — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require_once "../config/auth.php";
    $ini = strtoupper(substr($_SESSION["nombre"], 0, 2)); ?>
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>

  <div class="layout">
    <aside class="sidebar">
      <div class="sb-header">
        <div class="sb-logo">
          <div class="sb-logo-icon">🥗</div>
          <div class="sb-logo-text">Nutri<span>Plan</span></div>
        </div>
        <div class="sb-user">
          <div class="sb-avatar"><?= htmlspecialchars($ini) ?></div>
          <div>
            <div class="sb-user-name"><?= htmlspecialchars($_SESSION["nombre"]) ?></div>
            <div class="sb-user-role"><?= htmlspecialchars($_SESSION["rol"]) ?></div>
          </div>
        </div>
      </div>
      <nav class="sb-nav">
        <span class="sb-group-label">Principal</span>
        <a href="dashboard.php" class="sb-link"><span class="sb-icon">🏠</span>Inicio</a>
        <a href="../controllers/MenuController.php" class="sb-link"><span class="sb-icon">🍽</span>Menú del día</a>
        <span class="sb-group-label">Mis dietas</span>
        <a href="generar_dieta.php" class="sb-link active"><span class="sb-icon">✨</span>Generar dieta</a>
          <a href="listar_dietas.php" class="sb-link"><span class="sb-icon">📋</span>Historial</a>
       <?php if ($_SESSION["rol"] == "admin"): ?>
          <span class="sb-group-label">Administración</span>
              <a href="listar_usuarios.php" class="sb-link"><span class="sb-icon">👥</span>Usuarios</a>
        <?php endif; ?>
      </nav>
      <div class="sb-footer">
        <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
      </div>
    </aside>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Generar dieta personalizada</h1>
          <p>Calculamos tu plan nutricional exacto según tus datos</p>
        </div>
      </div>

      <div class="contenido">
        <div class="fade-up" style="max-width:580px">
          <div class="form-card">
            <div class="form-card-head">
              <h2>Cuéntanos sobre ti 🌟</h2>
              <p>Tus datos físicos nos permiten calcular las calorías y macronutrientes ideales.</p>
            </div>

            <form action="../controllers/GenerarDietaController.php" method="POST">

              <div class="fsec">Medidas físicas</div>
              <div class="fr">
                <div class="fg">
                  <label>Peso (kg)</label>
                  <input class="fi" type="number" name="peso" placeholder="Ej. 70" required>
                </div>
                <div class="fg">
                  <label>Altura (m)</label>
                  <input class="fi" type="number" name="altura" step="any" placeholder="Ej. 1.75" required>
                </div>
              </div>
              <div class="fr">
                <div class="fg">
                  <label>Edad</label>
                  <input class="fi" type="number" name="edad" placeholder="Ej. 28" required>
                </div>
                <div class="fg">
                  <label>Género</label>
                  <select class="fi" name="genero">
                    <option value="Masculino">♂ Masculino</option>
                    <option value="Femenino">♀ Femenino</option>
                    <option value="Prefiero no decirlo">— Prefiero no decirlo</option>
                    <option value="Otro">○ Otro</option>
                  </select>
                </div>
              </div>

              <div class="fsec">Estilo de vida</div>
              <div class="fg">
                <label>Nivel de actividad física</label>
                <select class="fi" name="actividad">
                  <option value="Sedentario">🪑 Sedentario — Poco o ningún ejercicio</option>
                  <option value="Ligero">🚶 Ligero — 1 a 3 días por semana</option>
                  <option value="Moderado" selected>🏃 Moderado — 3 a 5 días por semana</option>
                  <option value="Intenso">💪 Intenso — 6 a 7 días por semana</option>
                </select>
              </div>

              <div class="fsec">Tu objetivo</div>
              <div class="fg">
                <label>¿Qué quieres lograr?</label>
                <select class="fi" name="objetivo">
                  <option value="Perder">🔥 Perder peso — déficit calórico</option>
                  <option value="Mantener">⚖️ Mantener peso — equilibrio calórico</option>
                  <option value="Ganar">💪 Ganar masa muscular — superávit calórico</option>
                </select>
              </div>

              <div style="margin-top:8px">
                <button type="submit" class="btn btn-primary">✨ Calcular mi dieta personalizada</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>