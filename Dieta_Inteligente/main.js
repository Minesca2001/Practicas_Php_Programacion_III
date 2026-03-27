import Router from './router.js';
import { checkAuth, logout } from './auth.js';

(async () => {
  await checkAuth();
  const app = document.getElementById('app');
  Router.init(app);
})();

document.addEventListener('click', e => {
  if(e.target.matches('[data-logout]')) {
    e.preventDefault();
    logout();
  }
});