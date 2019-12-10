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

    #footer_menu {
        position: fixed;
        left: 0px;
        bottom: 10px;
        height: 30px;
        width: 100%;
        background: #999;
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

    #scroll {
        overflow: scroll;
        height: 290px;
        width: auto;
    }

    #scroll2 {
        overflow: scroll;
        height: 130px;
    }

    .ds-btn li {
        list-style: none;
        float: left;
        padding: 10px;
    }

    .ds-btn li a span {
        padding-left: 15px;
        padding-right: 5px;
        width: 100%;
        display: inline-block;
        text-align: left;
    }

    .ds-btn li a span small {
        width: 100%;
        display: inline-block;
        text-align: left;
    }

    p:hover {
        color: #5e7b99;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />


<body onload="nobackbutton();">
    <div class="loader"></div>
    <div class="container" id="caja">
        <div class="col-md-3">
            <button type="button" class="btn btn-default clearfix visible-lg" style="box-shadow: 2px 2px 5px #666;">
                <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Regresar</i></a>
            </button><br class="clearfix visible-lg">
            <p class="clearfix visible-lg">&nbsp;</p>
            <p class="clearfix visible-lg">&nbsp;</p>
            <p><span class="label label-default" style="box-shadow: 2px 2px 10px #666;"><strong>Registrar/Editar caja</strong></span>
                <p class="clearfix visible-lg">&nbsp;</p>
                <form id="formulario_caja" method="POST" action="">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Banco:</label>
                        <select name="id_banco" id="id_banco" class="form-control" onchange="consulta_caja_abierta(); consulta_monto_apertura();">
                            <option value="">Selecione...</option>
                            <?php
                            foreach ($resultados as $i => $banco) {
                                echo '<option value="' . $banco->id_banco . '">' . $banco->nombre_banco . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Monto&nbsp;Apertura:</label>
                        <input type="text" class="form-control" id="monto_apertura" name="monto_apertura" placeholder="Monto" maxlength="12" onkeypress="return filterFloat(event,this);" onkeyup="" autocomplete="off">

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-navy btn-block" style="box-shadow: 2px 2px 10px #666; display:block;" id="registrar_solicitud"><i class="fa fa-check"></i> Registrar</button>
                        <button class="btn btn-primary btn-block" id="registrar_solicitud_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(1)">
                            <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                        <br>
                        <strong>Monto m&iacute;nimo sugerido para aperturar caja: 1.500.000,00 Bs</strong>
                    </div>
                </form>
        </div>


        <div class="col-md-9">
            <p>&nbsp;</p>
            <p>&nbsp;&nbsp;&nbsp;<span class="label label-default" style="box-shadow: 2px 2px 10px #666;"><strong>Detalle de Caja</strong></span>
                <div id="tabla_cajas"></div>
        </div>
    </div>

    <br>

    <div class="btn-group btn-group-justified btn-group-xs visible-xs" id="footer_menu" style="text-align: right; border-radius:0px;">
        <a href="<?php echo BASE_URL() ?>principal/dashboard" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-gears"></i><br>Configuracion</a>
        <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-file-text-o"></i><br>Solicitudes</a>
        <a href="<?php echo BASE_URL() ?>transferencias/historico" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-file-text"></i><br>Hist&oacute;rico</a>
        <a href="<?php echo BASE_URL() ?>administracion/usuarios" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-users"></i><br>Usuarios</a>
        <a href="<?php echo BASE_URL() ?>administracion/usuarioModificar" class="btn btn-default" style="border-radius:0px;"><i class="fa fa-user"></i><br>Mi Usuario</a>
    </div>



    <footer id="sticky" class="clearfix visible-lg">
        <p>idsistemas15.com &nbsp;<i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727</p>
    </footer>
</body>



<script>
    function leercajas() {
        $.get("<?php echo base_url() . 'index.php/Configuraciones/lista_cajas'; ?>", {}, function(data, status) {
            var x = $("#tabla_cajas").html(data);
        });
    }
    $(document).ready(function() {
        leercajas();
    });


    $(window).load(function() {
        $(".loader").fadeOut("slow");
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
            "Septiembre", "Octubre", "Noviembre", "Diciembre");
        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        var f = new Date();
        $("#resultado").html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f
            .getFullYear());
    });

    function consulta_monto_apertura() {

        $.ajax({
            url: "<?php echo base_url() . 'index.php/Configuraciones/consultar_monto_apertura'; ?>",
            dataType: 'html',
            type: 'post',
            data: {
                id_banco: $('#id_banco').val()
            },
            success: function(respuesta) {
                var resp = JSON.parse(respuesta);
                console.log(resp);
                if (respuesta) {
                    $("#monto_apertura").val(resp[0].monto_apertura);
                    $("#saldo").val(resp[0].saldo);
                } else {

                    $("#monto_apertura").val('0');
                    $("#saldo").val('0');
                }

            }
        });
    }

    function consulta_caja_abierta() {

        $.ajax({
            url: "<?php echo base_url() . 'index.php/Configuraciones/consultar_caja_ab'; ?>",
            dataType: 'html',
            type: 'post',
            data: {
                id_banco: $('#id_banco').val()
            },
            success: function(respuesta) {
                var resp = JSON.parse(respuesta);
                console.log(resp);
                if (respuesta === 1) {
                    alertify.error("Debe cerrar la caja anterior...!!");
                    $('#monto_apertura').val('');
                    $('#id_banco').val('');
                } else {
                    //$("#monto_apertura").val(resp[0].monto_apertura); 
                }

            }
        });
    }


    function myFunction(idButton) {

        var caja = document.getElementById('caja');
        var editar_caja = document.getElementById('editar_caja');

        switch (idButton) {
            case 1:
                caja.style.display = 'block';
                editar_caja.style.display = 'none';
                break;

            case 2:
                caja.style.display = 'none';
                editar_caja.style.display = 'block';
                break;

            default:
                alert("hay un problema: No existe la ruta.")
        }

    }

    function filterFloat(evt, input) {
        // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempValue = input.value + chark;
        if (key >= 48 && key <= 57) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            if (key == 8 || key == 13 || key == 0) {
                return true;
            } else if (key == 46) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    function filter(__val__) {
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if (preg.test(__val__) === true) {
            return true;
        } else {
            return false;
        }
    }

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


    $(document).ready(function() {
        $('#formulario_caja').formValidation({
            fields: {

                adjunto_resp: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
            //==============  registro de solicitud ======================================================          
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            //alert('entro');return;
            data = {
                id_banco: $('#id_banco').val(),
                monto_apertura: $('#monto_apertura').val()
            };
            if (data.monto_apertura == '' || data.id_banco == '') {
                $('#formulario_caja').bootstrapValidator("resetForm", true);
                $('#id_banco').val('');
                $('#monto_apertura').val('');
                return;
            }


            $.ajax({
                url: "<?php echo base_url() . 'index.php/Configuraciones/registrar_caja'; ?>",
                method: 'POST',
                data: {
                    id_banco: $('#id_banco').val(),
                    monto_apertura: $('#monto_apertura').val()
                },


                beforeSend: function() {
                    document.getElementById('registrar_solicitud_loader').style.display = 'block';
                    document.getElementById('registrar_solicitud').style.display = 'none';
                },
            }).success(function(response) {

                alertify.log("Caja Actualizada Exitosamente...!!");
                document.getElementById('registrar_solicitud_loader').style.display = 'none';
                document.getElementById('registrar_solicitud').style.display = 'block';
                $('#formulario_caja').bootstrapValidator("resetForm", true);
                $('#id_banco').val('');
                $('#monto_apertura').val('');
                //myFunction(1);
                leercajas();

            });
        });
    });




    $(document).ready(function() {
        $("#cancelar_solicitud").click(function() {
            $.ajax({
                url: "<?php echo base_url() . 'index.php/Transferencias/cancelar_solicitud_error'; ?>",
                data: {
                    id_transferencia: $('#id_transferencia').val()
                },
                dataType: 'html',
                type: 'post',
                beforeSend: function() {
                    document.getElementById('registrar_solicitud_loader').style.display = 'block';
                    document.getElementById('cancelar_solicitud').style.display = 'none';
                },

                success: function(respuesta) {
                    alertify.error("Solicitud Cancela ...!!");
                    document.getElementById('registrar_solicitud_loader').style.display = 'none';
                    document.getElementById('cancelar_solicitud').style.display = 'block';
                    $('#formulario_registrar_solicitud').bootstrapValidator("resetForm", true);
                    myFunction(1);
                    leerSolicitudes();

                }
            });
        });
    });
</script>

<script>
    function nobackbutton() {

        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button" //chrome
        window.onhashchange = function() {
            window.location.hash = "";
        }

    }
</script>