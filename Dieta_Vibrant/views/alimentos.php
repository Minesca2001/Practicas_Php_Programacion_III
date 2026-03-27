<?php
require_once "../config/auth.php";
$ini = strtoupper(substr($_SESSION["nombre"], 0, 2));
$active = 'alimentos'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Panel de Alimentos — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .food-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 18px;
    }

    .food-card {
      background: #fff;
      border-radius: var(--r-xl);
      overflow: hidden;
      border: 1px solid var(--cr3);
      transition: all .25s;
      position: relative;
    }

    .food-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--sh-lg);
      border-color: transparent;
    }

    .food-card-hero {
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 52px;
      position: relative;
      overflow: hidden;
    }

    .food-card-hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, .06) 100%);
    }

    .food-card-body {
      padding: 18px;
    }

    .food-cat {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .food-name {
      font-family: var(--ff-s);
      font-size: 18px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 6px;
    }

    .food-desc {
      font-size: 12.5px;
      color: var(--mu);
      line-height: 1.55;
      margin-bottom: 14px;
    }

    .food-stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 6px;
    }

    .fstat {
      background: var(--cr);
      border-radius: 8px;
      padding: 8px 4px;
      text-align: center;
    }

    .fstat .fv {
      font-size: 13px;
      font-weight: 800;
      color: var(--ink);
    }

    .fstat .fl {
      font-size: 9px;
      color: var(--mu);
      margin-top: 2px;
      letter-spacing: .3px;
    }

    .food-benefit {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 12px;
      border-radius: 100px;
      font-size: 11px;
      font-weight: 600;
      margin-top: 10px;
    }

    .cat-filters {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-bottom: 22px;
    }

    .cat-btn {
      padding: 7px 16px;
      border-radius: 100px;
      cursor: pointer;
      font-size: 12.5px;
      font-weight: 600;
      border: 1.5px solid var(--cr3);
      color: var(--mu);
      background: #fff;
      transition: all .2s;
    }

    .cat-btn.on {
      background: var(--ink);
      border-color: var(--ink);
      color: #fff;
    }

    .search-bar {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #fff;
      border: 1.5px solid var(--cr3);
      border-radius: 100px;
      padding: 10px 20px;
      max-width: 400px;
      margin-bottom: 20px;
      box-shadow: var(--sh-sm);
    }

    .search-bar input {
      border: none;
      outline: none;
      font-family: var(--ff);
      font-size: 14px;
      color: var(--ink);
      background: transparent;
      flex: 1;
    }

    .search-bar input::placeholder {
      color: var(--mul);
    }

    .COLOR_green {
      background: rgba(6, 214, 160, .1);
    }

    .COLOR_orange {
      background: rgba(255, 107, 53, .1);
    }

    .COLOR_yellow {
      background: rgba(255, 209, 102, .15);
    }

    .COLOR_purple {
      background: rgba(124, 58, 237, .1);
    }

    .COLOR_red {
      background: rgba(255, 77, 109, .1);
    }

    .CATC_green {
      color: var(--green-dk);
    }

    .CATC_orange {
      color: var(--orange-dk);
    }

    .CATC_yellow {
      color: var(--yellow-dk);
    }

    .CATC_purple {
      color: var(--purple);
    }

    .CATC_red {
      color: var(--rose-dk);
    }

    .BENEF_green {
      background: rgba(6, 214, 160, .1);
      border: 1px solid rgba(6, 214, 160, .2);
      color: var(--green-dk);
    }

    .BENEF_orange {
      background: rgba(255, 107, 53, .1);
      border: 1px solid rgba(255, 107, 53, .2);
      color: var(--orange-dk);
    }

    .BENEF_yellow {
      background: rgba(255, 209, 102, .15);
      border: 1px solid rgba(255, 209, 102, .3);
      color: var(--yellow-dk);
    }

    .BENEF_purple {
      background: rgba(124, 58, 237, .1);
      border: 1px solid rgba(124, 58, 237, .2);
      color: var(--purple);
    }

    .BENEF_red {
      background: rgba(255, 77, 109, .08);
      border: 1px solid rgba(255, 77, 109, .2);
      color: var(--rose-dk);
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
          <h1>Panel de alimentos 🥑</h1>
          <p>Nutrición basada en evidencia — 18 superalimentos</p>
        </div>
        <div class="topbar-right"><span class="topbar-pill" id="food-count">
            <div class="online-dot"></div>Cargando...
          </span></div>
      </div>
      <div class="contenido">

        <!-- Buscador -->
        <div class="search-bar fade-up">
          <span style="font-size:18px">🔍</span>
          <input type="text" id="busqueda" placeholder="Buscar alimento, categoría o beneficio..."
            oninput="debounce(fetchAlimentos,300)()">
        </div>

        <!-- Categorías -->
        <div class="cat-filters fade-up fade-up-1" id="cat-filters">
          <button class="cat-btn on" data-cat="" onclick="selectCat(this)">🌿 Todos</button>
        </div>

        <!-- Grid -->
        <div class="food-grid fade-up fade-up-2" id="food-grid">
          <?php for ($i = 0; $i < 6; $i++): ?>
            <div style="background:#fff;border-radius:22px;height:280px;border:1px solid var(--cr3);overflow:hidden">
              <div
                style="height:100px;background:linear-gradient(90deg,var(--cr2) 25%,var(--cr) 50%,var(--cr2) 75%);animation:shimmer 1.4s infinite;background-size:400px">
              </div>
              <div style="padding:16px">
                <div style="height:14px;background:var(--cr2);border-radius:6px;margin-bottom:10px"></div>
                <div style="height:20px;background:var(--cr3);border-radius:6px;margin-bottom:10px"></div>
                <div style="height:12px;background:var(--cr2);border-radius:6px;width:70%"></div>
              </div>
            </div>
          <?php endfor; ?>
        </div>

        <p id="empty-state" style="display:none;text-align:center;padding:60px;color:var(--mu);font-size:15px">🔍 No se
          encontraron alimentos con ese criterio.</p>
      </div>
    </div>
  </div>

  <script src="../js/app.js"></script>
  <script>
    let currentCat = '';
    let catsLoaded = false;

    async function fetchAlimentos() {
      const busqueda = document.getElementById('busqueda').value;
      const params = new URLSearchParams({ categoria: currentCat, busqueda });
      const res = await apiFetch(`${API.alimentos}?${params}`);

      if (!res.ok) { Toast.show('Error cargando alimentos', 'error'); return; }

      document.getElementById('food-count').innerHTML = `<div class="online-dot"></div>${res.total} alimentos`;

      // Load categories (once)
      if (!catsLoaded && res.categorias) {
        const cf = document.getElementById('cat-filters');
        res.categorias.forEach(cat => {
          const btn = document.createElement('button');
          btn.className = 'cat-btn';
          btn.dataset.cat = cat;
          btn.textContent = cat;
          btn.onclick = function () { selectCat(this); };
          cf.appendChild(btn);
        });
        catsLoaded = true;
      }

      const grid = document.getElementById('food-grid');
      const empty = document.getElementById('empty-state');

      if (!res.data.length) {
        grid.innerHTML = '';
        empty.style.display = 'block';
        return;
      }
      empty.style.display = 'none';

      grid.innerHTML = res.data.map(f => `
    <div class="food-card">
      <div class="food-card-hero COLOR_${f.color}" style="animation:fadeIn .4s both">
        <span>${f.emoji}</span>
      </div>
      <div class="food-card-body">
        <div class="food-cat CATC_${f.color}">${f.categoria}</div>
        <div class="food-name">${f.nombre}</div>
        <div class="food-desc">${f.descripcion}</div>
        <div class="food-stats">
          <div class="fstat">
            <div class="fv" style="color:var(--orange)">${f.calorias}</div>
            <div class="fl">kcal</div>
          </div>
          <div class="fstat">
            <div class="fv" style="color:var(--green-dk)">${f.proteinas}g</div>
            <div class="fl">proteína</div>
          </div>
          <div class="fstat">
            <div class="fv" style="color:var(--yellow-dk)">${f.carbos}g</div>
            <div class="fl">carbos</div>
          </div>
          <div class="fstat">
            <div class="fv" style="color:var(--purple)">${f.fibra}g</div>
            <div class="fl">fibra</div>
          </div>
        </div>
        <div class="food-benefit BENEF_${f.color}">✓ ${f.beneficio}</div>
      </div>
    </div>
  `).join('');
    }

    function selectCat(btn) {
      document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('on'));
      btn.classList.add('on');
      currentCat = btn.dataset.cat;
      fetchAlimentos();
    }

    fetchAlimentos();
  </script>
</body>

</html>