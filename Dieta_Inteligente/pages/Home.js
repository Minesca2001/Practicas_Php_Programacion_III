import Router from '../router.js';

export default function Home() {
  const el = document.createElement('div');
  el.innerHTML = `
    <header>
      <h1>DietaInteligente</h1>
      <nav>
        <a href="#" onclick="router.go('/login')">Entrar</a>
        <a href="#" onclick="router.go('/registro')" class="btn">Registrarse</a>
      </nav>
    </header>
    <main>
      <section class="card">
        <h2>¡Bienvenido!</h2>
        <p>Genera planes de alimentación adaptados a tus objetivos y preferencias.</p>
      </section>
    </main>
  `;
  return el;
}