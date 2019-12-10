
   function myFunction(idButton) {
      var ingresos = document.getElementById('ingresos');
      var registrar_ingreso = document.getElementById('registrar_ingreso');
      var editar_ingreso = document.getElementById('editar_ingreso');
      var editar_adjunto = document.getElementById('editar_adjunto');
   

      switch(idButton) {
       case 1:
       ingresos.style.display = 'block';
       registrar_ingreso.style.display = 'none';
       editar_ingreso.style.display = 'none';
       editar_adjunto.style.display = 'none';
       break;

       case 2:
       ingresos.style.display = 'none';
       registrar_ingreso.style.display = 'block';
       editar_ingreso.style.display = 'none';
       editar_adjunto.style.display = 'none';
       break;

       case 3:
       ingresos.style.display = 'none';
       registrar_ingreso.style.display = 'none';
       editar_ingreso.style.display = 'block';
       editar_adjunto.style.display = 'none';
       break;
       
       case 4:
       ingresos.style.display = 'none';
       registrar_ingreso.style.display = 'none';
       editar_ingreso.style.display = 'none';
       editar_adjunto.style.display = 'block';
       break;

       default:
       alert("hay un problema: No existe la Ruta.")
   }

}
