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
        position: fixed;
        left: 0px;
        bottom: 10px;
        height: 30px;
        width: 100%;
        background: #999;
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


<script src="<?php echo base_url(); ?>application/scripts/ruta_usuarios.js"></script>

<script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        var f = new Date();
        $("#resultado").html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
    });
</script>

<!--=============================================================================================================== -->
<!--===============================================Tabla de Usuarios================================================ -->
<!--=============================================================================================================== -->

<body onload="nobackbutton();">
    <div class="loader"></div>
    <div id="usuarios" class="container">
        <div class="row">
            <p>&nbsp;</p>
            <div class="col-md-2 clearfix visible-lg"><button type="button" class="btn btn-default" style="box-shadow: 2px 2px 5px #666;">
                    <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Regresar</i></a>
                </button></div>
            <div class="col-md-6">
                <p><strong><span class="label label-default">Usuarios Registrados</span></strong>
                    <span class="label label-success" id="total_usuarios">Total Usuarios</span></p>
                <div id="tabla_usuarios"></div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default" style="box-shadow: 2px 2px 5px #666;">
                    <div class="panel-heading">Detalles del usuario</div>
                    <div class="panel-body">
                        <table>
                            <tr>
                                <td align="right"><strong>Nombres:&nbsp;<strong></td>
                                <td>
                                    <p id="nombres_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Apellidos:&nbsp;<strong></td>
                                <td>
                                    <p id="apellidos_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Usuario:&nbsp;<strong></td>
                                <td>
                                    <p id="usuario_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Correo:&nbsp;<strong></td>
                                <td>
                                    <p id="correo_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Tel&eacute;fono:&nbsp;<strong></td>
                                <td>
                                    <p id="telefono_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Tipo usuario:&nbsp;<strong></td>
                                <td>
                                    <p id="rol_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Estatus:&nbsp;<strong></td>
                                <td>
                                    <p id="estatus_modal"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Fecha de Alta:&nbsp;<strong></td>
                                <td>
                                    <p id="fecha_registro_modal"></p>
                                </td>
                            </tr>
                            <table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br><br>
    <?php if ($variablesSesion['rol'] == 1) { ?>
    <div class="btn-group btn-group-justified btn-group-xs visible-xs" id="footer_menu" style="text-align: right; border-radius:0px;">
    <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-file-text-o"></i><br>Solicitudes</a>
        <a href="<?php echo BASE_URL() ?>principal/dashboard" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-gears"></i><br>Configuracion</a>
        <a href="<?php echo BASE_URL() ?>transferencias/historico" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-file-text"></i><br>Hist&oacute;rico</a>
        <a href="<?php echo BASE_URL() ?>administracion/usuarioModificar" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-user"></i><br>Mi Usuario</a>
    </div>
    <?php } ?>



    <footer id="sticky" class="clearfix visible-lg">
        <p>idsistemas15.com &nbsp;<i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727</p>
    </footer>

</body>


<!--=============================================================================================================== -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    // carga de lista de usuarios
    function leerUsuarios() {
        $.get("<?php echo base_url() . 'index.php/Administracion/tabla'; ?>", {}, function(data, status) {
            $("#tabla_usuarios").html(data);
        });
    }
    $(document).ready(function() {
        leerUsuarios();
    });

    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#total_usuarios").load("<?php echo base_url() ?>index.php/administracion/contar_usuarios")
                .error(function() {
                    alert("Error");
                });
        }, 1000);
        $.ajaxSetup({
            cache: false
        });
    });

    //========== Validacion de tipo de campo solo letras o numeros =====================================
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " qwertyuiop\F1lkjhgfdsazxcvbnm";
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

    function soloNumeros(e) {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8));
    }

    //===== Validacion de campos del formulario de edicion de usuario  ======================
    $(document).ready(function() {
        $('#userForm').formValidation({
            fields: {
                correo_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Direcci&oacute;n de Correo Inv&aacute;lida'
                        }
                    }
                },
                usuario_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                rol_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                estatus_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "<?php echo base_url() . 'index.php/administracion/actualizar_usuario'; ?>",
                method: 'POST',
                data: $form.serialize()
            }).success(function(response) {
                $('#resultado_msj').html(
                    '<div class="loading"><img src="<?php echo base_url(); ?>application/recursos/imagenes/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>'
                );
                $('#userForm').formValidation('resetForm');
                $('#userForm')[0].reset();
                myFunction(1) // ==== funcion de enruutamiento
                reload_table();
            });
        });
    });

    function nobackbutton() {

        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button" //chrome
        window.onhashchange = function() {
            window.location.hash = "";
        }

    }
</script>