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
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 2)); ?>
<div class="layout">

  <aside class="sidebar">
    <div class="sb-top">
      <div class="sb-logo">
        <div class="sb-logo-icon">🥗</div>
        <span class="sb-logo-name">NutriPlan</span>
      </div>
      <div class="sb-user">
        <div class="sb-avatar"><?= htmlspecialchars($inicial) ?></div>
        <div class="sb-user-info">
          <div class="uname"><?= htmlspecialchars($_SESSION["nombre"]) ?></div>
          <div class="urole"><?= htmlspecialchars($_SESSION["rol"]) ?></div>
        </div>
      </div>
    </div>
    <nav class="sb-nav">
      <span class="sb-section">Principal</span>
      <a href="dashboard.php" class="sb-link"><span class="icon">🏠</span> Inicio</a>
      <a href="../controllers/MenuController.php" class="sb-link"><span class="icon">🍽</span> Menú del día</a>
      <span class="sb-section">Dietas</span>
      <a href="generar_dieta.php" class="sb-link active"><span class="icon">✨</span> Generar dieta</a>
      <a href="listar_dietas.php" class="sb-link"><span class="icon">📋</span> Historial</a>
      <?php if ($_SESSION["rol"] == "admin"): ?>
      <span class="sb-section">Admin</span>
      <a href="listar_usuarios.php" class="sb-link"><span class="icon">👥</span> Usuarios</a>
      <?php endif; ?>
    </nav>
    <div class="sb-footer">
      <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span> Cerrar sesión</a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Generar dieta personalizada</div>
        <div class="topbar-subtitle">Calcula tu plan nutricional óptimo</div>
      </div>
    </div>

    <div class="contenido">
      <div class="form-wrap fade-up">
        <div class="form-card">
          <div class="form-card-head">
            <h2>Tus datos corporales</h2>
            <p>Esta información nos ayuda a calcular tus calorías y macros exactos.</p>
          </div>

          <form action="../controllers/GenerarDietaController.php" method="POST">
            <div class="fsec-label">Medidas físicas</div>

            <div class="frow">
              <div class="fgroup">
                <label>Peso (kg)</label>
                <input class="finput" type="number" name="peso" placeholder="Ej. 70" required>
              </div>
              <div class="fgroup">
                <label>Altura (m)</label>
                <input class="finput" type="number" name="altura" step="any" placeholder="Ej. 1.75" required>
              </div>
            </div>

            <div class="frow">
              <div class="fgroup">
                <label>Edad</label>
                <input class="finput" type="number" name="edad" placeholder="Ej. 28" required>
              </div>
              <div class="fgroup">
                <label>Género</label>
                <select class="finput" name="genero">
                  <option value="Masculino">♂ Masculino</option>
                  <option value="Femenino">♀ Femenino</option>
                  <option value="Prefiero no decirlo">— Prefiero no decirlo</option>
                  <option value="Otro">○ Otro</option>
                </select>
              </div>
            </div>

            <div class="fsec-label">Estilo de vida</div>

            <div class="fgroup">
              <label>Nivel de actividad física</label>
              <select class="finput" name="actividad">
                <option value="Sedentario">🪑 Sedentario — Poco o ningún ejercicio</option>
                <option value="Ligero">🚶 Ligero — Ejercicio 1–3 días/semana</option>
                <option value="Moderado">🏃 Moderado — Ejercicio 3–5 días/semana</option>
                <option value="Intenso">💪 Intenso — Ejercicio 6–7 días/semana</option>
              </select>
            </div>

            <div class="fgroup">
              <label>Objetivo principal</label>
              <select class="finput" name="objetivo">
                <option value="Perder">🔥 Perder peso</option>
                <option value="Mantener">⚖️ Mantener peso</option>
                <option value="Ganar">💪 Ganar masa muscular</option>
              </select>
            </div>

            <div style="margin-top:8px;">
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
