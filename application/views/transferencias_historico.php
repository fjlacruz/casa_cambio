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
   position:fixed;
   left:0px;
   bottom:10px;
   height:30px;
   width:100%;
   background:#999;
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
<script type="text/javascript">
    Paginador = function(divPaginador, tabla, tamPagina) {
        this.miDiv = divPaginador; //un DIV donde irán controles de paginación
        this.tabla = tabla; //la tabla a paginar
        this.tamPagina = tamPagina; //el tamaño de la página (filas por página)
        this.pagActual = 1; //asumiendo que se parte en página 1
        this.paginas = Math.floor((this.tabla.rows.length - 1) / this.tamPagina); //¿?

        this.SetPagina = function(num) {
            if (num < 0 || num > this.paginas)
                return;
            this.pagActual = num;
            var min = 1 + (this.pagActual - 1) * this.tamPagina;
            var max = min + this.tamPagina - 1;
            for (var i = 1; i < this.tabla.rows.length; i++) {
                if (i < min || i > max)
                    this.tabla.rows[i].style.display = 'none';
                else
                    this.tabla.rows[i].style.display = '';
            }
            this.miDiv.firstChild.rows[0].cells[1].innerHTML = this.pagActual;
        }

        this.Mostrar = function() {
            var tblPaginador = document.createElement('table');
            var fil = tblPaginador.insertRow(tblPaginador.rows.length);

            //Ahora, agregar las celdas que serán los controles
            var ant = fil.insertCell(fil.cells.length);
            ant.innerHTML =
                '<button type="button" class="btn bg-primary btn-xs"><i class="fa fa-fast-backward"></i></button>&nbsp;&nbsp;';
            //ant.className = 'pag_btn'; //con eso le asigno un estilo
            var self = this;
            ant.onclick = function() {
                if (self.pagActual == 1)
                    return;
                self.SetPagina(self.pagActual - 1);
            }

            var num = fil.insertCell(fil.cells.length);
            num.innerHTML = ''; //en rigor, aún no se el número de la página
            num.className = 'pag_num';

            var sig = fil.insertCell(fil.cells.length);
            sig.innerHTML =
                '&nbsp;&nbsp;<button type="button" class="btn bg-primary btn-xs"><i class="fa fa-fast-forward"></i></button>';

            //sig.className = 'pag_btn';
            sig.onclick = function() {
                if (self.pagActual == self.paginas)
                    return;
                self.SetPagina(self.pagActual + 1);
            }

            //Como ya tengo mi tabla, puedo agregarla al DIV de los controles
            this.miDiv.appendChild(tblPaginador);

            //¿y esto por qué?
            if (this.tabla.rows.length - 1 > this.paginas * this.tamPagina)
                this.paginas = this.paginas + 1;

            this.SetPagina(this.pagActual);
        }
    }
</script>

<body onload="nobackbutton();">
    <div class="loader"></div>
    <div class="container" id="solicitudes">
        <div class="col-md-3">
            <p lass="clearfix visible-lg">&nbsp;</p>
            <p lass="clearfix visible-lg">&nbsp;</p>
            <button type="button" class="btn btn-default clearfix visible-lg" style="box-shadow: 2px 2px 5px #666;">
                <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="small-box-footer"> <i class="fa fa-arrow-circle-left"> Regresar</i></a>
            </button><br class="clearfix visible-lg">
            <p class="clearfix visible-lg">&nbsp;</p>
            <p class="clearfix visible-lg">&nbsp;</p>
            <div class="panel panel-default clearfix visible-lg" style="box-shadow: 2px 2px 10px #666;">
                <div class="panel-heading">
                    <p><strong>Bancos</strong></p>
                </div>
                <div class="panel-body">
                    <div id="tabla_bancos_info"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <p class="clearfix visible-lg">&nbsp;</p>
            <p>&nbsp;&nbsp;&nbsp;<span class="label label-default" style="box-shadow: 2px 2px 10px #666;"><strong>Solicitudes Procesadas</strong></span>
            </p><br lass="clearfix visible-lg">
            <div class="form-group">
                <label class="control-label col-sm-2" align="right">Año:</label>
                <div class="col-sm-3">
                    <select name="anio" id="anio" class="form-control"></select>
                </div>
                <label class="control-label col-sm-2" align="right">Mes:</label>
                <div class="col-sm-3">
                    <select name="mes" id="mes" class="form-control">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <label class="control-label col-sm-1" align="right">&nbsp;</label>
                <div class="col-sm-1 clearfix visible-lg"> <button type="button" class="btn bg-primary" style="box-shadow: 2px 2px 10px #666;" id="buscar"><i class="fa fa-search"></i></button></div>
                <div class="col-sm-12 clearfix visible-xs"> <button type="button" class="btn bg-primary btn-block" style="box-shadow: 2px 2px 10px #666;" id="buscar"><i class="fa fa-search"></i> Buscar</button></div>
            </div>
            <div id="historico"></div>

            <br lass="clearfix visible-lg"><br lass="clearfix visible-lg">
            <div id="cargando_historico" align="center"></div>

            <div class="form-group">
                <label class="control-label col-sm-4" align="right"><span class="label label-default" style="box-shadow: 2px 2px 10px #666;">Nro de Transferencias:</span></label>
                <div class="col-sm-2">
                    <p id="cantidad_solicitudes" style="text-align:left;"></p>
                </div>
                <label class="control-label col-sm-3" align="right"><span class="label label-default" style="box-shadow: 2px 2px 10px #666;">Monto Total (Bs):</span></label>
                <div class="col-sm-3">
                    <p id="monto_total"></p>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <br> <br> <br>
        
            <div class="panel panel-default clearfix visible-lg" style="box-shadow: 2px 2px 10px #666;">
                <div class="panel-heading">
                    <p><strong>Tasa</strong></p>
                    <p id="resultado"></p>
                </div>
                <div class="panel-body">
                    <div id="tabla_tasas"></div>
                </div>
            </div>

        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>

    <div class="container" id="registrar_transferencia" style="display:none">
        <div class="container">
            <div class="row">
            <div class="col-sm-6"><br>
                    <div class="panel panel-default" style="box-shadow: 2px 2px 10px #666;">
                        <div class="panel-heading" align="center">
                            <strong> Adjunto</strong>
                        </div>
                        <div class="panel-body">
                            <div id="transferencias_adjuntos_historico"></div>
                            <div id="cargando" align="center"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <br>
                    <div class="panel panel-default" style="box-shadow: 2px 2px 10px #666;">
                        <div class="panel-heading" align="center">
                            <strong> Datos de la Transferencia</strong>
                        </div>
                        <div class="panel-body">
                        <p id="nombre_pais"></p>
                            <p id="depositante"></p>
                            <p id="telefono"></p>
                            <p id="correo"></p>
                            <p id="monto_pesos"></p>
                            <p id="tasa"></p>
                            <p id="destinatario"></p>
                            <p id="identificacion"></p>
                            <p id="email"></p>
                            <p id="banco"></p>
                            <p id="cuenta_tipo"></p>
                            <p id="monto_a_transferir"></p>
                            <p id="fecha_registro"></p>
                        </div>
                    </div>
                    <form class="form-horizontal" id="formulario_registrar_solicitud" method="POST" action="">
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="hidden" id="id_transferencia" name="id_transferencia">
                                <div class="col-sm-12">
                                    
                                    <button class="btn btn-primary btn-block" id="registrar_solicitud_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(1)">
                                        <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                    <button type="button" class="btn bg-primary btn-block" style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(1)"><i class="fa fa-arrow-left"></i> Regresar</button>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="btn-group btn-group-justified btn-group-xs visible-xs" id="footer_menu" style="text-align: right; border-radius:0px;">
    <a href="<?php echo BASE_URL() ?>transferencias/inicio" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-file-text-o"></i><br>Solicitudes</a>
  <a href="<?php echo BASE_URL() ?>principal/dashboard" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-gears"></i><br>Configuracion</a>
  <a href="<?php echo BASE_URL() ?>administracion/usuarios" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-users"></i><br>Usuarios</a>
  <a href="<?php echo BASE_URL() ?>administracion/usuarioModificar" class="btn btn-default"  style="border-radius:0px;"><i class="fa fa-user"></i><br>Mi Usuario</a>
</div>



    <footer id="sticky" class="clearfix visible-lg">
        <p>idsistemas15.com &nbsp;<i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727</p>
    </footer>
</body>


<script>
    $(document).on("click", '#buscar', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Transferencias/estadisticas_historico'; ?>",
            data: {
                anio: $('#anio').val(),
                mes: $('#mes').val()
            },
            beforeSend: function() {
                $("#cargando_historico").html('<img src="<?php echo base_url(); ?>application/recursos/imagenes/loader1.gif">');
            },
            dataType: 'html',
            type: 'post',
            success: function(salida) {
                //alert(salida); 
                //var datos = salida.split("~");
                //alert(datos[0]);
                $("#cargando_historico").html('');
                $("#historico").html(salida);
            }
        });
    });

    $(document).on("click", '#buscar', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Transferencias/monto_historico'; ?>",
            data: {
                anio: $('#anio').val(),
                mes: $('#mes').val()
            },

            dataType: 'html',
            type: 'post',
            success: function(salida) {
                const formatter = new Intl.NumberFormat('it-IT', {
                    minimumFractionDigits: 2
                });
                $("#monto_total").html(formatter.format(salida));
            }
        });
    });

    $(document).on("click", '#buscar', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Transferencias/contar_solicitudes_historico'; ?>",
            data: {
                anio: $('#anio').val(),
                mes: $('#mes').val()
            },

            dataType: 'html',
            type: 'post',
            success: function(salida) {
                //alert(salida); 
                $("#cantidad_solicitudes").html(salida);
            }
        });
    });

    $(document).ready(function() {
        $("#editBanco").click(function() {
            var dataBanco = {
                "nombre_banco": $("#nombre_banco").val()
            };
            if (dataBanco.nombre_banco === '') {
                // alertify.error("Deba Argregar nombre de Banco...!!");
                return false;
                myFunction(2);
            }
        });
    });


    function leerTasas() {
        $.get("<?php echo base_url() . 'index.php/Transferencias/tasas'; ?>", {}, function(data, status) {
            var x = $("#tabla_tasas").html(data);
        });
    }
    $(document).ready(function() {
        leerTasas();
    });

    function leerBancos() {
        $.get("<?php echo base_url() . 'index.php/configuraciones/bancos_info'; ?>", {}, function(data, status) {
            var x = $("#tabla_bancos_info").html(data);
        });
    }
    $(document).ready(function() {
        leerBancos();
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

    function myFunction(idButton) {

        var solicitudes = document.getElementById('solicitudes');
        var registrar_transferencia = document.getElementById('registrar_transferencia');

        switch (idButton) {
            case 1:
                solicitudes.style.display = 'block';
                registrar_transferencia.style.display = 'none';
                break;

            case 2:
                solicitudes.style.display = 'none';
                registrar_transferencia.style.display = 'block';

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
        $('#formulario_registrar_solicitud').formValidation({
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
            var form = $(this);

            $.ajax({
                url: "<?php echo base_url() . 'index.php/Transferencias/cancelar_solicitud_error'; ?>",
                method: 'POST',
                data: form.serialize(), // serializes the form's elements.


                beforeSend: function() {
                    document.getElementById('registrar_solicitud_loader').style.display = 'block';
                    document.getElementById('registrar_solicitud').style.display = 'none';;
                },
            }).success(function(response) {

                alertify.error("Solicitud Cancela ...!!");
                document.getElementById('registrar_solicitud_loader').style.display = 'none';
                document.getElementById('registrar_solicitud').style.display = 'block';
                $('#formulario_registrar_solicitud').bootstrapValidator("resetForm", true);
                myFunction(1);
                leerSolicitudes();

            });
        });
    });

    function fileValidation() {
        var fileInput = document.getElementById('adjunto');
        var filePath = fileInput.value;
        var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alertify.error("Formato Incorrecto...!!");
            fileInput.value = '';
            return false;
            setTimeout(function() {
                $(".formato_incorrecto").fadeOut(1500);
            }, 3000);
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<img width="100" height="100" src="' + e.target.result + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function Comboanio() {
        var n = (new Date()).getFullYear()
        var select = document.getElementById("anio");
        for (var i = n; i >= 2018; i--) select.options.add(new Option(i, i));
    };
    window.onload = Comboanio;
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