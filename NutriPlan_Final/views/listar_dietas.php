<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Dietas — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
</head>

<body data-page="dietas">
  <?php
  require_once "../config/auth.php";
  ?>
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>
  <div class="layout">
    <?php //setActive("dietas");
    require_once "../views/partials/sidebar.php"; ?>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Historial de dietas</h1>
          <p>Mis planes nutricionales generados</p>
        </div>
        <div class="topbar-right">
          <button class="btn-sm" onclick="descargarDietaCSV(null)" title="Exportar todo CSV">📊 CSV</button>
          <button class="btn-sm" onclick="descargarDietaPDF(null)" title="Exportar todo PDF">📄 PDF</button>
          <a href="generar_dieta.php" class="btn-sm" style="background:var(--grad-orange)">✨ Nueva dieta</a>
        </div>
      </div>

      <div class="contenido">
        <!-- Filtros -->
        <div class="filter-bar fade-up">
          <div class="filter-bar-title">🔍 Filtros</div>
          <div class="filter-fields">
            <input class="fi filter-input dieta-filter" id="f-fecha" placeholder="Fecha (Ej: 2026-03)">
            <input class="fi filter-input dieta-filter" id="f-peso" placeholder="Peso (kg)">
            <input class="fi filter-input dieta-filter" id="f-altura" placeholder="Altura (m)">
            <input class="fi filter-input dieta-filter" id="f-calorias" placeholder="Calorías">
            <select class="fi filter-input dieta-filter" id="f-objetivo">
              <option value="">Todos los objetivos</option>
              <option value="Perder">🔥 Perder</option>
              <option value="Mantener">⚖️ Mantener</option>
              <option value="Ganar">💪 Ganar</option>
            </select>
            <input class="fi filter-input dieta-filter" id="f-desc" placeholder="Buscar en descripción…">
            <button class="btn-ghost-sm" onclick="clearDietaFilters()">✕ Limpiar</button>
          </div>
        </div>

        <!-- Tabla -->
        <div class="table-wrap fade-up fade-up-1">
          <div class="table-top">
            <h2>Mis planes nutricionales</h2>
            <span class="table-count" id="dietas-count">Cargando…</span>
          </div>
          <div class="table-scroll">
            <table>
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Peso</th>
                  <th>Altura</th>
                  <th>IMC</th>
                  <th>Calorías</th>
                  <th>Objetivo</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="dietas-tbody">
                <tr>
                  <td colspan="8" class="loading-cell"><span class="spin">⟳</span> Cargando…</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal-overlay"
    style="display:none;position:fixed;inset:0;background:rgba(26,26,46,.6);z-index:1000;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
    <div id="modal-box"
      style="background:#fff;border-radius:24px;padding:36px;max-width:560px;width:90%;max-height:85vh;overflow-y:auto;position:relative;box-shadow:0 30px 80px rgba(0,0,0,.3)">
      <button id="modal-close" onclick="closeModal()"
        style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:18px;cursor:pointer;color:#8A8AAA;width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:.2s"
        onmouseover="this.style.background='#F1ECE4'" onmouseout="this.style.background='none'">✕</button>
      <div id="modal-body"></div>
    </div>
  </div>

  <script src="../js/app.js"></script>
</body>

</html>