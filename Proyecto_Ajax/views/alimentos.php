<!DOCTYPE html>
<html>

<body>

    <h2>CRUD AJAX PRO</h2>

    <form id="form">
        <input type="hidden" name="id" id="id">
        <input type="text" name="nombre" id="nombre" required>
        <button type="submit">Guardar</button>
    </form>

    <div id="msg"></div>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla"></tbody>
    </table>

    <script>
        document.getElementById("form").addEventListener("submit", e => {
            e.preventDefault();
            fetch("../controllers/MenuController.php", { method: "POST", body: new FormData(e.target) })
                .then(r => r.json()).then(d => {
                    document.getElementById("msg").innerHTML = "Guardado";
                    e.target.reset();
                    cargar();
                });
        });

        function cargar() {
            fetch("../controllers/MenuController.php?listar=1")
                .then(r => r.text()).then(d => { tabla.innerHTML = d });
        }

        function eliminar(id) {
            fetch("../controllers/MenuController.php?eliminar=" + id)
                .then(() => cargar());
        }

        function editar(id, nombre) {
            document.getElementById("id").value = id;
            document.getElementById("nombre").value = nombre;
        }

        cargar();
    </script>

</body>

</html>