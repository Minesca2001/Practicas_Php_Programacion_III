<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>AJAX PHP</title>
</head>
<body>

<h2>Registro de Alimentos</h2>

<form id="formAlimento">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <button type="submit">Guardar</button>
</form>

<div id="mensaje"></div>

<table border="1">
    <thead>
        <tr><th>ID</th><th>Nombre</th></tr>
    </thead>
    <tbody id="tabla"></tbody>
</table>

<script>
document.getElementById("formAlimento").addEventListener("submit", function(e) {
    e.preventDefault();

    const datos = new FormData(this);

    fetch("../controllers/MenuController.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "ok") {
            document.getElementById("mensaje").innerHTML = "Guardado";
            cargarDatos();
        } else {
            document.getElementById("mensaje").innerHTML = "Error";
        }
    });
});

function cargarDatos() {
    fetch("../controllers/MenuController.php?listar=1")
    .then(res => res.text())
    .then(html => {
        document.getElementById("tabla").innerHTML = html;
    });
}

cargarDatos();
</script>

</body>
</html>
