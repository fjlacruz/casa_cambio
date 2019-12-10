
   function myFunction(idButton) {
      var usuarios = document.getElementById('usuarios');
     // var detalles_usuarios = document.getElementById('detalles_usuarios');

      switch(idButton) {
       case 1:
       usuarios.style.display = 'block';
      // detalles_usuarios.style.display = 'none';
       break;

      // case 2:
      // usuarios.style.display = 'none';
      // detalles_usuarios.style.display = 'block';
      // break;
      // default:
       alert("hay un problema: No existe la ruta.")
   }

}

/*
function myFunction(idButton) {
   var usuarios = document.getElementById('usuarios');
   var registrar_usuario = document.getElementById('registrar_usuario');
   var editar_usuarios = document.getElementById('editar_usuarios');

   switch(idButton) {
    case 1:
    usuarios.style.display = 'block';
    registrar_usuario.style.display = 'none';
    editar_usuarios.style.display = 'none';
    break;

    case 2:
    usuarios.style.display = 'none';
    registrar_usuario.style.display = 'block';
    editar_usuarios.style.display = 'none';
    break;

    case 3:
    usuarios.style.display = 'none';
    registrar_usuario.style.display = 'none';
    editar_usuarios.style.display = 'block';
    break;

    default:
    alert("hay un problema: No existe el producto.")
}

}*/