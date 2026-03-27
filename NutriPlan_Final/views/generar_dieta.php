<?php require_once "../config/auth.php";
$ini = strtoupper(substr($_SESSION["nombre"], 0, 2));
$active = 'generar'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Generar Dieta — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
  <style>
    .result-card {
      background: #fff;
      border-radius: var(--r-xl);
      padding: 32px;
      box-shadow: var(--sh-md);
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      display: none;
    }

    .result-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--grad-hero);
    }

    .result-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin: 16px 0;
    }

    .rstat {
      border-radius: 14px;
      padding: 16px;
      text-align: center;
      color: #fff;
    }

    .rstat.c1 {
      background: var(--grad-orange);
    }

    .rstat.c2 {
      background: var(--grad-green);
    }

    .rstat.c3 {
      background: var(--grad-purple);
    }

    .rstat .rv {
      font-size: 26px;
      font-weight: 900;
      font-family: var(--ff-s);
    }

    .rstat .rl {
      font-size: 11px;
      opacity: .75;
      margin-top: 4px;
    }

    .plan-box {
      background: var(--cr);
      border-radius: var(--r-md);
      padding: 20px;
      font-size: 14px;
      line-height: 1.9;
      color: var(--ink-3);
      white-space: pre-line;
      margin-top: 14px;
    }

    .spin {
      width: 22px;
      height: 22px;
      border: 3px solid rgba(255, 255, 255, .4);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin-slow .7s linear infinite;
      display: inline-block;
      vertical-align: middle;
      margin-right: 8px;
    }

    .imc-bar {
      height: 10px;
      border-radius: 5px;
      background: linear-gradient(90deg, #06D6A0, #FFD166, #FF6B35, #FF4D6D);
      margin: 8px 0;
      position: relative;
    }

    .imc-indicator {
      width: 14px;
      height: 14px;
      background: #1A1A2E;
      border-radius: 50%;
      position: absolute;
      top: -2px;
      transform: translateX(-50%);
      transition: left .8s cubic-bezier(.4, 0, .2, 1);
    }
  </style>
</head>

<body>
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>
  <div class="layout">
      <?php include '_sidebar.php'; ?>
    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Generar dieta personalizada</h1>
          <p>Calcula tu plan nutricional exacto con IA</p>
        </div>
      </div>
      <div class="contenido">
        <div style="max-width:620px">

          <div class="form-card fade-up">
            <div class="form-card-head">
              <h2>Cuéntanos sobre ti 🌟</h2>
              <p>Tus datos físicos nos permiten calcular calorías y macronutrientes exactos.</p>
            </div>
            <form id="dieta-form">
              <div class="fsec">Medidas físicas</div>
              <div class="fr">
                <div class="fg"><label>Peso (kg)</label><input class="fi" type="number" name="peso" placeholder="Ej. 70"
                    min="20" max="300" required></div>
                <div class="fg"><label>Altura (cm)</label><input class="fi" type="number" name="altura"
                    placeholder="Ej. 175" min="100" max="250" required></div>
              </div>
              <div class="fr">
                <div class="fg"><label>Edad</label><input class="fi" type="number" name="edad" placeholder="Ej. 28"
                    min="10" max="100" required></div>
                <div class="fg"><label>Género</label>
                  <select class="fi" name="genero">
                    <option value="Masculino">♂ Masculino</option>
                    <option value="Femenino">♀ Femenino</option>
                    <option value="Prefiero no decirlo">— Prefiero no decirlo</option>
                    <option value="Otro">○ Otro</option>
                  </select>
                </div>
              </div>
              <div class="fsec">Estilo de vida</div>
              <div class="fg"><label>Nivel de actividad física</label>
                <select class="fi" name="actividad">
                  <option value="Sedentario">🪑 Sedentario — Poco o ningún ejercicio</option>
                  <option value="Ligero">🚶 Ligero — 1 a 3 días/semana</option>
                  <option value="Moderado" selected>🏃 Moderado — 3 a 5 días/semana</option>
                  <option value="Intenso">💪 Intenso — 6 a 7 días/semana</option>
                </select>
              </div>
              <div class="fsec">Objetivo</div>
              <div class="fg"><label>¿Qué quieres lograr?</label>
                <select class="fi" name="objetivo">
                  <option value="Perder">🔥 Perder peso — déficit calórico</option>
                  <option value="Mantener">⚖️ Mantener peso — equilibrio calórico</option>
                  <option value="Ganar">💪 Ganar masa muscular — superávit calórico</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary" id="submit-btn">✨ Calcular mi dieta personalizada</button>
            </form>
          </div>

          <!-- RESULTADO (oculto hasta generar) -->
          <div class="result-card" id="result-card">
            <h2 style="font-family:var(--ff-s);font-size:22px;font-weight:700;color:var(--ink);margin-bottom:4px">🎉 ¡Tu
              plan nutricional está listo!</h2>
            <p style="font-size:13px;color:var(--mu);margin-bottom:4px" id="res-fecha"></p>
            <div class="result-grid">
              <div class="rstat c1">
                <div class="rv" id="res-cal">—</div>
                <div class="rl">Calorías / día</div>
              </div>
              <div class="rstat c2">
                <div class="rv" id="res-imc">—</div>
                <div class="rl">IMC</div>
              </div>
              <div class="rstat c3">
                <div class="rv" id="res-obj">—</div>
                <div class="rl">Objetivo</div>
              </div>
            </div>
            <div>
              <label
                style="font-size:11px;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:1px">Escala
                IMC</label>
              <div class="imc-bar">
                <div class="imc-indicator" id="imc-indicator"></div>
              </div>
              <div style="display:flex;justify-content:space-between;font-size:10px;color:var(--mu)"><span>Bajo
                  (18.5)</span><span>Normal (25)</span><span>Sobrepeso (30)</span><span>Obesidad</span></div>
            </div>
            <h3 style="font-size:15px;font-weight:700;color:var(--ink);margin-top:18px;margin-bottom:4px">📋 Tu plan de
              alimentación</h3>
            <div class="plan-box" id="res-plan"></div>
            <div style="display:flex;gap:10px;margin-top:18px;flex-wrap:wrap">
              <button class="btn btn-primary" style="width:auto;padding:11px 22px;font-size:13px" id="btn-ver-pdf"
                onclick="">📄 Ver PDF completo</button>
              <a href="listar_dietas.php" class="btn btn-ghost" style="padding:11px 22px;font-size:13px">📋 Ver
                historial</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/app.js"></script>
  <script>
    document.getElementById('dieta-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn = document.getElementById('submit-btn');
      btn.innerHTML = '<span class="spin"></span>Calculando tu plan...';
      btn.disabled = true;

      const fd = new FormData(e.target);
      const res = await apiFetch('../controllers/GenerarDietaController.php', { method: 'POST', body: fd });

      btn.innerHTML = '✨ Calcular mi dieta personalizada';
      btn.disabled = false;

      if (!res.ok) { Toast.show(res.msg || 'Error al generar', 'error'); return; }

      Toast.show('¡Dieta generada exitosamente!', 'success');

      // Fill result card
      document.getElementById('res-cal').textContent = Math.round(res.calorias).toLocaleString() + ' kcal';
      document.getElementById('res-imc').textContent = parseFloat(res.imc).toFixed(1) + ' — ' + res.imc_cat;
      document.getElementById('res-obj').textContent = res.objetivo;
      document.getElementById('res-plan').textContent = res.descripcion;
      document.getElementById('res-fecha').textContent = 'Plan creado el ' + new Date().toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

      // IMC indicator
      const pct = Math.min(Math.max(((res.imc - 10) / 30) * 100, 0), 100);
      document.getElementById('imc-indicator').style.left = pct + '%';

      // PDF button
      document.getElementById('btn-ver-pdf').onclick = () => viewPDF(res.id);

      const card = document.getElementById('result-card');
      card.style.display = 'block';
      card.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  </script>
</body>

</html>