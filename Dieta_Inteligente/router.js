import Home from './pages/Home.js';
import Login from './pages/Login.js';
import Registro from './pages/Registro.js';
import Dashboard from './pages/Dashboard.js';
import Historial from './pages/Historial.js';
import GenerarDieta from './pages/GenerarDieta.js';
import Dietas from './pages/Dietas.js';
import Usuarios from './pages/Usuarios.js';

const routes = {
  '/': Home,
  '/login': Login,
  '/registro': Registro,
  '/dashboard': Dashboard,
  '/historial': Historial,
  '/generar_dieta': GenerarDieta,
  '/dietas': Dietas,
  '/usuarios': Usuarios
};

export default {
  init(app) {
    this.app = app;
    window.addEventListener('popstate', () => this.resolve());
    this.resolve();
  },
  resolve() {
    const path = location.pathname;
    const Component = routes[path] || Home;
    this.app.innerHTML = '';
    this.app.appendChild(new Component());
  },
  go(path) {
    history.pushState(null, null, path);
    this.resolve();
  }
};