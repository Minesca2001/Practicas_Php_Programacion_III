<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
</head>

<body data-page="usuarios">
  <?php
  require_once "../config/auth.php";
  require_once "../config/roles.php";
  esAdmin();
  ?>
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>
  <div class="layout">
    <?php //setActive("usuarios");
    require "partials/sidebar.php"; ?>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Gestión de usuarios</h1>
          <p>Administra los usuarios registrados</p>
        </div>
        <div class="topbar-right">
          <button class="btn-sm" onclick="descargarUsuariosCSV()">📊 CSV</button>
          <button class="btn-sm" onclick="descargarUsuariosPDF()">📄 PDF</button>
        </div>
      </div>

      <div class="contenido">
        <!-- Filtros -->
        <div class="filter-bar fade-up">
          <div class="filter-bar-title">🔍 Filtros</div>
          <div class="filter-fields">
            <input class="fi filter-input usuario-filter" id="fu-nombre" placeholder="Buscar por nombre…">
            <input class="fi filter-input usuario-filter" id="fu-email" placeholder="Buscar por correo…">
            <select class="fi filter-input usuario-filter" id="fu-rol">
              <option value="">Todos los roles</option>
              <option value="admin">🛡 Administrador</option>
              <option value="usuario">👤 Usuario</option>
            </select>
            <button class="btn-ghost-sm" onclick="clearUsuarioFilters()">✕ Limpiar</button>
          </div>
        </div>

        <!-- Tabla -->
        <div class="table-wrap fade-up fade-up-1">
          <div class="table-top">
            <h2>Usuarios registrados</h2>
            <span class="table-count" id="usuarios-count">Cargando…</span>
          </div>
          <div class="table-scroll">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Correo electrónico</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="usuarios-tbody">
                <tr>
                  <td colspan="5" class="loading-cell"><span class="spin">⟳</span> Cargando…</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/app.js"></script>
</body>

</html>