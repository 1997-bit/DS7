function validateRegister(){
  const u=document.getElementById('username').value.trim();
  const e=document.getElementById('email').value.trim();
  const p=document.getElementById('password').value;
  const err=document.getElementById('reg_error');
  err.textContent='';
  if(u.length<3){err.textContent='Usuario demasiado corto';return false}
  if(!/.+@.+\..+/.test(e)){err.textContent='Email inválido';return false}
  if(p.length<15){err.textContent='La contraseña debe tener al menos 15 caracteres';return false}
  if(!/[0-9]/.test(p)||!/[a-zA-Z]/.test(p)||!/[^a-zA-Z0-9]/.test(p)){err.textContent='Contraseña debe combinar letras, números y símbolos';return false}
  return true
}

function validateApplicant(){
  const ced=document.getElementById('cedula').value.trim();
  const nom=document.getElementById('nombre').value.trim();
  const ape=document.getElementById('apellido').value.trim();
  const genero=document.getElementById('genero').value;
  const fecha=document.getElementById('fecha_nacimiento').value;
  const nacional=document.getElementById('nacionalidad').value.trim();
  const tel=document.getElementById('telefono').value.trim();
  const res=document.getElementById('residencia').value.trim();
  const correo=document.getElementById('correo').value.trim();
  const err=document.getElementById('form_error');
  err.textContent='';
  if(!ced||!nom||!ape||!genero||!fecha||!nacional||!tel||!res||!correo){err.textContent='Complete todos los campos obligatorios';return false}
  return true
}
