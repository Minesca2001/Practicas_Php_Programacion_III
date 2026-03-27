<link rel="stylesheet" href="../css/style.css">

<div class="container">

    <form action="../controllers/UsuarioController.php" method="POST">

        <h2>Crear Cuenta</h2>
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="password" name="confirmar" placeholder="Confirmar contraseña" required>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select>

        <button type="submit" name="guardar">Registrarse</button>

    </form>

</div>