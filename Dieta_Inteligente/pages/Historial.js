import Router from '../router.js';
import { historial } from './api.js';

export default function Historial() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>Historial</h1>
      <nav>
        <a href="#" onclick="router.go('/dashboard')">Volver</a>
      </nav>
    </header>
    <main>
      <section class="card">
        <div id="contenido"></div>
      </section>
    </main>
  `;

  (async () => {
    const list = await historial();
    const cont = el.querySelector('#contenido');
    if(!list || !list.length){
      cont.innerHTML = '<p>No hay dietas registradas. <a href="#" onclick="router.go(\'/generar_dieta\')">Genera una ahora</a>.</p>';
      return;
    }
    cont.innerHTML = `
      <div class="table-wrapper">
        <table>
          <thead>
            <tr><th>Nombre</th><th>Fecha</th><th>Acciones</th></tr>
          </thead>
          <tbody>
            ${list.map(d => `
              <tr>
                <td>${d.nombre}</td>
                <td>${d.fecha}</td>
                <td><a href="/historial.php?id=${d.id}" target="_blank">Ver</a></td>
              </tr>`).join('')}
          </tbody>
        </table>
      </div>`;
  })();
  return el;
}