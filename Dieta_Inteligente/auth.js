let user = null;

export async function checkAuth() {
  const res = await fetch('/login.php');
  const data = await res.json();
  user = data.success ? data.user : null;
}

export function getUser() { return user; }

export function logout() {
  fetch('/login.php', { method: 'DELETE' }).then(() => {
    user = null;
    window.router.go('/');
  });
}