<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="description" content="Software para gestion de casas de cambio">
<meta name="theme-color" content="#253B51">
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" type="image/png" href="https://idsistemas15.com/base2/logo5.png">
<link rel="apple-touch-icon" href="https://idsistemas15.com/base2/logo5.png">
<link rel="apple-touch-startup-image" href="https://idsistemas15.com/base2/logo5.png">
<?php
$variablesSesion = $this->session->userdata('usuario');
$rol = $variablesSesion['rol'];

if ($variablesSesion == "") {
   redirect('principal/session');
}
?>
<style>
    .gly-spin {
        -webkit-animation: spin 2s infinite linear;
        -moz-animation: spin 2s infinite linear;
        -o-animation: spin 2s infinite linear;
        animation: spin 2s infinite linear;
    }

    @-moz-keyframes spin {
        0% {
            -moz-transform: rotate(0deg);
        }

        100% {
            -moz-transform: rotate(359deg);
        }
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(359deg);
        }
    }

    @-o-keyframes spin {
        0% {
            -o-transform: rotate(0deg);
        }

        100% {
            -o-transform: rotate(359deg);
        }
    }

    @keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }

    .gly-rotate-90 {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .gly-rotate-180 {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .gly-rotate-270 {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .gly-flip-horizontal {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);
        -webkit-transform: scale(-1, 1);
        -moz-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        transform: scale(-1, 1);
    }

    .gly-flip-vertical {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1);
        -webkit-transform: scale(1, -1);
        -moz-transform: scale(1, -1);
        -ms-transform: scale(1, -1);
        -o-transform: scale(1, -1);
        transform: scale(1, -1);
    }

    #footer {
        /*background-color: black;*/
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 40px;
        color: white;
        text-align: right;
        vertical-align: middle;
    }

    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo base_url(); ?>application/recursos/imagenes/loading.gif') 50% 50% no-repeat rgb(0, 0, 0, .5);
        /*background: rgba(0, 0, 0, .5);*/
        opacity: .8;
    }
    #footer_menu {
   position:fixed;
   left:0px;
   bottom:10px;
   height:30px;
   width:100%;
   background:#999;
}

    #sticky {
        width: 100%;
        height: 34px;
        padding-top: 10px;
        background: #253B51;
        color: white;
        font-weight: bold;
        font-size: 12px;
        text-align: center;
        position: fixed;
        /*Here's what sticks it*/
        bottom: 0;
        /*to the bottom of the window*/
        left: 0;
        /*and to the left of the window.*/

    }
</style>
<div class="loader"></div>



<div id="cambiar_usuario">
    <div class="container" style="width: 95%;">
        <div class="row">
            <br>
            <div class="col-sm-3" align="center">&nbsp;</div>
            <div class="col-sm-6">
                <br class="clearfix visible-lg">
                <div class="panel-heading" align="center">
                <button type="button" style='box-shadow: 2px 2px 5px #666;' class="btn bg-navy btn-xs">
                <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Solicitudes</i></a>
            </button>&nbsp;
                    <strong><span class="label label-default" style='box-shadow: 2px 2px 5px #666;'> Datos del Usuario</span></strong>
                </div>
                <div class="panel-body">
                    <form action='' name="formulario" id="formulario" method="POST" class="form-horizontal">
                        <input type="hidden" class="form-control " readonly id="id_usuario" name="id_usuario"
                            value="{id_usuario}">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Nombres:</label>
                            <div class="col-sm-10">
                                <input type="text" v-model="nombres" class="form-control text-uppercase" id="nombres"
                                    onKeyPress="return soloLetras(event)" name="nombres" placeholder="Nombres"
                                    maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Apellidos:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-uppercase" id="apellidos"
                                    onKeyPress="return soloLetras(event)" name="apellidos" placeholder="Apellidos"
                                    maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Rut/Pasaporte:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-uppercase" id="rut_pasaporte"
                                    onKeyPress="return soloLetras(event)" name="rut_pasaporte" placeholder="RUT/PASAPORTE"
                                    maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Usuario:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="usuario" name="usuario"
                                    onkeyup="javascript:this.value = this.value.toUpperCase()"
                                    placeholder="Nombre de Usuario" maxlength="10" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Fono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-uppercase" id="telefono"
                                    onKeyPress="return soloNumeros(event)" name="telefono" placeholder="Fono"
                                    maxlength="12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    onkeyup="javascript:this.value = this.value.toUpperCase()" id="correo" name="correo"
                                    placeholder="Correo El&eacute;ctronico" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">&nbsp;</label>
                            <div class="col-sm-10">

                                <button type="button" class="btn bg-navy btn-block" id="modificar"
                                    style="box-shadow: 2px 2px 10px #666; display:block;"><i class="fa fa-check"></i>
                                    Actualizar Datos</button>
                                <button class="btn btn-primary btn-block" id="modificar_loader"
                                    style="box-shadow: 2px 2px 10px #666; display:none;">
                                    <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                <button type="button" class="btn bg-primary btn-block"
                                    style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(2)"><i
                                        class="fa fa-refresh"></i> Cambiar clave</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cambiar_clave" style="display:none;">
<div class="container" style="width: 95%;">
        <div class="row">
            <br class="clearfix visible-lg">
            <div class="col-sm-3 ">&nbsp;</div>
            <div class="col-sm-6">
                <br>
                <div class="panel-heading" align="center">
                <button type="button" style='box-shadow: 2px 2px 5px #666;' class="btn bg-navy btn-xs">
                <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Solicitudes</i></a>
            </button>
                    <strong><span class="label label-default" style='box-shadow: 2px 2px 5px #666;'> Cambiar Calve</span></strong>
                </div>
              
                    <form action='' name="formulario2" id="formulario2" method="POST" class="form-horizontal">
                        <input type="hidden" class="form-control " readonly id="id_usuario" name="id_usuario"
                            value="{id_usuario}">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Clave:</label>
                            <div class="col-sm-10">
                            <input class="form-control redondeado" id="confirmar_clave" name="confirmar_clave"
                                type="password" placeholder="Clave">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Confirmar&nbsp;Clave:</label>
                            <div class="col-sm-10">
                            <input class="form-control redondeado" id="clave" name="clave" type="password"
                                placeholder="Confirmar Clave">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">&nbsp;</label>
                            <div class="col-sm-10">

                                <button type="button" class="btn bg-navy btn-block" id="actualizar"
                                    style="box-shadow: 2px 2px 10px #666; display:block;"><i class="fa fa-check"></i>
                                    Actualizar Clave</button>

                                <button class="btn btn-primary btn-block" id="modificar_loader"
                                    style="box-shadow: 2px 2px 10px #666; display:none;">
                                    <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                <button type="button" class="btn bg-primary btn-block"
                                    style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(1)"><i
                                        class="fa fa-arrow-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
               
            </div>
        </div>
    </div>
</div>
<br><br>
<?php if ($variablesSesion['rol'] == 1) { ?>
    <div class="btn-group btn-group-justified btn-group-xs visible-xs" id="footer_menu" style="text-align: right; border-radius:0px;">
    <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-file-text-o"></i><br>Solicitudes</a>
        <a href="<?php echo BASE_URL() ?>principal/dashboard" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-gears"></i><br>Configuracion</a>
        <a href="<?php echo BASE_URL() ?>transferencias/historico" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-file-text"></i><br>Hist&oacute;rico</a>
        <a href="<?php echo BASE_URL() ?>administracion/usuarioModificar" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-user"></i><br>Mi Usuario</a>
    </div>
    <?php } ?>



    <footer id="sticky" class="clearfix visible-lg">
        <div align="center">Copyright@idsistemas15.com</p>
    </footer>

<script src="<?php echo base_url(); ?>application/scripts/usuarios.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
        "Septiembre", "Octubre", "Noviembre", "Diciembre");
    var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    var f = new Date();
    $("#resultado").html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f
        .getFullYear());
});

</script>

<script>
function myFunction(idButton) {
      var cambiar_usuario = document.getElementById('cambiar_usuario');
      var cambiar_clave = document.getElementById('cambiar_clave');
      

      switch(idButton) {
       case 1:
       cambiar_usuario.style.display = 'block';
       cambiar_clave.style.display = 'none';
       break;

       case 2:
       cambiar_usuario.style.display = 'none';
       cambiar_clave.style.display = 'block';
       break;
       default:
       alert("hay un problema: No existe la ruta.")
   }

}
</script>