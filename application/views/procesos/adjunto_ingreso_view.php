<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<body onload="nobackbutton();">
   <section class="content" id="section" style="width: 95%; align-content: center">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Documento Adjunto</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-3">&nbsp;</div>
               <div class="col-md-8">
                  <span tooltip="Regresar">
                  <a href="<?php echo base_url() ?>Ingresos/ingresos" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
                  </span>
                  <span tooltip="Actualizar">
                  <button type="button" class="btn bg-orange btn-circle" id="show"><span class='glyphicon glyphicon-refresh'></span></button>
                  </span>
               </div>
               <div class="col-md-1">&nbsp;</div>
               <div class="col-md-3">&nbsp;</div>
               <form id="formulario" action="<?php echo base_url() ?>index.php/Ingresos/actualizar_adjunto" method="POST" name="formulario" enctype="multipart/form-data">
                  <div class="col-md-8" id="element" style="display: none;">
                     <div id="close"><a href="#" id="hide"><font color="red">Cerrar</font></a></div>
                     <div class="form-group col-sm-8">
                        <span class="fa fa-folder-open"></span>
                        <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>
                        <input type='file' name='adjunto' id="adjunto" class="form-control" onchange="return fileValidation()">
                        <input type='hidden' name='id_ingreso' id="id_ingreso" class="form-control" value="<?php echo $id_egre?>">
                     </div>
                     <div class="col-md-3">&nbsp;</div>
                     <div class="col-md-5">
                        <span tooltip="Actualizar">
                        <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><span class='glyphicon glyphicon-pencil'></span></button>
                        </span>
                     </div>
                     <div class="col-md-1">&nbsp;</div>
                     <div class="col-md-12">&nbsp;</div>
                     <div class="col-sm-8" id='formato_incorrecto'>&nbsp;</div>
                  </div>
               </form>
               <div class="col-md-1">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-3">&nbsp;</div>
               <div class="col-md-8"><?php echo $datos?></div>
               <div class="col-md-1">&nbsp;</div>
               <!--<div class="col-md-12" align="center"><?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/LogoCesppa.png">'; ?></div> -->
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
            </div>
         </div>
      </div>
   </section>
</body>
<script>
   function mensaje(){
   	 alertify.log("Adjunto Actualizado...!!"); 
   }
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
           $(".formato_incorrecto").fadeOut(1500);
       },3000);
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
     $("#hide").click(function(){
       $("#element").hide();
     });
     $("#show").click(function(){
       $("#element").show();
     });
   });
</script>
<script>
   function fileValidation(){
       var fileInput = document.getElementById('adjunto');
       var filePath = fileInput.value;
       var allowedExtensions = /(.jpg|.jpeg|.png|.gif|.gif)$/i;
       if(!allowedExtensions.exec(filePath)){
           
           alertify.error("Formato Incorrecto  (Seleccione un archivo jpg,jpeg,png,gif)...!!");
           fileInput.value = '';
           return false;
       }else{
           //Image preview
           if (fileInput.files && fileInput.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                   document.getElementById('imagePreview').innerHTML = '<img width="100" height="100" src="'+e.target.result+'"/>';
               };
               reader.readAsDataURL(fileInput.files[0]);
           }
       }
   }
</script>
<script>
   $(document).ready(function () {
       $('#formulario').formValidation({
           framework: 'bootstrap',
           excluded: ':disabled',
           fields: {
               adjunto: {
                   row: '.col-sm-8',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
           }
       });
   });
</script>
<script>
   $(document).ready(function() {
       var id = document.getElementById("id_egreso").value;
       var dataString = 'id_egreso=' + id;
   
       $.ajax({
           type: "GET",
           url: "<?php echo base_url() . 'index.php/Egresos/idEgreso'; ?>",
           dataType: 'html',
           data: dataString,
           beforeSend: function() {
               $("#resultado").show();
               $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif"> Procesando Peticion....'; ?></div>');
           },
           success: function(response) {
                $("#resultado").fadeOut();
               $("#resultado_id_egreso").html(response);
           }
   
       });
   });
   
</script>