<meta name="theme-color" content="#F0DB4F">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="./img/ProgramadorFitness.png">
  <link rel="apple-touch-icon" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes/ProgramadorFitness.png">
  <link rel="apple-touch-startup-image" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes//ProgramadorFitness.png">
  <link rel="manifest" href="https://sac-jlacruz.c9users.io/manifest.json">
<style>

    .modal-header{
        background-color:#942349 !important;
    }
    .modal-title{
        color:#ffffff;
    }
    #mdialTamanio{
        width: 60% !important;
    }
</style>



<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<?php 

$num = number_format(67000, 2, ',', '.');
//echo $num;
?>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content2").fadeOut(1500);
    },3000);
});
$(document).ready(function() {
    setTimeout(function() {
        $(".formato_incorrecto").fadeOut(1500);
    },3000);
});
</script>


<section class="content" >
    <div class="box box-default collapsed-box">
        <div class="box-header with-border">
           <div class="content2"> 
          <?php
           $success = $this->session->flashdata('success');
             if ($success) {
              ?>
              <span id="registroCorrecto"><?php echo $success ?></span>
             <?php
             }
             ?>
            </div>
            <h3 class="box-title">Registrar Egreso</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    
                    <form id="formulario" action="<?php echo base_url() ?>egresos/registrar_egreso" method="POST" name="formulario" enctype="multipart/form-data">
                        <div class="col-sm-12"  id='resultado'></div>
                        <div class="col-sm-12"  id='resultado2'></div>
                        
                        <div class="form-group col-sm-6">
                            <label>Nro de Documento</label> &nbsp;
              
                        <input type="text" class="form-control" id="nro_documento" onkeypress="return soloNumeros(event)" name="nro_documento" placeholder="Nro de Documento" >
                        
                        </div>
                        
                         <div class="form-group col-sm-6">
                            <label>Proveedor</label> &nbsp;
                            <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor">
                                <button  type="button" title='Administrar Proveedor' class="btn btn-sample btn-xs" onclick="guardar2()"><i class="fa fa-plus"></i></button></a>
                            <select name="id_proveedor" id="id_proveedor"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($proveedores as $i => $proveedor) {
                         echo '<option value="' . $proveedor->id_proveedor . '">' . $proveedor->proveedor . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Monto</label> 
                            <a href="#" title="Ayuda!" data-toggle="popover" data-placement="top" data-content="Para registrar las cantidades utilice solo punto(.) para indicar las cifras decimales Ej: 123456.89">
                        <i class="fa fa-info-circle"></i>
                    </a>
                            <input type="text"  class="form-control" id="monto" onkeypress="return filterFloat(event,this);" name="monto" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Motivo</label> 
                     
                            <textarea class="form-control" rows="1" id="motivo"  name="motivo" placeholder="Motivo"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nro Cheque</label>
                            <a href="<?php echo base_url() ?>egresos/buscarDatosCheque">
                                <button  type="button" title='Administrar Cheque' onclick="guardar2()" class="btn btn-sample btn-xs"><i class="fa fa-plus"></i></button></a>
                            
                            <select name="id_cheque" id="id_cheque"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($cheques as $i => $cheque) {
                         echo '<option value="' . $cheque->id_cheque . '">' . $cheque->nro_cheque . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Cuenta</label> 
                            <select name="cuenta" id="cuenta"  class="form-control">
                                <option value="">Selecione...</option>
                                <option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
                                <option value="CUENTA AHORRO">CUENTA AHORRO</option>
                            </select>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-2">
                            <label>Per&iacute;odo</label> 
                            <select name="periodo" id="periodo"  class="form-control">
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
                        <div class="form-group col-sm-4">
                            <label>&nbsp;</label> 
                            <select name="anio" id="anio"  class="form-control">
                                <option value="">Selecione...</option>
                                <?php
                                for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                                    echo "<option value='$anio'>" . $anio . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Item</label> 
                            <a href="<?php echo base_url() ?>egresos/buscarDatosItem">
                                <button  type="button" onclick="guardar2()" title='Administrar Item' class="btn btn-sample btn-xs"><i class="fa fa-plus"></i></button></a>
                             <select name="id_item" id="id_item"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($items as $i => $item) {
                         echo '<option value="' . $item->id_item . '">' . $item->item . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Descripcion Item</label> 
                           <textarea class="form-control" rows="1" id="descripcion_item"  name="descripcion_item" placeholder="Descripcion Item"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea> 
                        </div>
                         <div class="form-group col-sm-6">
                        <span class="fa fa-folder-open"></span>
                        <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>
                        <input type='file' name='adjunto' id="adjunto" class="form-control" onchange="return fileValidation()">
                    </div>
                        <input type="text" class="form-control" id="id_comunidad"  name="id_comunidad" value="1">
                        
                        <div class="col-sm-12">&nbsp;</div>
                       <!-- <div class="col-sm-6">&nbsp;</div>
                        <div class="col-sm-6" id="imagePreview" align="center"></div>-->
                        <div class="col-sm-12" id='formato_incorrecto'>&nbsp;</div>
                        <div class="form-group col-sm-6">
                            <button  type="submit" class="btn btn-sample" id="" onclick="borrar()">
                                <span class='glyphicon glyphicon-saved'>&nbsp;Guardar</span>
                            </button>
                            
                             
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="content">
    <div class="container">
	<div class="row">
		<ul class="breadcrumb">
			<li class="active"><a href="<?php echo base_url() ?>egresos/buscarDatos"><i class="fa fa-file-text-o"></i> Administraci&oacute;n de Egresos</a></li>
			<li><a href="<?php echo base_url() ?>egresos/egresos_por_periodo"><i class="fa fa-dashboard"></i> Muestra Gasto Com&uacute;n</a></li>
			<li><a href="<?php echo base_url() ?>egresos/egresos_bitacora"><i class="fa fa-map-o"></i> Bit&aacute;cora</a></li>
		</ul>
	</div>
</div>
    <div class="box box-default">
         
        <div class="box-header with-border">
            Tabla de Egresos
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class='filterable'>
                        <div class='panel-heading'>
                            <div class='pull-right'>
                                <button class='btn btn-sample btn-sm btn-filter btn-sample' title='Realizar Consultas Cruzadas' ><span class='fa fa-filter'></span>Filtrar</button>
                            </div>
                        </div>
                         <table id="nueva" class="display " cellspacing="0" width="100%" >
                            
                        <thead align='center'>
                            <tr class="filters">
                            <th class="text-center" WIDTH="75">Nro</th> 
                            <th class="text-center" WIDTH="290">Fecha Registro</th>   
                            <th class="text-center" WIDTH="200">Proveedor</th>
                            <th class="text-center" WIDTH="250">Comunidad</th>
                            <th class="text-center" WIDTH="255">Monto</th>
                            <th class="text-center" WIDTH="125">Per&iacute;odo</th>
                            <th class="text-center" WIDTH="85">Estatus</th>
                            <th class="text-center" WIDTH="155">Item</th>
                            <th class="text-center" WIDTH="155">Usuario</th>
                            <th class="text-center" WIDTH="410">Acciones</th>
                           </tr>
                        </thead>
                        
                        
                            <?php
                            
                             $variablesSesion = $this->session->userdata('usuario');
                             $rol = ($variablesSesion['rol']);
                                
                            
                            if ($resultados != "") {
                                
                            $contenido = "";
                            foreach ($resultados as $resultado) {
                                
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                                
                                $x=$resultado->estatus1;
                                if($x==1){
                                     $contenido.="<tr>      
                               <td align='center'>" . "$resultado->id_egreso" . "</td>
                               <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                               <td align='center'>" .  "$resultado->proveedor" . "</td>
                               <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                               <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                               <td align='center'>" .  "$resultado->estatus" . "</td>
                               <td align='center'>" .  "$resultado->item" . "</td>
                               <td align='center'>" .  "$resultado->nombres" ." ". "$resultado->apellidos" . "</td>
                               <td align='center'><button type='button' title='Editar Egreso' data-id='$resultado->id_egreso' class='btn btn-sample btn-xs  editButton'><span class='fa fa-edit'></span></button>
                              <a href='" . base_url() . "Egresos/imprimirPDF?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                              <button type='button' class='btn btn-sample btn-xs' title='Descargar Egreso'><span class='glyphicon glyphicon-print'></span></button>
                               <a href='" . base_url() . "Egresos/verAdjunto/" . "$resultado->id_egreso" . "'>
                              <button type='button' class='btn btn-sample btn-xs' title='Ver Adjunto'><span class='glyphicon glyphicon-search'></span></button>
                              </td> 
                              </tr>";
                                }else{
                                    $contenido.="<tr>      
                               <td align='center'>" . "$resultado->id_egreso" . "</td>
                               <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                               <td align='center'>" .  "$resultado->proveedor" . "</td>
                               <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                               <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                               <td align='center'>" .  "$resultado->estatus" . "</td>
                               <td align='center'>" .  "$resultado->item" . "</td>
                               <td align='center'>" .  "$resultado->nombres" ." ". "$resultado->apellidos" . "</td>
                               <td align='center'><button type='button' title='Editar Egreso' data-id='$resultado->id_egreso' class='btn btn-sample btn-xs  editButton'><span class='fa fa-edit'></span></button>
                              <a href='" . base_url() . "Egresos/imprimirPDF?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                              <button type='button' class='btn btn-sample btn-xs' title='Descargar Egreso'><span class='glyphicon glyphicon-print'></span></button>
                               <a href='" . base_url() . "Egresos/verAdjunto?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                              <button type='button' class='btn btn-sample btn-xs' title='Ver Adjunto'><span class='glyphicon glyphicon-search'></span></button>
                              </td> 
                              </tr>";
                                }

                               }
                               
                              } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                                  
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                  
                            </tbody>
                        </table>
                        
                        
                         <button type="button" class="btn btn-sample">Total General de Egresos <span class="badge"><?php
                         foreach($suma as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></span></button> 
                    </div>
                    
                
                    
                     <!--======================== ventana modal para editar egresos  =====================-->
                    
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"  id='resultado'></div>
                        <div class="col-sm-12"  id='resultado2'></div>
                        <div class="col-sm-12">
                            <label>Comunidad</label>
                             <select name="id_comunidad" id="id_comunidad"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($comunidades as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                         <div class="col-sm-12">
                            <label>Proveedor</label>
                            <select name="id_proveedor" id="id_proveedor"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($proveedores as $i => $proveedor) {
                         echo '<option value="' . $proveedor->id_proveedor . '">' . $proveedor->proveedor . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        <div class="col-sm-12">
                            <label>Motivo</label> 
                            <textarea class="form-control" rows="1" id="motivo"  name="motivo" placeholder="Motivo"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="col-sm-6">
                            <label>Monto</label> 
                            <input type="text"  class="form-control" id="monto" onkeypress="return filterFloat(event,this);" name="monto" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                             
                            
                        </div>
                        <div class="col-sm-6">
                            <label>Nro Cheque</label>
                           <select name="id_cheque" id="id_cheque"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($cheques2 as $i => $cheque2) {
                         echo '<option value="' . $cheque2->id_cheque . '">' . $cheque2->nro_cheque . '</option>';
                           }
                           ?>                     
                      </select>
                      
                        </div>
                        <div class="col-sm-12"></div>
                        <div class=" col-sm-4">
                            <label>Cuenta</label> 
                            <select name="cuenta" id="cuenta"  class="form-control">
                                <option value="">Selecione...</option>
                                <option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
                                <option value="CUENTA AHORRO">CUENTA AHORRO</option>                             
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Per&iacute;odo</label> 
                            <select name="periodo" id="periodo"  class="form-control">
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
                        
                        <div class="col-sm-4">
                            <label>&nbsp;</label> 
                            <select name="anio" id="anio"  class="form-control">
                                <option value="">Selecione...</option>
                                <?php
                                for ($anio = (date("Y")); 2015 <= $anio; $anio--) {
                                    echo "<option value='$anio'>" . $anio . "</option>";
                                }
                                ?>

                            </select>
                        </div>
                        
                        <div class="col-sm-12">
                            <label>Item</label>
                            <select name="id_item" id="id_item"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($items as $i => $item) {
                         echo '<option value="' . $item->id_item . '">' . $item->item . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        
                         <div class="col-sm-12">
                            <label>Descripcion Item</label> 
                            <textarea class="form-control" rows="1" id="descripcion_item"  name="descripcion_item" placeholder="Motivo"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>
                        </div>
                       
                        
                        
                        <div class="col-sm-12">
                            <label>Estatus</label>
                            <select name="estatus" id="estatus"  class="form-control" title="Advertencia...!!!" 
                            data-toggle="popover" data-trigger="hover" data-content="Si cierra el egreso ya no sera editable para el resto de los usuarios" 
                            data-placement="top">
                                <option value="">Selecione...</option>
                                <option value="1">ACTIVO</option>
                                <option value="2">CERRADO</option>
                            </select>
                        </div>

                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden"  class="form-control" id="id"  name="id" >
                        <div class="form-group">
                            <div class="col-xs-12">&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-sample"> <span class='fa fa-pencil'>&nbsp;Modificar</span></button>
                                
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>



<script>
function fileValidation(){
    var fileInput = document.getElementById('adjunto');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        
        $("#formato_incorrecto").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Formato de Imagen Incorrecto (Seleccione un archivo jpg,jpeg,png,gif)....!!!.</div>");
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
    function guardar2(){
        var id_comunidad = document.getElementById('id_comunidad').value;
        var id_proveedor = document.getElementById('id_proveedor').value;
        var monto = document.getElementById('monto').value;
        var motivo = document.getElementById('motivo').value;
        var id_cheque = document.getElementById('id_cheque').value;
        var cuenta = document.getElementById('cuenta').value;
        var periodo = document.getElementById('periodo').value;
        var anio = document.getElementById('anio').value;
         
        localStorage.setItem('id_comunidad',id_comunidad);
        localStorage.setItem('id_proveedor',id_proveedor);
        localStorage.setItem('monto',monto);
        localStorage.setItem('motivo',motivo);
        localStorage.setItem('id_cheque',id_cheque);
        localStorage.setItem('cuenta',cuenta);
        localStorage.setItem('periodo',periodo);
        localStorage.setItem('anio',anio);
    }

   $(document).ready( function() 
   {
      var id_comunidad = localStorage.getItem('id_comunidad');
      var id_proveedor = localStorage.getItem('id_proveedor');
      var monto = localStorage.getItem('monto');
      var motivo = localStorage.getItem('motivo');
      var id_cheque = localStorage.getItem('id_cheque');
      var cuenta = localStorage.getItem('cuenta');
      var periodo = localStorage.getItem('periodo');
      var anio = localStorage.getItem('anio');
      
      document.getElementById('id_comunidad').value=id_comunidad;
      document.getElementById('id_proveedor').value=id_proveedor;
      document.getElementById('monto').value=monto;
      document.getElementById('motivo').value=motivo;
      document.getElementById('id_cheque').value=id_cheque;
      document.getElementById('cuenta').value=cuenta;
      document.getElementById('periodo').value=periodo;
      document.getElementById('anio').value=anio;
   } );

    function borrar(){
   if (localStorage)  {
      localStorage.removeItem("id_comunidad");
      localStorage.removeItem("id_proveedor");
      localStorage.removeItem("monto");
      localStorage.removeItem("motivo");
      localStorage.removeItem("id_cheque");
      localStorage.removeItem("cuenta");
      localStorage.removeItem("periodo");
      localStorage.removeItem("anio");
      }
        
    }
    </script>






<script>
function objetoAjax(){
    var xmlhttp=false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
//==========================================================
function enviar_personas(){
    divResultado = document.getElementById('proveedores');
    proveedor = document.getElementById('proveedor').value;
 
    ajax=objetoAjax();
    ajax.open("POST", "<?php echo base_url() . 'Egresos/registrar_proveedor'; ?>");
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("proveedor="+proveedor)
      
}
</script>







<script type="text/javascript" src="jquery.js"></script>
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
   function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

//number_format(67000, 2, ',', '.');devuelve 67.000,00000
</script>





<script type="text/javascript">
    $(document).ready(function () {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                     excluded: ':disabled',
                    fields: {
                        id_proveedor: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           nro_documento: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                        monto: {
                            row: '.col-sm-6',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           id_cheque: {
                            row: '.col-sm-6',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                        motivo: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           cuenta: {
                            row: '.col-sm-4',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           periodo: {
                            row: '.col-sm-4',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           anio: {
                            row: '.col-sm-4',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           id_item: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           estatus: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                        rol: {
                        }
                    }
                })
                .on('success.form.fv', function (e) {
                    // Save the form data via an Ajax request
                    e.preventDefault();
                    var $form = $(e.target),
                            id = $form.find('[name="id"]').val();
                    // The url and method might be different in your application

                    $.ajax({
                        url: "<?php echo base_url() . 'egresos/actualizar_egreso'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function (response) {

                        $form.parents('.bootbox').modal('hide');
                        $.confirm({
                            title: 'Suceso!',
                            content: 'Egreso Actualizado',
                            type: 'grey',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Cerrar',
                                    btnClass: 'btn-sample',
                                    action: function () {
                                        location.reload();
                                    }
                                }
                            }
                        });

                    });
                });
        $('.editButton').on('click', function () {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'egresos/consultarId/'; ?>" + id,
                method: 'GET'

            }).success(function (data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_egreso).end()
                        .find('[name="id_proveedor"]').val(obj.id_proveedor).end()
                        .find('[name="id_comunidad"]').val(obj.id_comunidad).end()
                        .find('[name="monto"]').val(obj.monto).end()
                        .find('[name="motivo"]').val(obj.motivo).end()
                        .find('[name="id_cheque"]').val(obj.id_cheque).end()
                        .find('[name="cuenta"]').val(obj.cuenta).end()
                        .find('[name="periodo"]').val(obj.periodo).end()
                        .find('[name="anio"]').val(obj.anio).end()
                        .find('[name="estatus"]').val(obj.estatus).end()
                        .find('[name="descripcion_item"]').val(obj.descripcion_item).end()
                        .find('[name="id_item"]').val(obj.id_item).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar Egreso',
                            message: $('#userForm'),
                            show: false // We will show it manually later
                        })
                        .on('shown.bs.modal', function () {
                            $('#userForm')
                                    .show()                             // Show the login form
                                    .formValidation('resetForm'); // Reset form
                        })
                        .on('hide.bs.modal', function (e) {
                            // Bootbox will remove the modal (including the body which contains the login form)
                            // after hiding the modal
                            // Therefor, we need to backup the form
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
    //------------------------------------------------- Solo Letra-------------------------------------------------//

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " qwertyuiop�lkjhgfdsazxcvbnm";
        especiales = "8-37-39-46";
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $(document).ready(function () {
        $('.filterable .btn-filter').click(function () {
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
        $('.filterable .filters input').keyup(function (e) {
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
            var $filteredRows = $rows.filter(function () {
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





<script type="text/javascript">
    $(document).ready(function () {
        $('#userForm2')
                .formValidation({
                    framework: 'bootstrap',
                     excluded: ':disabled',
                    fields: {
                        id_item2: {
                            row: '.col-sm-6',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
 
                           id_descripcion_item2: {
                            row: '.col-sm-6',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
    
                        rol: {
                        }
                    }
                })
                .on('success.form.fv', function (e) {
                    // Save the form data via an Ajax request
                    e.preventDefault();
                    var $form = $(e.target),
                            id = $form.find('[name="id"]').val();
                    // The url and method might be different in your application

                    $.ajax({
                        url: "<?php echo base_url() . 'egresos/actualizar_egreso2'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function (response) {

                        $form.parents('.bootbox').modal('hide');
                        $.confirm({
                            title: 'Suceso!',
                            content: 'Egreso Actualizado',
                            type: 'grey',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Cerrar',
                                    btnClass: 'btn-green',
                                    action: function () {
                                        location.reload();
                                    }
                                }
                            }
                        });

                    });
                });
        $('.editButton2').on('click', function () {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'egresos/consultarId2/'; ?>" + id,
                method: 'GET'

            }).success(function (data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm2')
                        .find('[name="id"]').val(obj.id_egreso).end()
                        .find('[name="id_item"]').val(obj.id_item).end()
                        .find('[name="item"]').val(obj.item).end()
                        .find('[name="id_descripcion_item"]').val(obj.id_descripcion_item).end()
                        .find('[name="descripcion_item"]').val(obj.descripcion_item).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Informacion Actual del Item',
                            message: $('#userForm2'),
                            show: false // We will show it manually later
                        })
                        .on('shown.bs.modal', function () {
                            $('#userForm2')
                                    .show()                             // Show the login form
                                    .formValidation('resetForm2'); // Reset form
                        })
                        .on('hide.bs.modal', function (e) {
                            $('#userForm2').hide().appendTo('body');
                        })
                        .modal('show');
            });
        });
    });
</script>






















<!--========== script para permitir solo numeros y dos decimales con punto ==========-->
<script type="text/javascript">
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; //===== {0,2} Numero de decimales permitidos =====///
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}

</script>



<!--============= script para registar usuarios ============================================== -->
<script>
    $(document).ready(function () {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                cedula: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        stringLength: {
                            min: 6,
                            max: 8,
                            message: 'M&iacute;nimo 6 m&aacute;ximo 8 d&iacute;gitos'
                        }

                    }
                },
                  nro_documento: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                id_proveedor: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                monto: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                
                motivo: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                id_cheque: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                cuenta: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                periodo: {
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                anio: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                id_item: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                  descripcion_item: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                adjunto: {
                    row: '.col-sm-6',
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
        $("#guardar").click(function() {
            var dataEgreso = {
                "id_comunidad": $("#id_comunidad").val(),
                "id_proveedor": $("#id_proveedor").val(),
                "monto": $("#monto").val(),
                "motivo": $("#motivo").val(),
                "id_cheque": $("#id_cheque").val(),
                "cuenta": $("#cuenta").val(),
                "periodo": $("#periodo").val(),
                "anio": $("#anio").val(),
                "id_item": $("#id_item").val(),
                "descripcion_item": $("#descripcion_item").val(),
                "adjunto": $("#adjunto").val(),
                "nro_documento": $("#nro_documento").val()
                
            };

            //validamos que no quede ningun campo vacio
            if (dataEgreso.id_comunidad === '' ||dataEgreso.id_proveedor === '' || dataEgreso.monto === '' || dataEgreso.motivo === '' || dataEgreso.nro_cheque === '' ||
                dataEgreso.cuenta === '' || dataEgreso.periodo === '' || dataEgreso.anio === ''|| dataEgreso.id_item === ''|| dataEgreso.id_descripcion_item === ''
                || dataEgreso.adjunto === ''|| dataEgreso.nro_documento === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $.ajax({
                    url: "<?php echo base_url() . 'Egresos/registrar_egreso'; ?>",
                    type: "POST",
                    data: dataEgreso,
                    beforeSend: function() {
                        $("#resultado").show();
                        $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    //Despues de enviar los datos limpiamos los campos del formulario
                    success: function(respuesta) {
                        // Enviamos un mensaje de exito al insertar los datos
                        $("#id_comunidad").val(''),
                        $("#id_proveedor").val(''),
                        $("#monto").val(''),
                        $("#motivo").val(''),
                        $("#id_cheque").val(''),
                        $("#cuenta").val(''),
                        $("#periodo").val(''),
                        $("#anio").val(''),
                        $("#id_item").val(''),
                        $("#id_descripcion_item").val(''),
                        $("#adjunto").val(''),
                        $("#nro_documento").val(''),
                        $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                        //Redirijimos luego de enviar los datos 
                        setInterval(function() {
                            location.reload();
                        }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                    }
                });
            }
        });
    });
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>








 <script>
//=================== Script para obtener descripcion del item ==================//
    $(document).on("change", '#id_item', function ()
    {
        $("#id_descripcion_item").load("<?php echo base_url() . 'Egresos/buscarDescripcion_Item?id_item='; ?>" + $(this).val());
    });

    </script> 
    
    
    <script>
//=================== Script para obtener descripcion del item ==================//
    $(document).on("change", '#id_item2', function ()
    {
        $("#id_descripcion_item2").load("<?php echo base_url() . 'Egresos/buscarDescripcion_Item?id_item='; ?>" + $(this).val());
    });

    </script> 




<style type="text/css">
    .breadcrumb {
    padding: 0px;
	background: #D4D4D4;
	list-style: none; 
	overflow: hidden;
    margin-top: 20px;
}
.breadcrumb>li+li:before {
	padding: 0;
}
.breadcrumb li { 
	float: left; 
}
.breadcrumb li.active a {
	background: brown;                   /* fallback color */
	background: #92234d ; /*linck activo*/
}
.breadcrumb li.completed a {
	background: brown;                   /* fallback color */
	background: hsla(153, 57%, 51%, 1); 
}
.breadcrumb li.active a:after {
	border-left: 30px solid #92234d ;
}
.breadcrumb li.completed a:after {
	border-left: 30px solid hsla(153, 57%, 51%, 1);
} 

.breadcrumb li a {
	color: white;
	text-decoration: none; 
	padding: 10px 0 10px 45px;
	position: relative; 
	display: block;
	float: left;
}
.breadcrumb li a:after { 
	content: " "; 
	display: block; 
	width: 0; 
	height: 0;
	border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
	border-bottom: 50px solid transparent;
	border-left: 30px solid hsla(0, 0%, 83%, 1);
	position: absolute;
	top: 50%;
	margin-top: -50px; 
	left: 100%;
	z-index: 2; 
}	
.breadcrumb li a:before { 
	content: " "; 
	display: block; 
	width: 0; 
	height: 0;
	border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
	border-bottom: 50px solid transparent;
	border-left: 30px solid white;
	position: absolute;
	top: 50%;
	margin-top: -50px; 
	margin-left: 1px;
	left: 100%;
	z-index: 1; 
}	
.breadcrumb li:first-child a {
	padding-left: 15px;
}
.breadcrumb li a:hover { background: #a24754  ; }
.breadcrumb li a:hover:after { border-left-color: #a24754   !important; }
</style>

    