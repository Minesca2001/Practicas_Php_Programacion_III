import Router from '../router.js';
import { generarDieta, historial } from './api.js';

export default function Dashboard() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>Dashboard</h1>
      <nav>
        <a href="#" onclick="router.go('/generar_dieta')">Generar Dieta</a>
        <a href="#" onclick="router.go('/historial')">Historial</a>
        <a href="#" data-logout">Salir</a>
      </nav>
    </header>
    <main>
      <section class="card">
        <h2>Resumen</h2>
        <p>Bienvenido de nuevo. Aquí verás tus dietas recientes.</p>
        <div id="resumen"></div>
      </section>
    </main>
  `;

  (async () => {
    const list = await historial();
    const res = el.querySelector('#resumen');
    if(list && list.length){
      res.innerHTML = '<ul>' + list.slice(0,3).map(d => `<li>${d.nombre} - ${d.fecha}</li>`).join('') + '</ul>';
    } else {
      res.innerHTML = '<p>Aún no has generado dietas. <a href="#" onclick="router.go(\'/generar_dieta\')">Crea una ahora</a>.</p>';
    }
  })();

  return el;
}