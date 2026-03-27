<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h2>Historial de Dietas</h2>

    <button class="btn btn-primary mb-3" onclick="cargarDietas()">Cargar Dietas</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Peso</th>
                <th>IMC</th>
                <th>Calorías</th>
            </tr>
        </thead>
        <tbody id="tablaDietas"></tbody>
    </table>

    <script>
        function cargarDietas() {
            fetch("../controllers/obtener_dietas.php")
                .then(res => res.json())
                .then(data => {

                    console.log("JSON:", data); // 📸 ESTE ES EL SCREENSHOT

                    let tabla = document.getElementById("tablaDietas");
                    tabla.innerHTML = "";

                    data.forEach(d => {
                        tabla.innerHTML += `
                    <tr>
                        <td>${d.fecha}</td>
                        <td>${d.peso}</td>
                        <td>${d.imc}</td>
                        <td>${d.calorias}</td>
                    </tr>
                `;
                    });

                });
        }
    </script>

</body>

</html>