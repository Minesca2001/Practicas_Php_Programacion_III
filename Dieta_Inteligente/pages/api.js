export async function generarDieta(fd){
  const r = await fetch('/generar_dieta.php', { method:'POST', body:fd });
  const j = await r.json();
  return j.success;
}
export async function historial(){
  const r = await fetch('/historial.php');
  const j = await r.json();
  return j.success ? j.data : [];
}
export async function dietas(){
  const r = await fetch('/listar_dietas.php');
  const j = await r.json();
  return j.success ? j.data : [];
}
export async function usuarios(){
  const r = await fetch('/listar_usuarios.php');
  const j = await r.json();
  return j.success ? j.data : [];
}