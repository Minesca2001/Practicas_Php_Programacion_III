<?php
session_start();
require_once '../config/conexion.php';
require_once '../config/auth.php';

$id = (int) ($_GET['id'] ?? 0);
$uid = $_SESSION['usuario_id'];

$stmt = $conexion->prepare("SELECT d.*, u.nombre as usuario_nombre, u.email FROM dietas d JOIN usuarios u ON d.usuario_id = u.id WHERE d.id = ? AND d.usuario_id = ?");
$stmt->execute([$id, $uid]);
$d = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$d) {
  header('Location: ../views/listar_dietas.php');
  exit();
}

$imc_cat = $d['imc'] < 18.5 ? 'Bajo peso' : ($d['imc'] < 25 ? 'Peso normal' : ($d['imc'] < 30 ? 'Sobrepeso' : 'Obesidad'));

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Dieta #<?= $d['id'] ?> — NutriPlan</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;900&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background: #fff;
      color: #1A1A2E;
      padding: 40px;
      max-width: 800px;
      margin: auto;
    }

    .header {
      background: linear-gradient(135deg, #FF6B35, #FF4D6D 50%, #7C3AED);
      border-radius: 20px;
      padding: 36px;
      color: #fff;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
    }

    .header::after {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .08);
    }

    .logo {
      font-size: 22px;
      font-weight: 900;
      margin-bottom: 8px;
    }

    .logo span {
      opacity: .7;
      font-weight: 400;
      font-size: 14px;
      display: block;
      margin-top: 2px;
    }

    .header h1 {
      font-size: 28px;
      font-weight: 900;
      margin-top: 16px;
    }

    .header p {
      opacity: .75;
      font-size: 14px;
      margin-top: 4px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-bottom: 24px;
    }

    .card {
      background: #F8F5F0;
      border-radius: 14px;
      padding: 18px;
      text-align: center;
    }

    .card .val {
      font-size: 28px;
      font-weight: 900;
      color: #FF6B35;
    }

    .card .lbl {
      font-size: 11px;
      color: #8A8AAA;
      margin-top: 4px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    .section {
      background: #fff;
      border: 1.5px solid #E8E0D4;
      border-radius: 14px;
      padding: 22px;
      margin-bottom: 16px;
    }

    .section h2 {
      font-size: 16px;
      font-weight: 700;
      color: #1A1A2E;
      margin-bottom: 14px;
      padding-bottom: 10px;
      border-bottom: 2px solid #F1ECE4;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .desc {
      font-size: 14px;
      color: #4A4A6A;
      line-height: 1.8;
      white-space: pre-line;
    }

    .row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #F1ECE4;
      font-size: 14px;
    }

    .row:last-child {
      border-bottom: none;
    }

    .row .k {
      color: #8A8AAA;
    }

    .row .v {
      font-weight: 700;
      color: #1A1A2E;
    }

    .badge {
      display: inline-block;
      padding: 4px 14px;
      border-radius: 100px;
      font-size: 12px;
      font-weight: 700;
    }

    .footer {
      text-align: center;
      margin-top: 32px;
      padding-top: 20px;
      border-top: 1px solid #E8E0D4;
      font-size: 12px;
      color: #8A8AAA;
    }

    @media print {
      body {
        padding: 20px;
      }

      .no-print {
        display: none !important;
      }
    }
  </style>
</head>

<body>
  <div class="no-print" style="margin-bottom:20px;display:flex;gap:12px;">
    <button onclick="window.print()"
      style="padding:10px 22px;background:linear-gradient(135deg,#FF6B35,#FF4D6D);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;">🖨
      Imprimir / Guardar PDF</button>
    <button onclick="window.close()"
      style="padding:10px 22px;background:#F1ECE4;color:#4A4A6A;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;">✕
      Cerrar</button>
  </div>

  <div class="header">
    <div class="logo">🥗 NutriPlan <span>Reporte nutricional personal</span></div>
    <h1>Plan dietético — <?= htmlspecialchars($d['usuario_nombre']) ?></h1>
    <p>Generado el <?= date('d/m/Y H:i', strtotime($d['fecha'])) ?> · <?= htmlspecialchars($d['email']) ?></p>
  </div>

  <div class="grid">
    <div class="card">
      <div class="val"><?= round($d['calorias']) ?></div>
      <div class="lbl">Calorías / día</div>
    </div>
    <div class="card">
      <div class="val"><?= round($d['imc'], 1) ?></div>
      <div class="lbl">IMC — <?= $imc_cat ?></div>
    </div>
    <div class="card">
      <div class="val"><?= $d['objetivo'] ?></div>
      <div class="lbl">Objetivo</div>
    </div>
  </div>

  <div class="section">
    <h2>📊 Datos personales</h2>
    <div class="row"><span class="k">Peso</span><span class="v"><?= $d['peso'] ?> kg</span></div>
    <div class="row"><span class="k">Altura</span><span class="v"><?= $d['altura'] ?> m</span></div>
    <div class="row"><span class="k">Edad</span><span class="v"><?= $d['edad'] ?> años</span></div>
    <div class="row"><span class="k">Género</span><span class="v"><?= htmlspecialchars($d['genero']) ?></span></div>
    <div class="row"><span class="k">Actividad física</span><span
        class="v"><?= htmlspecialchars($d['actividad']) ?></span></div>
  </div>

  <div class="section">
    <h2>🍽 Plan de alimentación</h2>
    <div class="desc"><?= nl2br(htmlspecialchars($d['descripcion'])) ?></div>
  </div>

  <div class="footer">
    <p>📄 NutriPlan · Reporte generado automáticamente · <?= date('Y') ?></p>
    <p style="margin-top:4px">Este documento es de carácter informativo. Consulta a un nutricionista para atención
      personalizada.</p>
  </div>
</body>

</html>