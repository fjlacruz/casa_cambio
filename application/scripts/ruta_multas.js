
   function myFunction(idButton) {
      var multas = document.getElementById('multas');
      var registrar_multa = document.getElementById('registrar_multa');
      var editar_multa = document.getElementById('editar_multa');


      switch(idButton) {
       case 1:
       multas.style.display = 'block';
       registrar_multa.style.display = 'none';
       editar_multa.style.display = 'none';
       break;

       case 2:
       multas.style.display = 'none';
       registrar_multa.style.display = 'block';
       editar_multa.style.display = 'none';
       break;

       case 3:
       multas.style.display = 'none';
       registrar_multa.style.display = 'none';
       editar_multa.style.display = 'block';
       break;

       default:
       alert("hay un problema: No existe la Ruta.")
   }

}
