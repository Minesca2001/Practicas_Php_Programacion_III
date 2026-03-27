import Router from '../router.js';
import { dietas } from './api.js';

export default function Dietas() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>Dietas</h1>
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
    const list = await dietas();
    const cont = el.querySelector('#contenido');
    if(!list || !list.length){
      cont.innerHTML = '<p>No hay dietas en el sistema.</p>';
      return;
    }
    cont.innerHTML = `
      <div class="table-wrapper">
        <table>
          <thead>
            <tr><th>Nombre</th><th>Usuario</th><th>Fecha</th></tr>
          </thead>
          <tbody>
            ${list.map(d => `
              <tr>
                <td>${d.nombre}</td>
                <td>${d.usuario}</td>
                <td>${d.fecha}</td>
              </tr>`).join('')}
          </tbody>
        </table>
      </div>`;
  })();
  return el;
}