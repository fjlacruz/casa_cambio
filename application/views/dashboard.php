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
</style>
<style>
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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<br>

<body onload="nobackbutton();">
    <div class="loader"></div>
    <div class="container" id="configuraciones">
        <div class="col-lg-12 clearfix visible-lg"> <button type="button" class="btn btn-default">
                <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Regresar</i></a>
            </button></div>
        <div class="col-lg-12">&nbsp;</div>
        <div class="col-lg-4">
            <form action='' name="act_tasa" id="act_tasa" method="post">
                <p><strong>Tasa del D&iacute;a</strong></p>
                <p id="resultado"></p><br>
                <div id="select_paises"></div>
                <br>
                <input type="text" class="form-control" name="valor" id="valor" onkeypress="return filterFloat(event,this);"><br>
                <button type="button" id="actualizar_tasa" style='display:block;' style="box-shadow: 2px 2px 10px #666;" class="btn bg-navy btn-block" onclick="event.preventDefault();"><i class="fa fa-refresh"></i>
                    Actualizar Tasa</button>
                <button class="btn btn-primary btn-block" id="actualizar_loader" style="box-shadow: 2px 2px 10px #666; display:none;">
                    <i class="glyphicon glyphicon-refresh gly-spin"></i> Actualizando Tasa....</button>
            </form>
            <p>&nbsp;</p>
        </div>

        <div class="col-lg-4">
            <p><strong>Bancos</strong>&nbsp;</p>
            <form name="editBanco" id="editBanco" method="POST">
                <div id="tabla_bancos"></div>
                <input type="hidden" class="form-control" name="id_banco" id="id_banco">
                <input type="text" class="form-control" name="nombre_banco" id="nombre_banco" placeholder="Nombre del Banco" onkeyup="javascript:this.value = this.value.toUpperCase()"><br>
                <button id="edit_Banco" style='display:block;' style="box-shadow: 2px 2px 10px #666;" class="btn bg-navy btn-block"><i class="fa fa-refresh"></i>
                    Actualizar/Agregar Banco</button>
                <button class="btn btn-primary btn-block" id="editBanco_loader" style="box-shadow: 2px 2px 10px #666; display:none;">
                    <i class="glyphicon glyphicon-refresh gly-spin"></i> Actualizando Banco....</button>
            </form>
            <p>&nbsp;</p>
        </div>

        <div class="col-lg-4">
            <form action='' name="editPais" id="editPais" method="post">
                <p><strong>Pa&iacute;ses</strong></p>
                <div id="tabla_paises"></div>
                <input type="hidden" class="form-control" name="id_pais" id="id_pais">
                <input type="text" class="form-control" name="nombre_pais" id="nombre_pais" placeholder="Nombre del Pa&iacute;s" onkeyup="javascript:this.value = this.value.toUpperCase()" onclick="limpiar_duplicados_paises();"><br>
                <button id="edit_pais" style='display:block;' style="box-shadow: 2px 2px 10px #666;" class="btn bg-navy btn-block"><i class="fa fa-refresh"></i>
                    Actualizar/Agregar Pa&iacute;s</button>
                <button class="btn btn-primary btn-block" id="editPais_loader" style="box-shadow: 2px 2px 10px #666; display:none;">
                    <i class="glyphicon glyphicon-refresh gly-spin"></i> Actualizando Pa&iacute;s....</button>
            </form>
        </div>
    </div>
    <br>


    <br><br>
    <div class="btn-group btn-group-justified btn-group-xs visible-xs" id="footer_menu" style="text-align: right; border-radius:0px;">
    <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-file-text-o"></i><br>Solicitudes</a>
    <a href="<?php echo BASE_URL() ?>configuraciones/caja" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-dollar"></i><br>Caja</a>
  <a href="<?php echo BASE_URL() ?>transferencias/historico" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-file-text"></i><br>Hist&oacute;rico</a>
  <a href="<?php echo BASE_URL() ?>administracion/usuarios" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-users"></i><br>Usuarios</a>
  <a href="<?php echo BASE_URL() ?>administracion/usuarioModificar" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-user"></i><br>Mi Usuario</a>
</div>



    <footer id="sticky" class="clearfix visible-lg">
        <p>idsistemas15.com &nbsp;<i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727</p>
    </footer>
</body>




<script>
    function leerBancos() {
        $.get("<?php echo base_url() . 'index.php/Configuraciones/bancos'; ?>", {}, function(data, status) {
            $("#tabla_bancos").html(data);
        });
    }
    $(document).ready(function() {
        leerBancos();
    });

    function leerPises() {
        $.get("<?php echo base_url() . 'index.php/Configuraciones/paises'; ?>", {}, function(data, status) {
            $("#tabla_paises").html(data);
        });
    }
    $(document).ready(function() {
        leerPises();
    });


    /*  $(document).ready(function() {
    var refreshId = setInterval(function() {
      $("#select_paises").load("<?php echo base_url() ?>index.php/Configuraciones/leerSelect")
      .error(function() { alert("Error"); });
    }, 2000);
    $.ajaxSetup({ cache: false });        
  });*/



    function leerSelect() {
        $.get("<?php echo base_url() . 'index.php/Configuraciones/leerSelect'; ?>", {}, function(data, status) {
            $("#select_paises").html(data);
        });
    }
    $(document).ready(function() {
        leerSelect();
    });

    function consulta_tasa() {
        var dataSelect = {
            "pais": $("#pais").val()
        };
        if (dataSelect.pais == 0) {
            $("#valor").val('');
            return false;
        }
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Configuraciones/tasa'; ?>",
            dataType: 'html',
            type: 'post',
            data: {
                id_pais: $('#pais').val()
            },
            success: function(respuesta) {
                var resp = JSON.parse(respuesta);
                $("#valor").val(resp[0].valor);
            }
        });
    }

    function limpiar_duplicados() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Configuraciones/eliminar_duplicados'; ?>",
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {
                var resp = JSON.parse(respuesta);
                $("#valor").val(resp[0].valor);
            }
        });
    }
    $(document).ready(function() {
        $("#actualizar_tasa").click(function() {
            var dataSelect = {
                "pais": $("#pais").val(),
                "val": $("#valor").val()
            };
            if (dataSelect.pais == 0 || dataSelect.val == '') {
                $("#valor").val('');
                return false;
            }
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/actualizar_tasa_dia'; ?>",
                data: {
                    valor_tasa: $('#valor').val(),
                    id_pais: $('#pais').val()
                },
                dataType: 'html',
                type: 'post',
                beforeSend: function() {
                    document.getElementById('actualizar_loader').style.display = 'block';
                    document.getElementById('actualizar_tasa').style.display = 'none';
                },

                success: function(respuesta) {
                    document.getElementById('actualizar_loader').style.display = 'none';
                    document.getElementById('actualizar_tasa').style.display = 'block';
                    alertify.log("Tasa Actualizada Exitosamente...!!");
                }
            });
        });
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

    /*function myFunction(idButton) {
        var dashboard = document.getElementById('dashboard');
        var configuraciones = document.getElementById('configuraciones');


        switch (idButton) {
            case 1:
                dashboard.style.display = 'block';
                configuraciones.style.display = 'none';
                break;

            case 2:
                dashboard.style.display = 'none';
                configuraciones.style.display = 'block';
                break;
            default:
                alert("hay un problema: No existe la ruta.")
        }

    }*/

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

    function nobackbutton() {

        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button" //chrome
        window.onhashchange = function() {
            window.location.hash = "";
        }

    }
    //ALTER TABLE tblname AUTO_INCREMENT = 0;
</script>