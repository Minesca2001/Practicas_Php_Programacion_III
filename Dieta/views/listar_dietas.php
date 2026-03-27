<?php
session_start();
require_once "../config/conexion.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

// Consulta filtrada
$sql = "SELECT * FROM dietas WHERE usuario_id = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);

$dietas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Historial de Dietas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <h2 class="text-center mb-4">📊 Historial de Dietas</h2>

        <table class="table table-bordered table-hover shadow">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>IMC</th>
                    <th>Calorías</th>
                    <th>Objetivo</th>
                    <th>Dieta</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($dietas) > 0): ?>

                    <?php foreach ($dietas as $d): ?>

                        <tr>
                            <td>
                                <?= $d["fecha"] ?>
                            </td>
                            <td>
                                <?= $d["peso"] ?> kg
                            </td>
                            <td>
                                <?= $d["altura"] ?> m
                            </td>
                            <td>
                                <?= round($d["imc"], 2) ?>
                            </td>
                            <td>
                                <?= round($d["calorias"]) ?>
                            </td>
                            <td>
                                <?= $d["objetivo"] ?>
                            </td>
                            <td>
                                <?= nl2br($d["descripcion"]) ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="text-center">No hay dietas registradas</td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

    </div>

</body>

</html>