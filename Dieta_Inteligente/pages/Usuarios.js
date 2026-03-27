import Router from '../router.js';
import { usuarios } from './api.js';

export default function Usuarios() {
  const el = document constructor();
  el.innerHTML = `
    <header>
      <h1>Usuarios</h1>
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
    const list = await usuarios();
    const cont = el.querySelector('#contenido');
    if(!list || !list.length){
      cont.innerHTML = '<p>No hay usuarios registrados.</p>';
      return;
    }
    cont.innerHTML = `
      <div class="table">
        <table>
          <thead>
            <tr><th>Nombre</th><th>Correo</th><th>Registro</th></tr>
          </thead>
          <tbody>
            ${list.map(u => `
              <tr>
                <td>${u.nombre}</td>
                <td>${u.email}</td>
                <td>${u.fecha_registro}</td>
              </tr>`).join('')}
          </tbody>
        </table>
      </div>`;
  })();
  return el;
}