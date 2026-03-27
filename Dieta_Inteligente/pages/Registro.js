import Router from '../router.js';
import { checkAuth } from '../auth.js';

export default function Registro() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>DiietaInteligente</h1>
      <nav><a href="#" onclick="router.go('/')">Volver</a></nav>
    </header>
    <main>
      <section class="card" style="max-width:400px;margin:2rem auto;">
        <h2>Crear Cuenta</h2>
        <form id="regForm">
          <div class="form-group">
            <label>Nombre</label>
            <input name="nombre" required>
          </div>
          <div class="form-group">
            <label>Correo</label>
            <input name="email" type="email" required>
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input name="password" type="password" required>
          </div>
          <div class="form-actions">
            <button type="submit">Registrarse</button>
          </div>
          <div id="msg" class="error"></div>
        </form>
      </section>
    </main>
  `;

  el.querySelector('#regForm').addEventaddEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const res = await fetch('/registro.php', { method:'POST', body:fd });
    const data = await res.json();
    if(data.success){
      await checkAuth();
      Router.go('/dashboard');
    } else {
      el.querySelector('#msg').text = data.error || 'Error al registrarse';
    }
  });
  return el;
}