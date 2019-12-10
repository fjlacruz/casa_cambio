
   function myFunction(idButton) {
      var medidores = document.getElementById('medidores');
      var editar_medidor = document.getElementById('editar_medidor');
      var asignar_medidor = document.getElementById('asignar_medidor');
   
      switch(idButton) {
       case 1:
       medidores.style.display = 'block';
       editar_medidor.style.display = 'none';
       asignar_medidor.style.display = 'none';
       break;

       case 2:
       medidores.style.display = 'none';
       editar_medidor.style.display = 'block';
       asignar_medidor.style.display = 'none';
       break;
       
       case 3:
       medidores.style.display = 'none';
       editar_medidor.style.display = 'none';
       asignar_medidor.style.display = 'block';
       break;


       default:
       alert("hay un problema: No existe la Ruta.")
   }

}
