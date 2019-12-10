<?php
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<body onload="nobackbutton();">
   <section class="content"  id="section" style="width: 95%; align-content: center">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
      <div class="box-header with-border">
         <?php
            foreach($comunidades as $resultado)
            {
            ?>
         <h3 class="box-title">Muestra Gasto Com&uacute;n</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
         </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <form id="formulario" action="" method="POST" name="formulario">
               <div class="col-md-12">
                  <div class="col-md-12" id='resultado2'></div>
                  <div class="col-sm-2">&nbsp;</div>
                  <?php if ($variablesSesion['rol'] == 3) { ?>
                  <div class="col-sm-4"><label>Comunidad</label> 
                     <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                     <input type="text" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                  </div>
                  <?php } ?>
                   <?php if ($variablesSesion['rol'] == 2) { ?>
                  <div class="col-sm-4"><label>Comunidad</label> 
                     <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                     <input type="text" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                  </div>
                  <?php } ?>
                   <?php if ($variablesSesion['rol'] == 1) { ?>
                  <div class="col-sm-4"><label>Comunidad</label> 
                      <select name="id_comunidad" id="id_comunidad"  class="form-control redondeado" ><option value="">Selecione...</option>
                           <?php
                         foreach ($com as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                     
                      </select>
                  </div>
                  <?php } ?>
                  <div class="col-sm-2">
                     <label>Per&iacute;odo</label> 
                     <select name="periodo" id="periodo"  class="form-control redondeado" required>
                        <option value="">Selecione...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                     </select>
                  </div>
                  <div class="col-sm-2">
                     <label>&nbsp;</label> 
                     <select name="anio" id="anio"  class="form-control redondeado">
                        <option value="">Selecione...</option>
                        <?php
                           for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                               echo "<option value='$anio'>" . $anio . "</option>";
                           }
                           ?>
                     </select>
                  </div>
                  <div class="col-sm-4">&nbsp;</div>
                  <div class="col-md-12">&nbsp;</div>
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-4">
                     <span tooltip="Consultar">
                     <button type="" id="buscar" class="btn bg-olive btn-circle"><i class="fa fa-search"></i>
                     </button></span>
                     <span tooltip="Regresar">
                     <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
                     </button></span>
                     <!--<button  onclick="history.back()" type="button" class="btn btn-sample"><span class='glyphicon glyphicon-arrow-left'>&nbsp;Atras</button>-->
                  </div>
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-4">&nbsp;</div>
               </div>
            </form>
         </div>
      </div>
   </section>
   <?php
      }
      ?>

   <div id='resultado'></div>
   <div class="col-sm-12">&nbsp;</div>
   <div class="col-sm-12">&nbsp;</div>
 
</body>
</html>
<script>
   $(document).on("click", '#buscar', function (){
       var dataEgreso = {
               "id_comunidad": $("#id_comunidad").val(),
               "periodo": $("#periodo").val(),
               "anio": $("#anio").val()
           };
           
           if (dataEgreso.id_comunidad === '' || dataEgreso.periodo === '' || dataEgreso.anio === '') {
   
               alertify.error("Debe completar todos los campos...!!!");
           }else{
       
        $.ajax({
           url: "<?php echo base_url() . 'index.php/egresos/detalles_egresos_por_periodo'; ?>",
           data: {id_comunidad: $('#id_comunidad').val(),periodo: $('#periodo').val(),anio: $('#anio').val()},
           dataType: 'html',
           type: 'post',
           success: function (salida) {
               //alert(salida); 
               //var datos = salida.split("~");
               //alert(datos[0]);
               $("#resultado").html(salida);
               
           }
       });
     }
   });
   
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#formulario')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       periodo: {
                           row: '.col-sm-2',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                           id_comunidad: {
                           row: '.col-sm-4',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                       anio: {
                           row: '.col-sm-2',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          }
                   }
               })
               
       
   });
   
</script>
<script>
   function nobackbutton(){
   
   window.location.hash="no-back-button";
   
   window.location.hash="Again-No-back-button" //chrome
   
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>
<script type="text/javascript">
   $(document).ready(function() {
       setTimeout(function() {
           $(".resultadoAct").fadeOut(1500);
       },3000);
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       nombres: {
                       },
                       apellidos: {
                       },
                       estatus: {
                       },
                       rol: {
                       }
                   }
               })
               .on('success.form.fv', function(e) {
                   e.preventDefault();
                   var $form = $(e.target),
                       id = $form.find('[name="id"]').val();
   
                   $.ajax({
                       url: "<?php echo base_url() . 'index.php/administracion/actualizar_estatus'; ?>",
                       method: 'POST',
                       data: $form.serialize()
                       
                   }).success(function(response) {
                       $form.parents('.bootbox').modal('hide');
                      //$.confirm();
                      $("#resultadoAct").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron actualizados Exitosamente</div>").fadeOut(9000);
                     
                   },1000);
                  
               });
       $('.editButton').on('click', function() {
           // Get the record's ID via attribute
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'index.php/administracion/consultarId/'; ?>" + id,
               method: 'GET'
   
           }).success(function(data) {
               var obj = JSON.parse(data);
               $('#userForm')
                       .find('[name="id"]').val(obj.id_usuario).end()
                       .find('[name="nombres"]').val(obj.nombres).end()
                       .find('[name="apellidos"]').val(obj.apellidos).end()
                       .find('[name="rol"]').val(obj.rol).end()
                       .find('[name="estatus"]').val(obj.estatus).end();
               bootbox
                       .dialog({
                           title: 'Editar el Estatus del Usuario',
                           message: $('#userForm'),
                           show: false // We will show it manually later
                       })
                       .on('shown.bs.modal', function() {
                           $('#userForm')
                           .show()                             // Show the login form
                           .formValidation('resetForm'); // Reset form
                       })
                       .on('hide.bs.modal', function(e) {
                       $('#userForm').hide().appendTo('body');
                       })
                       .modal('show');
           });
       });
   });
   
   $(document).ready(function () {
   
       $('#nueva thead th').each(function () {
           var title = $(this).text();
           $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
       }
       );
       // DataTable
       var table = $('#nueva').DataTable({
           "scrollY": "500px",
           "scrollCollapse": true,
           "paging": true,
           retrieve: true
       });
       //Apply the search
       table.columns().every(function () {
           var that = this;
           $('input', this.header()).on('keyup change', function () {
               if (that.search() !== this.value) {
                   that
                  .search(this.value)
                  .draw();
               }
           });
       });
   });
   
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   $(document).ready(function() {
       $('.filterable .btn-filter').click(function() {
           var $panel = $(this).parents('.filterable'),
                   $filters = $panel.find('.filters input'),
                   $tbody = $panel.find('.table tbody');
           if ($filters.prop('disabled') == true) {
               $filters.prop('disabled', false);
               $filters.first().focus();
           } else {
               $filters.val('').prop('disabled', true);
               $tbody.find('.no-result').remove();
               $tbody.find('tr').show();
           }
       });
       $('.filterable .filters input').keyup(function(e) {
           /* Ignore tab key */
           var code = e.keyCode || e.which;
           if (code == '9')
               return;
           /* Useful DOM data and selectors */
           var $input = $(this),
                   inputContent = $input.val().toLowerCase(),
                   $panel = $input.parents('.filterable'),
                   column = $panel.find('.filters th').index($input.parents('th')),
                   $table = $panel.find('.table'),
                   $rows = $table.find('tbody tr');
           /* Dirtiest filter function ever ;) */
           var $filteredRows = $rows.filter(function() {
               var value = $(this).find('td').eq(column).text().toLowerCase();
               return value.indexOf(inputContent) === -1;
           });
           /* Clean previous no-result if exist */
           $table.find('tbody .no-result').remove();
           /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
           $rows.show();
           $filteredRows.hide();
           /* Prepend no-result row if all rows are filtered */
           if ($filteredRows.length === $rows.length) {
               $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
           }
       });
   });
   
   
</script>