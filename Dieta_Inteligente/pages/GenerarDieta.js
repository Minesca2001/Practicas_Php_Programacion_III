import Router from '../router.js';
import { generarDieta } from './api.js';

export default function GenerarDieta() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>Generar Dieta</h1>
      <nav>
        <a href="#" onclick="router.go('/dashboard')">Volver</a>
      </nav>
    </header>
    <main>
      <section class="card">
        <form id="dietaForm">
          <div class="form-group">
            <label>Objetivo</label>
            <select name="objetivo" required>
              <option value="perder peso">Perder peso</option>
              <option value="mantener">Mantener</option>
              <option value="ganar">Ganar músculo</option>
            </select>
          </div>
          <div class="form-group">
            <label>Calorías diarias</label>
            <input name="calorias" type="number" min="1200" max="5000" required>
          </div>
          <div class="form-group">
            <label>Preferencias / Notas</label>
            <textarea name="notas" rows="3"></textarea>
          </div>
          <div class="form-actions">
            <button type="submit">Crear Dieta</button>
          </div>
          <div id="msg" class="success"></div>
        </form>
      </section>
    </main>
  `;

  el.querySelector('#dieta').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const ok = await generarDieta(fd);
    const msg = el.querySelector('#msg');
    if(ok){
      msg.textContent = 'Dieta creada con éxito. Redirigiendo...';
      setTimeout(() => Router.go('/historial'), 1200);
    } else {
      msg.className='error';
      msg.textContent = 'Error al crear dieta.';
    }
  });
  return el;
}