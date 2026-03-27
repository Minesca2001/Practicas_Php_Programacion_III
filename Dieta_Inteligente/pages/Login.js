import Router from '../router.js';
import { checkAuth } from '../auth.js';

export default function Login() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>DietaInteligente</h1>
      <nav><a href="#" onclick="router.go('/')">Volver</a></nav>
    </header>
    <main>
      <section class="card" style="max-width:400px;margin:2rem auto;">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm">
          <div class="form-group">
            <label>Correo</label>
            <input name="email" type="email" required>
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input name="password" type="password" required>
          </div>
          <div class="form-actions">
            <button type="submit">Entrar</button>
          </div>
          <div id="msg" class="error"></div>
        </form>
      </section>
    </main>
  `;

  el.querySelector('#loginForm').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const res = await fetch('/login.php', { method:'POST', body:fd });
    const data = await res.json();
    if(data.success){
      await checkAuth();
      Router.go('/dashboard');
    } else {
      el.querySelector('#msg').textContent = data.error || 'Error al iniciar sesión';
    }
  });
  return el;
}