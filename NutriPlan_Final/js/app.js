/* ═══════════════════════════════════════════════════
   NutriPlan — JavaScript principal
   Fetch API · DOM dinámico · PDF · CSV · Filtros
   ═══════════════════════════════════════════════════ */

"use strict";

/* ─── Utilidades ─────────────────────────────────── */
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];
const esc = s => String(s ?? "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");

function showToast(msg, type = "success") {
  let wrap = $("#toast-wrap");
  if (!wrap) {
    wrap = document.createElement("div");
    wrap.id = "toast-wrap";
    wrap.style.cssText = "position:fixed;bottom:28px;right:28px;z-index:9999;display:flex;flex-direction:column;gap:10px;";
    document.body.appendChild(wrap);
  }
  const t = document.createElement("div");
  const bg = type === "success" ? "var(--gr)" : type === "error" ? "var(--rs)" : "var(--ye)";
  t.style.cssText = `background:${bg};color:#fff;padding:12px 20px;border-radius:12px;font-size:13px;
    font-weight:600;font-family:var(--ff);box-shadow:0 6px 24px rgba(0,0,0,.2);
    animation:slideInR .3s ease both;max-width:320px;display:flex;align-items:center;gap:8px;`;
  t.innerHTML = `<span>${type === "success" ? "✓" : type === "error" ? "✕" : "!"}</span><span>${esc(msg)}</span>`;
  wrap.appendChild(t);
  setTimeout(() => { t.style.animation = "fadeOut .3s ease forwards"; setTimeout(() => t.remove(), 300); }, 3200);
}

function showLoader(btn) {
  btn.dataset.orig = btn.innerHTML;
  btn.innerHTML = '<span class="spin">⟳</span> Cargando…';
  btn.disabled = true;
}
function hideLoader(btn) {
  btn.innerHTML = btn.dataset.orig || "Listo";
  btn.disabled = false;
}

/* ─── Fetch helpers ──────────────────────────────── */
async function fetchJSON(url, opts = {}) {
  const res = await fetch(url, { headers: { "Accept": "application/json" }, ...opts });
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
}
async function postJSON(url, data) {
  return fetchJSON(url, {
    method: "POST",
    headers: { "Content-Type": "application/json", "Accept": "application/json" },
    body: JSON.stringify(data)
  });
}

/* ═══════════════════════════════════════════════════
   MÓDULO: MENÚ DEL DÍA (carga con Fetch)
   ═══════════════════════════════════════════════════ */
async function loadMenuSemana() {
  const grid = $("#menu-semana-grid");
  if (!grid) return;
  grid.innerHTML = '<div class="loading-state"><span class="spin big">⟳</span><p>Cargando menú semanal…</p></div>';
  try {
    const data = await fetchJSON("../api/menu_semana.php");
    renderMenuSemana(data);
  } catch (e) {
    grid.innerHTML = '<p class="err-msg">No se pudo cargar el menú. Intenta de nuevo.</p>';
  }
}

const DIAS = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
const DIA_ICONS = ["🌱", "🔥", "⚡", "🌿", "💪", "🎉", "😌"];

function renderMenuSemana(data) {
  const grid = $("#menu-semana-grid");
  if (!grid) return;
  const hoy = new Date().getDay(); // 0=Dom
  const hoyIdx = hoy === 0 ? 6 : hoy - 1;
  grid.innerHTML = "";
  data.forEach((dia, i) => {
    const isHoy = i === hoyIdx;
    const card = document.createElement("div");
    card.className = `dia-card${isHoy ? " hoy" : ""}`;
    card.innerHTML = `
      <div class="dia-header">
        <span class="dia-icon">${DIA_ICONS[i]}</span>
        <div>
          <div class="dia-name">${DIAS[i]}</div>
          ${isHoy ? '<span class="hoy-badge">Hoy</span>' : ""}
        </div>
      </div>
      <div class="dia-meals">
        ${renderComida("☀️", "Desayuno", dia.desayuno, "dawn")}
        ${renderComida("🌤", "Almuerzo", dia.almuerzo, "noon")}
        ${renderComida("🌙", "Cena", dia.cena, "night")}
      </div>
      <div class="dia-total">
        <span class="total-label">Total del día</span>
        <span class="total-val">${dia.totalKcal} kcal</span>
      </div>`;
    grid.appendChild(card);
  });
}

function renderComida(icon, nombre, items, cls) {
  if (!items || !items.length) return "";
  const total = items.reduce((s, a) => s + parseInt(a.calorias || 0), 0);
  return `
    <div class="comida-block ${cls}">
      <div class="comida-title"><span>${icon}</span> ${nombre} <span class="comida-kcal">${total} kcal</span></div>
      <ul class="comida-list">
        ${items.map(a => `<li><span class="a-nombre">${esc(a.nombre)}</span><span class="a-kcal">${a.calorias} kcal</span></li>`).join("")}
      </ul>
    </div>`;
}

/* ═══════════════════════════════════════════════════
   MÓDULO: HISTORIAL DE DIETAS con Fetch + Filtros
   ═══════════════════════════════════════════════════ */
let dietasData = [];

async function loadDietas() {
  const tbl = $("#dietas-tbody");
  if (!tbl) return;
  tbl.innerHTML = `<tr><td colspan="8" class="loading-cell"><span class="spin">⟳</span> Cargando…</td></tr>`;
  try {
    dietasData = await fetchJSON("../api/dietas.php");
    renderDietas(dietasData);
    updateDietasCount(dietasData.length);
  } catch (e) {
    tbl.innerHTML = `<tr><td colspan="8" class="err-cell">Error al cargar datos.</td></tr>`;
  }
}

function renderDietas(rows) {
  const tbl = $("#dietas-tbody");
  if (!tbl) return;
  if (!rows.length) {
    tbl.innerHTML = `<tr><td colspan="8"><div class="empty-state">
      <span class="empty-emoji">🥗</span>
      <p>Sin resultados. <a href="generar_dieta.php">Generar mi primera dieta</a></p>
    </div></td></tr>`;
    return;
  }
  const OBJ_BADGE = {
    Perder: { cls: "badge-orange", icon: "🔥" },
    Mantener: { cls: "badge-green", icon: "⚖️" },
    Ganar: { cls: "badge-purple", icon: "💪" },
  };
  tbl.innerHTML = rows.map(d => {
    const b = OBJ_BADGE[d.objetivo] || { cls: "badge-green", icon: "✅" };
    return `<tr>
      <td class="td-muted">${esc(d.fecha)}</td>
      <td>${esc(d.peso)} <span class="td-muted">kg</span></td>
      <td>${esc(d.altura)} <span class="td-muted">m</span></td>
      <td><strong>${parseFloat(d.imc).toFixed(2)}</strong></td>
      <td><span class="td-strong">${Math.round(d.calorias)}</span> <span class="td-muted">kcal</span></td>
      <td><span class="badge ${b.cls}">${b.icon} ${esc(d.objetivo)}</span></td>
      <td class="cell-desc">${esc(d.descripcion).substring(0, 80)}…</td>
      <td>
        <div class="action-btns">
          <button class="btn-icon" title="Ver detalle" onclick="verDieta(${d.id})">👁</button>
          <button class="btn-icon btn-dl" title="Descargar PDF" onclick="descargarDietaPDF(${d.id})">📄</button>
          <button class="btn-icon btn-csv" title="Descargar CSV" onclick="descargarDietaCSV(${d.id})">📊</button>
        </div>
      </td>
    </tr>`;
  }).join("");
}

function updateDietasCount(n) {
  const el = $("#dietas-count");
  if (el) el.textContent = `${n} registros`;
}

function filterDietas() {
  const f = {
    fecha: ($("#f-fecha")?.value || "").toLowerCase(),
    peso: ($("#f-peso")?.value || "").toLowerCase(),
    altura: ($("#f-altura")?.value || "").toLowerCase(),
    calorias: ($("#f-calorias")?.value || "").toLowerCase(),
    objetivo: ($("#f-objetivo")?.value || ""),
    desc: ($("#f-desc")?.value || "").toLowerCase(),
  };
  const filtered = dietasData.filter(d =>
    (!f.fecha || d.fecha?.toLowerCase().includes(f.fecha)) &&
    (!f.peso || String(d.peso).includes(f.peso)) &&
    (!f.altura || String(d.altura).includes(f.altura)) &&
    (!f.calorias || String(Math.round(d.calorias)).includes(f.calorias)) &&
    (!f.objetivo || d.objetivo === f.objetivo) &&
    (!f.desc || d.descripcion?.toLowerCase().includes(f.desc))
  );
  renderDietas(filtered);
  updateDietasCount(filtered.length);
}

function clearDietaFilters() {
  $$(".dieta-filter").forEach(i => i.value = "");
  renderDietas(dietasData);
  updateDietasCount(dietasData.length);
}

/* Ver detalle de dieta en modal */
function verDieta(id) {
  const d = dietasData.find(x => x.id == id);
  if (!d) return;
  const OBJ_BADGE = {
    Perder: { cls: "badge-orange", icon: "🔥" },
    Mantener: { cls: "badge-green", icon: "⚖️" },
    Ganar: { cls: "badge-purple", icon: "💪" },
  };
  const b = OBJ_BADGE[d.objetivo] || { cls: "badge-green", icon: "✅" };
  openModal(`
    <div class="modal-header-row">
      <h3 class="modal-title">📋 Detalle de dieta</h3>
      <span class="badge ${b.cls}">${b.icon} ${esc(d.objetivo)}</span>
    </div>
    <div class="modal-stats">
      <div class="ms-item"><span class="ms-val">${esc(d.peso)} kg</span><span class="ms-lbl">Peso</span></div>
      <div class="ms-item"><span class="ms-val">${esc(d.altura)} m</span><span class="ms-lbl">Altura</span></div>
      <div class="ms-item"><span class="ms-val">${parseFloat(d.imc).toFixed(2)}</span><span class="ms-lbl">IMC</span></div>
      <div class="ms-item"><span class="ms-val ms-orange">${Math.round(d.calorias)}</span><span class="ms-lbl">kcal/día</span></div>
    </div>
    <div class="modal-desc">
      <div class="mdesc-title">Plan nutricional:</div>
      <div class="mdesc-body">${esc(d.descripcion).replace(/\n/g, "<br>")}</div>
    </div>
    <div class="modal-meta">Generado el ${esc(d.fecha)} · Género: ${esc(d.genero)} · Actividad: ${esc(d.actividad)}</div>
    <div class="modal-actions">
      <button class="btn-sm" onclick="descargarDietaPDF(${d.id})">📄 Descargar PDF</button>
      <button class="btn-sm btn-sm-csv" onclick="descargarDietaCSV(${d.id})">📊 Exportar CSV</button>
    </div>
  `);
}

/* ─── Exportar dieta PDF (client-side con jsPDF) ─── */
async function descargarDietaPDF(id) {
  const d = id ? dietasData.find(x => x.id == id) : null;
  const rows = d ? [d] : dietasData;
  if (!rows.length) { showToast("Sin datos para exportar", "warn"); return; }

  await loadjsPDF();
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ unit: "mm", format: "a4" });

  // Colores marca
  const OR = [255, 107, 53], GR = [6, 214, 160], INK = [26, 26, 46];

  // Header
  doc.setFillColor(...OR);
  doc.rect(0, 0, 210, 36, "F");
  doc.setTextColor(255, 255, 255);
  doc.setFontSize(22); doc.setFont("helvetica", "bold");
  doc.text("NutriPlan", 16, 18);
  doc.setFontSize(10); doc.setFont("helvetica", "normal");
  doc.text("Sistema de Nutrición Personalizada", 16, 26);
  doc.text(`Generado: ${new Date().toLocaleDateString("es-DO")}`, 140, 18);

  let y = 48;
  rows.forEach((item, idx) => {
    if (idx > 0) {
      if (y > 240) { doc.addPage(); y = 20; }
      doc.setDrawColor(...OR);
      doc.setLineWidth(0.5);
      doc.line(14, y, 196, y);
      y += 8;
    }
    // Título dieta
    doc.setFillColor(248, 245, 240);
    doc.roundedRect(14, y - 4, 182, 10, 2, 2, "F");
    doc.setTextColor(...INK); doc.setFontSize(11); doc.setFont("helvetica", "bold");
    doc.text(`Dieta #${item.id} — ${item.fecha}`, 18, y + 3);
    y += 12;

    // Stats row
    const stats = [
      ["Peso", `${item.peso} kg`],
      ["Altura", `${item.altura} m`],
      ["IMC", parseFloat(item.imc).toFixed(2)],
      ["Calorías", `${Math.round(item.calorias)} kcal`],
      ["Objetivo", item.objetivo],
      ["Actividad", item.actividad],
    ];
    stats.forEach(([lbl, val], i) => {
      const col = i % 3, row = Math.floor(i / 3);
      const x = 14 + col * 62, yy = y + row * 14;
      doc.setFillColor(255, 255, 255);
      doc.setDrawColor(232, 224, 212);
      doc.setLineWidth(0.4);
      doc.roundedRect(x, yy, 58, 10, 2, 2, "FD");
      doc.setTextColor(138, 138, 170); doc.setFontSize(7); doc.setFont("helvetica", "normal");
      doc.text(lbl.toUpperCase(), x + 4, yy + 4);
      doc.setTextColor(...INK); doc.setFontSize(9); doc.setFont("helvetica", "bold");
      doc.text(String(val), x + 4, yy + 8.5);
    });
    y += 32;

    // Descripción
    doc.setTextColor(...INK); doc.setFontSize(9); doc.setFont("helvetica", "bold");
    doc.text("Plan nutricional:", 14, y); y += 5;
    doc.setFont("helvetica", "normal"); doc.setFontSize(8.5); doc.setTextColor(74, 74, 106);
    const lines = doc.splitTextToSize(item.descripcion || "", 182);
    lines.forEach(ln => {
      if (y > 270) { doc.addPage(); y = 20; }
      doc.text(ln, 14, y); y += 4.5;
    });
    y += 6;
  });

  // Footer
  const pages = doc.internal.getNumberOfPages();
  for (let i = 1; i <= pages; i++) {
    doc.setPage(i);
    doc.setFillColor(...OR);
    doc.rect(0, 287, 210, 10, "F");
    doc.setTextColor(255, 255, 255); doc.setFontSize(7); doc.setFont("helvetica", "normal");
    doc.text("NutriPlan — Sistema de Nutrición Personalizada", 14, 293);
    doc.text(`Pág. ${i} / ${pages}`, 190, 293, { align: "right" });
  }

  doc.save(id ? `NutriPlan_Dieta_${id}.pdf` : "NutriPlan_Historial_Dietas.pdf");
  showToast("PDF generado exitosamente 📄");
}

/* ─── Exportar dieta CSV ─────────────────────────── */
function descargarDietaCSV(id) {
  const rows = id ? dietasData.filter(x => x.id == id) : dietasData;
  if (!rows.length) { showToast("Sin datos para exportar", "warn"); return; }
  const headers = ["ID", "Fecha", "Peso (kg)", "Altura (m)", "IMC", "Calorías", "Objetivo", "Género", "Actividad", "Descripción"];
  const csvRows = [headers, ...rows.map(d => [
    d.id, d.fecha, d.peso, d.altura,
    parseFloat(d.imc).toFixed(2), Math.round(d.calorias),
    d.objetivo, d.genero, d.actividad,
    `"${(d.descripcion || "").replace(/"/g, '""').replace(/\n/g, " ")}"`
  ])];
  const csv = csvRows.map(r => r.join(",")).join("\n");
  downloadBlob(csv, id ? `NutriPlan_Dieta_${id}.csv` : "NutriPlan_Historial.csv", "text/csv;charset=utf-8;");
  showToast("CSV exportado exitosamente 📊");
}

/* ═══════════════════════════════════════════════════
   MÓDULO: USUARIOS con Fetch + Filtros
   ═══════════════════════════════════════════════════ */
let usuariosData = [];

async function loadUsuarios() {
  const tbl = $("#usuarios-tbody");
  if (!tbl) return;
  tbl.innerHTML = `<tr><td colspan="5" class="loading-cell"><span class="spin">⟳</span> Cargando…</td></tr>`;
  try {
    usuariosData = await fetchJSON("../api/usuarios.php");
    renderUsuarios(usuariosData);
    const el = $("#usuarios-count");
    if (el) el.textContent = `${usuariosData.length} usuarios`;
  } catch (e) {
    tbl.innerHTML = `<tr><td colspan="5" class="err-cell">Error al cargar usuarios.</td></tr>`;
  }
}

const GRAD_COLORS = ["var(--grad-orange)", "var(--grad-green)", "var(--grad-purple)", "var(--grad-yellow)"];

function renderUsuarios(rows) {
  const tbl = $("#usuarios-tbody");
  if (!tbl) return;
  if (!rows.length) {
    tbl.innerHTML = `<tr><td colspan="5"><div class="empty-state"><span class="empty-emoji">👥</span><p>Sin resultados.</p></div></td></tr>`;
    return;
  }
  tbl.innerHTML = rows.map((u, i) => `
    <tr>
      <td class="td-muted" style="font-size:12px">#${esc(u.id)}</td>
      <td>
        <div class="user-cell">
          <div class="user-mini-av" style="background:${GRAD_COLORS[i % 4]}">${esc((u.nombre || "").substring(0, 2).toUpperCase())}</div>
          <strong>${esc(u.nombre)}</strong>
        </div>
      </td>
      <td class="td-muted">${esc(u.email)}</td>
      <td>
        ${u.rol === "admin"
      ? '<span class="badge badge-purple">🛡 Administrador</span>'
      : '<span class="badge badge-green">👤 Usuario</span>'}
      </td>
      <td>
        <div class="action-btns">
          <button class="btn-icon btn-dl" title="PDF" onclick="descargarUsuariosPDF([${u.id}])">📄</button>
        </div>
      </td>
    </tr>`
  ).join("");
  const el = $("#usuarios-count");
  if (el) el.textContent = `${rows.length} usuarios`;
}

function filterUsuarios() {
  const nombre = ($("#fu-nombre")?.value || "").toLowerCase();
  const email = ($("#fu-email")?.value || "").toLowerCase();
  const rol = ($("#fu-rol")?.value || "");
  const filtered = usuariosData.filter(u =>
    (!nombre || u.nombre?.toLowerCase().includes(nombre)) &&
    (!email || u.email?.toLowerCase().includes(email)) &&
    (!rol || u.rol === rol)
  );
  renderUsuarios(filtered);
}

function clearUsuarioFilters() {
  $$(".usuario-filter").forEach(i => i.value = "");
  renderUsuarios(usuariosData);
}

/* ─── PDF usuarios ─────────────────────────────── */
async function descargarUsuariosPDF(ids = null) {
  const rows = ids ? usuariosData.filter(u => ids.includes(u.id)) : usuariosData;
  if (!rows.length) { showToast("Sin datos", "warn"); return; }
  await loadjsPDF();
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ unit: "mm", format: "a4" });
  const OR = [255, 107, 53], INK = [26, 26, 46];

  doc.setFillColor(...OR);
  doc.rect(0, 0, 210, 36, "F");
  doc.setTextColor(255, 255, 255);
  doc.setFontSize(20); doc.setFont("helvetica", "bold");
  doc.text("NutriPlan — Usuarios", 16, 18);
  doc.setFontSize(9); doc.setFont("helvetica", "normal");
  doc.text(`Total: ${rows.length} usuarios · ${new Date().toLocaleDateString("es-DO")}`, 16, 27);

  let y = 48;
  const cols = [14, 24, 74, 134, 170];
  const heads = ["#", "Nombre", "Correo", "Rol"];

  doc.setFillColor(248, 245, 240);
  doc.rect(14, y - 4, 182, 8, "F");
  doc.setTextColor(138, 138, 170); doc.setFontSize(8); doc.setFont("helvetica", "bold");
  heads.forEach((h, i) => doc.text(h, cols[i], y + 1));
  y += 8;

  rows.forEach((u, idx) => {
    if (y > 270) { doc.addPage(); y = 20; }
    if (idx % 2 === 0) { doc.setFillColor(252, 250, 248); doc.rect(14, y - 3, 182, 7, "F"); }
    doc.setTextColor(...INK); doc.setFontSize(8.5); doc.setFont("helvetica", "normal");
    doc.text(String(u.id), cols[0], y + 1);
    doc.text((u.nombre || "").substring(0, 25), cols[1], y + 1);
    doc.text((u.email || "").substring(0, 30), cols[2], y + 1);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(u.rol === "admin" ? 124 : 6, u.rol === "admin" ? 58 : 214, u.rol === "admin" ? 237 : 160);
    doc.text(u.rol || "", cols[3], y + 1);
    y += 7;
  });

  const pages = doc.internal.getNumberOfPages();
  for (let i = 1; i <= pages; i++) {
    doc.setPage(i);
    doc.setFillColor(...OR);
    doc.rect(0, 287, 210, 10, "F");
    doc.setTextColor(255, 255, 255); doc.setFontSize(7); doc.setFont("helvetica", "normal");
    doc.text("NutriPlan — Gestión de Usuarios", 14, 293);
    doc.text(`Pág. ${i}/${pages}`, 190, 293, { align: "right" });
  }
  doc.save("NutriPlan_Usuarios.pdf");
  showToast("PDF de usuarios generado 📄");
}

function descargarUsuariosCSV() {
  const headers = ["ID", "Nombre", "Email", "Rol"];
  const csv = [headers, ...usuariosData.map(u => [u.id, u.nombre, u.email, u.rol])].map(r => r.join(",")).join("\n");
  downloadBlob(csv, "NutriPlan_Usuarios.csv", "text/csv;charset=utf-8;");
  showToast("CSV exportado 📊");
}

/* ═══════════════════════════════════════════════════
   MÓDULO: ALIMENTOS (panel nutrición)
   ═══════════════════════════════════════════════════ */
let alimentosData = [];

async function loadAlimentos() {
  const grid = $("#alimentos-grid");
  if (!grid) return;
  grid.innerHTML = '<div class="loading-state"><span class="spin big">⟳</span><p>Cargando alimentos…</p></div>';
  try {
    alimentosData = await fetchJSON("../api/alimentos.php");
    renderAlimentos(alimentosData);
  } catch (e) {
    grid.innerHTML = '<p class="err-msg">Error al cargar alimentos.</p>';
  }
}

function renderAlimentos(items) {
  const grid = $("#alimentos-grid");
  if (!grid) return;
  if (!items.length) {
    grid.innerHTML = '<p class="err-msg">Sin resultados.</p>';
    return;
  }
  grid.innerHTML = items.map(a => `
    <div class="alimento-card">
      <div class="alimento-emoji">${esc(a.emoji)}</div>
      <div class="alimento-info">
        <div class="alimento-nombre">${esc(a.nombre)}</div>
        <div class="alimento-cat">${esc(a.categoria)}</div>
        <div class="alimento-stats">
          <span class="al-stat orange">🔥 ${a.calorias} kcal</span>
          <span class="al-stat green">💪 ${a.proteinas}g prot</span>
          <span class="al-stat blue">🍞 ${a.carbos}g carbs</span>
        </div>
        <div class="alimento-desc">${esc(a.descripcion)}</div>
      </div>
    </div>`
  ).join("");
}

function filterAlimentos() {
  const q = ($("#al-search")?.value || "").toLowerCase();
  const cat = ($("#al-cat")?.value || "");
  const filtered = alimentosData.filter(a =>
    (!q || a.nombre?.toLowerCase().includes(q) || a.descripcion?.toLowerCase().includes(q)) &&
    (!cat || a.categoria === cat)
  );
  renderAlimentos(filtered);
}

/* ═══════════════════════════════════════════════════
   MODAL GENÉRICO
   ═══════════════════════════════════════════════════ */
function openModal(html) {
  let overlay = $("#modal-overlay");
  if (!overlay) {
    overlay = document.createElement("div");
    overlay.id = "modal-overlay";
    overlay.innerHTML = `<div id="modal-box"><button id="modal-close" onclick="closeModal()">✕</button><div id="modal-body"></div></div>`;
    overlay.addEventListener("click", e => { if (e.target === overlay) closeModal(); });
    document.body.appendChild(overlay);
  }
  $("#modal-body").innerHTML = html;
  overlay.style.display = "flex";
  document.body.style.overflow = "hidden";
}

function closeModal() {
  const overlay = $("#modal-overlay");
  if (overlay) overlay.style.display = "none";
  document.body.style.overflow = "";
}

/* ─── Helpers internos ───────────────────────────── */
function downloadBlob(content, filename, mime) {
  const blob = new Blob(["\uFEFF" + content], { type: mime });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url; a.download = filename;
  document.body.appendChild(a); a.click();
  document.body.removeChild(a); URL.revokeObjectURL(url);
}

let jsPDFloaded = false;
function loadjsPDF() {
  if (jsPDFloaded || window.jspdf) { jsPDFloaded = true; return Promise.resolve(); }
  return new Promise((res, rej) => {
    const s = document.createElement("script");
    s.src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js";
    s.onload = () => { jsPDFloaded = true; res(); };
    s.onerror = rej;
    document.head.appendChild(s);
  });
}

/* ═══════════════════════════════════════════════════
   INIT — carga automática según página
   ═══════════════════════════════════════════════════ */
document.addEventListener("DOMContentLoaded", () => {
  const page = document.body.dataset.page;
  if (page === "menu") loadMenuSemana();
  if (page === "dietas") loadDietas();
  if (page === "usuarios") loadUsuarios();
  if (page === "alimentos") loadAlimentos();

  // Event delegation filtros dieta
  $$(".dieta-filter").forEach(el => el.addEventListener("input", filterDietas));
  // Event delegation filtros usuario
  $$(".usuario-filter").forEach(el => el.addEventListener("input", filterUsuarios));
  // Filtro alimentos
  $$(".al-filter").forEach(el => el.addEventListener("input", filterAlimentos));
});
