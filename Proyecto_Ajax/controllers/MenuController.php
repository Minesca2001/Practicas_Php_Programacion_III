<?php
require_once "../config/conexion.php";

// INSERT / UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';

    if ($id == "") {
        $sql = "INSERT INTO alimentos(nombre) VALUES('$nombre')";
    } else {
        $sql = "UPDATE alimentos SET nombre='$nombre' WHERE id='$id'";
    }

    echo $conn->query($sql) ? json_encode(["status" => "ok"]) : json_encode(["status" => "error"]);
    exit;
}

// DELETE
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM alimentos WHERE id='$id'");
    exit;
}

// LIST
if (isset($_GET['listar'])) {
    $res = $conn->query("SELECT * FROM alimentos");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nombre']}</td>
        <td>
            <button onclick='editar({$row['id']}," {
            $row['nombre']
        }
        ")'>Editar</button>
            <button onclick='eliminar({$row['id']})'>Eliminar</button>
        </td>
        </tr>";
    }
    exit;
}
?>