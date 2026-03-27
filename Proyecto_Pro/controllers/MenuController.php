<?php
require_once "../config/conexion.php";

// GUARDAR
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'] ?? '';

    $sql = "INSERT INTO alimentos (nombre) VALUES ('$nombre')";

    if ($conn->query($sql)) {
        echo json_encode(["status" => "ok"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    exit;
}

// LISTAR
if (isset($_GET['listar'])) {
    $result = $conn->query("SELECT * FROM alimentos");

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
              </tr>";
    }
    exit;
}
?>
