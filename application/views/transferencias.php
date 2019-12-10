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
$nombres = $variablesSesion['nombres'];
$apellidos = $variablesSesion['apellidos'];
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
        font-size: 11px;
        text-align: left;
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
    <div class="container" id="cuentas">
        <div class="col-md-3 clearfix visible-lg">
            <br>
            <div class="panel panel-default" style="box-shadow: 2px 2px 10px #666;">
                <div class="panel-heading">
                    <p><strong>Tasa:</strong></p>
                    <p id="resultado"></p>
                </div>
                <div class="panel-body">
                    <div id="tabla_tasas"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <p>&nbsp;</p>
            <p><strong>&nbsp;&nbsp;&nbsp;
            <span class="label label-default" style="box-shadow: 2px 2px 5px #666;">Cuentas</span>&nbsp;&nbsp;</strong><span tooltip='Registrar Cuenta' flow='right'><button type='button' style="box-shadow: 2px 2px 5px #666;" onclick='myFunction(3)' class='btn bg-navy btn-xs' data-toggle="modal" data-target="#myModal">
                        <span class='fa  fa-plus-circle'></span>
                    </button></span><strong>&nbsp;&nbsp;&nbsp;
                    <span class="label label-default" style="box-shadow: 2px 2px 5px #666;">Solicitudes</span>&nbsp;&nbsp;</strong><span tooltip='Solicitudes' flow='right'><button style="box-shadow: 2px 2px 5px #666;" type='button' onclick='myFunction(5); leerSolicitudes();' class='btn bg-navy btn-xs'>
                        <span class='fa fa-money'></span>
                    </button></span></p>

            <div id="tabla_cuentas"></div>
        </div>

        <div class="col-md-3">
            <br>
            <div class="panel panel-default clearfix visible-lg" style="box-shadow: 2px 2px 10px #666;">
                <div class="panel-heading"><strong>Bancos</strong></div>
                <div class="panel-body">
                    <div id="tabla_bancos_info"></div>
                </div>
            </div>

        </div>




        <div class="col-md-3">&nbsp;</div>
    </div>
    <div class="container" id="editar_cuenta" style="display:none">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">&nbsp;</div>
                <div class="col-sm-6">
                    <br>
                    <div class="panel-heading" align="center">
                        <strong> <span class="label label-default" style="box-shadow: 2px 2px 5px #666;">Editar Cuenta</span></strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="formulario_editar_cuenta" action="">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Titular:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-uppercase" id="nombres_apellidos_edit" onKeyPress="return soloLetras(event)" name="nombres_apellidos_edit" placeholder="Nombres y Apellidos" maxlength="20">
                                    <input type="hidden" id="id_cuenta" name="id_cuenta">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">C&eacute;dula/Rif:</label>
                                <div class="col-sm-2">
                                    <select name="identificacion_edit" id="identificacion_edit" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J">J</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-uppercase" id="cedula_titular_edit" onKeyPress="return soloNumeros(event)" name="cedula_titular_edit" placeholder="C&eacute;dula/Rif" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Banco:</label>
                                <div class="col-sm-10">
                                    <select name="id_banco_edit" id="id_banco_edit" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php
                                        foreach ($bancos as $i => $banco) {
                                            echo '<option value="' . $banco->id_banco . '">' . $banco->nombre_banco . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Nro&nbsp;Cuenta:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nro_cuenta_edit" name="nro_cuenta_edit" onKeyPress="return soloNumeros(event)" placeholder="Nro&nbsp;Cuenta" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Tipo&nbsp;Cuenta:</label>
                                <div class="col-sm-10">
                                    <select name="tipo_cuenta_edit" id="tipo_cuenta_edit" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="CORRIENTE">CORRIENTE</option>
                                        <option value="AHORRO">AHORRO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" onkeyup="javascript:this.value = this.value.toUpperCase()" id="email_edit" name="email_edit" placeholder="Correo El&eacute;ctronico" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn bg-navy btn-block" style="box-shadow: 2px 2px 10px #666; display:block;"  onclick="myFunction(2)"><i class="fa fa-refresh"></i> Actualizar</button>
                                    <button class="btn btn-primary btn-block" id="editar_cuenta_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(1)">
                                        <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                    
                                    <button type="button" class="btn bg-primary btn-block" style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(1)"><i class="fa fa-close"></i> Cancelar</button>
                                    <br>
                                    
                                    <button type="button" id="eliminar_cuenta" style='display:block;' style="box-shadow: 2px 2px 10px #666;" class="btn btn-danger btn-block" onclick="event.preventDefault();"><i class="fa fa-trash"></i>
                                        Eliminar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="registrar_cuenta" style="display:none">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <!--modal de indicaciones al usuario -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #1976D2;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"> <strong><font color="white"> Condiciones de Uso </font></strong></h4>
                                </div>
                                <div class="modal-body">
                                    <p align="justify"> Estimado <?php echo $nombres ?>, cargue todos los datos requeridos en el formulario de registro de cuentas
                                        (destinatarios) de forma correcta. Es su responsabilidad si los datos registrados son erroneos. Evite inconvenientes.
                                    </p>

                                    <p align="justify"> Si por algun motivo su solicitud aprece en estado cancela, por favor pongase en contacto por xxxxxxxxx
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Entiendo..!!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <br>
                    <div class="panel-heading" align="center">
                        <strong> <span class="label label-default" style="box-shadow: 2px 2px 5px #666;">Registrar Cuenta</span></strong>

                    </div>
                    <div class="alert alert-warning">
                   <strong>Informaci&oacute;n! </strong> Para el Banco Banesco S&oacute;lo trabajamos con cuentas corriente
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="formulario_registrar_cuenta" action="">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Titular:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-uppercase" id="nombres_apellidos" onKeyPress="return soloLetras(event)" name="nombres_apellidos" placeholder="Nombres y Apellidos" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">C&eacute;dula/Rif:</label>
                                <div class="col-sm-2">
                                    <select name="identificacion" id="identificacion" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J">J</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-uppercase" id="cedula_titular" onKeyPress="return soloNumeros(event)" name="cedula_titular" placeholder="C&eacute;dula/Rif" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Banco:</label>
                                <div class="col-sm-10">
                                    <select name="id_banco" id="id_banco" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php
                                        foreach ($bancos as $i => $banco) {
                                            echo '<option value="' . $banco->id_banco . '">' . $banco->nombre_banco . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-2">Tipo&nbsp;Cuenta:</label>
                                <div class="col-sm-10">
                                    <select name="tipo_cuenta" id="tipo_cuenta" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="CORRIENTE">CORRIENTE</option>
                                        <option value="AHORRO">AHORRO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Nro&nbsp;Cuenta:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nro_cuenta" name="nro_cuenta" onKeyPress="return soloNumeros(event)" placeholder="Nro&nbsp;Cuenta" maxlength="20" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" onkeyup="javascript:this.value = this.value.toUpperCase()" id="email" name="email" placeholder="Correo El&eacute;ctronico" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn bg-navy btn-block" style="box-shadow: 2px 2px 10px #666; display:block;" id="registrar_cuentab"><i class="fa fa-check"></i> Registrar</button>
                                    <button class="btn btn-primary btn-block" id="registrar_cuenta_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(1)">
                                        <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                    <button type="button" class="btn bg-primary btn-block" style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(1)"><i class="fa fa-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" id="registrar_transferencia" style="display:none">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">&nbsp;</div>
                <div class="col-sm-6">
                    <br>
                    <div class="panel panel-default" style="box-shadow: 2px 2px 5px #666;">
                        <div class="panel-heading" align="center">
                            <strong> Datos de la Cuenta</strong>

                        </div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td align="right"><strong>Titular:&nbsp;<strong></td>
                                    <td>
                                        <p id="titular"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Cedula/Rif:&nbsp;<strong></td>
                                    <td>
                                        <p id="cedula"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Banco:&nbsp;<strong></td>
                                    <td>
                                        <p id="nombre_banco"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Nro Cuenta:&nbsp;<strong></td>
                                    <td>
                                        <p id="cuentaNro"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Tipo Cuenta:&nbsp;<strong></td>
                                    <td>
                                        <p id="cuenta"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>Email:&nbsp;<strong></td>
                                    <td>
                                        <p id="correo"></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="formulario_registrar_solicitud" method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" id="banco_id" name="banco_id">
                            <input type="hidden" id="cuenta_id" name="cuenta_id">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Pais&nbsp;Origen:</label>
                                <div class="col-sm-4">
                                    <select name="pais" id="pais" class="form-control" onchange="consulta_tasa(); multiplicar();">
                                        <option value="">Selecione...</option>
                                        <?php
                                        foreach ($paises as $i => $pais) {
                                            echo '<option value="' . $pais->id_pais . '">' . $pais->nombre_pais . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="control-label col-sm-2">Tasa:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="valor" id="valor" readonly placeholder="Tasa del D&iacute;a">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Monto:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="monto" name="monto" placeholder="Monto" maxlength="12"  onkeypress="return filterFloat(event,this);" onkeyup="javascript: multiplicar();" autocomplete="off">
                                </div>
                                <label class="control-label col-sm-2">Total&nbsp;a&nbsp;Enviar:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="monto_a_transferir" name="monto_a_transferir" placeholder="Total a Enviar" readonly onkeypress="return filterFloat(event,this);">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-2">Operaci&oacute;n:</label>
                                <div class="col-sm-10">
                                   
                                    <select name="tipo_operacion" id="tipo_operacion" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        <option value="DEPOSITO">DEPOSITO</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-2">Adjuntar:</label>
                                <div class="col-sm-10">
                                    <input type='file' name='adjunto' id="adjunto" class="form-control" onchange="return fileValidation()">
                                    <label class="control-label col-sm-8" align="left">(S&oacute;lo archivos jpg,jpeg,png)</label>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-sm-12">
                                    <button type="submit" class="btn bg-navy btn-block" style="box-shadow: 2px 2px 10px #666; display:block;" id="registrar_solicitud"><i class="fa fa-check"></i> Registrar</button>
                                    <button class="btn btn-primary btn-block" id="registrar_solicitud_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(1)">
                                        <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                    <button type="button" class="btn bg-primary btn-block" style="box-shadow: 2px 2px 10px #666;" onclick="myFunction(1)"><i class="fa fa-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="solicitudes" style="display:none">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">
            <p>&nbsp;</p>
            <p><span tooltip='Ver Cuentas' flow='right'><button style="box-shadow: 2px 2px 5px #666;" type='button' onclick='myFunction(1)' class='btn bg-navy btn-xs'>
                        <span class='fa fa-arrow-circle-left'></span> Cuentas
                    </button></span></p>

            <div id="tabla_solicitudes"></div>
        </div>
        <div class="col-md-2">&nbsp;</div>
    </div>

    <div class="container" id="detalles_adjunto" style="display:none">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
            <p>&nbsp;</p>
            <p><strong>&nbsp;&nbsp;&nbsp;Detalles Adjunto&nbsp;&nbsp;</strong><span tooltip='Ver Cuentas' flow='right'><button type='button' style="box-shadow: 2px 2px 5px #666;" onclick='myFunction(5)' class='btn bg-navy btn-xs'>
                        <span class='fa fa-arrow-circle-left'></span>
                    </button></span></p>

            <div id="transferencias_adjunto"></div>
            <div id="cargando" align="center"></div>
            <div id="cargando2" align="center"></div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>


    <br>
    <footer id="sticky">
       <div align="center">Copyright@idsistemas15.com</div>
    </footer>
</body>



<script>
    function leerCuentas() {
        $.get("<?php echo base_url() . 'index.php/Transferencias/cuentas'; ?>", {}, function(data, status) {
            var x = $("#tabla_cuentas").html(data);
        });
    }
    $(document).ready(function() {
        leerCuentas();
    });

    function leerSolicitudes() {
        $.get("<?php echo base_url() . 'index.php/Transferencias/solicitudes'; ?>", {}, function(data, status) {
            var x = $("#tabla_solicitudes").html(data);
        });
    }
    $(document).ready(function() {
        leerSolicitudes();
    });


    function leerTasas() {
        $.get("<?php echo base_url() . 'index.php/Transferencias/tasas'; ?>", {}, function(data, status) {
            var x = $("#tabla_tasas").html(data);
        });
    }
    $(document).ready(function() {
        leerTasas();
    });

    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#tabla_bancos_info").load("<?php echo base_url() ?>index.php/configuraciones/bancos_info")
                .error(function() {
                    alert("Error");
                });
        }, 1000);
        $.ajaxSetup({
            cache: false
        });
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

        var cuentas = document.getElementById('cuentas');
        var editar_cuenta = document.getElementById('editar_cuenta');
        var registrar_cuenta = document.getElementById('registrar_cuenta');
        var registrar_transferencia = document.getElementById('registrar_transferencia');
        var solicitudes = document.getElementById('solicitudes');
        var detalles_adjunto = document.getElementById('detalles_adjunto');

        switch (idButton) {
            case 1:
                cuentas.style.display = 'block';
                editar_cuenta.style.display = 'none';
                registrar_cuenta.style.display = 'none';
                registrar_transferencia.style.display = 'none';
                solicitudes.style.display = 'none';
                detalles_adjunto.style.display = 'none';
                break;

            case 2:
                cuentas.style.display = 'none';
                editar_cuenta.style.display = 'block';
                registrar_cuenta.style.display = 'none';
                registrar_transferencia.style.display = 'none';
                solicitudes.style.display = 'none';
                detalles_adjunto.style.display = 'none';
                break;

            case 3:
                cuentas.style.display = 'none';
                editar_cuenta.style.display = 'none';
                registrar_cuenta.style.display = 'block';
                registrar_transferencia.style.display = 'none';
                solicitudes.style.display = 'none';
                detalles_adjunto.style.display = 'none';
                break;
            case 4:
                cuentas.style.display = 'none';
                editar_cuenta.style.display = 'none';
                registrar_cuenta.style.display = 'none';
                registrar_transferencia.style.display = 'block';
                solicitudes.style.display = 'none';
                detalles_adjunto.style.display = 'none';
                break;
            case 5:
                cuentas.style.display = 'none';
                editar_cuenta.style.display = 'none';
                registrar_cuenta.style.display = 'none';
                registrar_transferencia.style.display = 'none';
                solicitudes.style.display = 'block';
                detalles_adjunto.style.display = 'none';
                break;
            case 6:
                cuentas.style.display = 'none';
                editar_cuenta.style.display = 'none';
                registrar_cuenta.style.display = 'none';
                registrar_transferencia.style.display = 'none';
                solicitudes.style.display = 'none';
                detalles_adjunto.style.display = 'block';
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
        $("#eliminar_cuenta").click(function() {
            $.ajax({
                url: "<?php echo base_url() . 'index.php/transferencias/eliminar_cuenta'; ?>",
                data: {
                    id_cuenta: $('#id_cuenta').val()
                },
                dataType: 'html',
                type: 'post',
                beforeSend: function() {
                    document.getElementById('editar_cuenta_loader').style.display = 'block';
                    document.getElementById('editar_cuenta').style.display = 'none';
                    document.getElementById('eliminar_cuenta').style.display = 'none';
                },
                success: function(respuesta) {
                    document.getElementById('editar_cuenta_loader').style.display = 'none';
                    document.getElementById('editar_cuenta').style.display = 'block';
                    document.getElementById('eliminar_cuenta').style.display = 'block';
                    alertify.error("Cuenta Eliminada...!!!");
                    leerCuentas();
                    myFunction(1);

                }
            });
        });
    });
    

    

    $(document).ready(function() {
        $('#formulario_registrar_cuenta').formValidation({
            fields: {
                nombres_apellidos: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                email: {
                    row: '.col-sm-10',
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
                identificacion: {
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                cedula_titular: {
                    row: '.col-sm-8',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                id_banco: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                nro_cuenta: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                tipo_cuenta: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
            //==============  registro de cuenta ======================================================          
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "<?php echo base_url() . 'index.php/Transferencias/registrar_cuenta'; ?>",
                method: 'POST',
                data: $form.serialize(),
                beforeSend: function() {
                    document.getElementById('registrar_cuenta_loader').style.display = 'block';
                    document.getElementById('registrar_cuenta').style.display = 'none';
                },
            }).success(function(response) {

                alertify.log("Cuenta Registrada Exitosamente...!!");
                document.getElementById('registrar_cuenta_loader').style.display = 'none';
                document.getElementById('registrar_cuenta').style.display = 'block';
                $('#id_banco').val('');
                $('#nombres_apellidos').val('');
                $('#identificacion').val('');
                $('#cedula_titular').val('');
                $('#tipo_cuenta').val('');
                $('#email').val('');
                $('#nro_cuenta').val('');
                myFunction(1);
                leerCuentas();
            });
        });
    });

    $(document).ready(function() {
        $('#formulario_registrar_solicitud').formValidation({
            fields: {
                pais: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                monto: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        between: {
                        min: 1000,
                        max: 100000000000,
                        message: 'Monto Minimo 1000'
                    }
                    }
                },
                monto_a_transferir: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                valor: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                tipo_operacion: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                adjunto: {
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
            
             /*data= {
                    monto_a_transferir: $('#monto_a_transferir').val()
                }
                alert(data.monto_a_transferir);return;*/

            var formData = new FormData($("#formulario_registrar_solicitud")[0]);
            $.ajax({
                url: "<?php echo base_url() . 'index.php/Transferencias/registrar_solicitud'; ?>",
                method: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    document.getElementById('registrar_solicitud_loader').style.display = 'block';
                    document.getElementById('registrar_solicitud').style.display = 'none';
                    $('#formulario_registrar_solicitud').bootstrapValidator("resetForm", true);
                },
            }).success(function(response) {

                alertify.log("Solicitud Enviada Exitosamente...!!");
                document.getElementById('registrar_solicitud_loader').style.display = 'none';
                document.getElementById('registrar_solicitud').style.display = 'block';
                $('#formulario_registrar_solicitud').bootstrapValidator("resetForm", true);
                document.getElementById("adjunto").value = "";
                $('#pais').val('');
                $('#valor').val('');
                $('#monto').val('');
                $('#adjunto').val('');
                $('#monto_a_transferir').val('');
                myFunction(5);
                leerSolicitudes();

            });
        });
    });

    function multiplicar(id) {
        document.getElementById("monto_a_transferir").value = document.getElementById("monto").value * document.getElementById("valor").value;
    }

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
</script>

<script type="text/javascript">
    var nro = 5;
    var p = new Paginador(
        document.getElementById('paginador'),
        document.getElementById('tblDatos'),
        nro
    );
    p.Mostrar();
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

<script>
    $(document).ready(function() {
        $("#tipo_cuenta").click(function() {
            var dataBanco = {
                "id_banco": $("#id_banco").val(),
                "tipo_cuenta": $("#tipo_cuenta").val()
            };
            if(dataBanco.id_banco == 4 && dataBanco.tipo_cuenta == 'AHORRO'){
              alertify.error("Para el Banco Banesco Sólo trabajamos con cuentas corriente ...!!!");
              $('#tipo_cuenta').val('');
              document.getElementById('registrar_cuentab').style.display = 'none';
            }else{
                document.getElementById('registrar_cuentab').style.display = 'block';
            }
            
        });
    });

    </script>

    <script>
    $(document).ready(function() {
        $("#email").click(function() {
            var data = {"nro_cuenta": $("#nro_cuenta").val()};
            var nCta = data.nro_cuenta
            //alert(nCta)
            inicio = 12,
            fin    = 13,
            identificadorCuenta = nCta.substring(inicio, fin);
            
            if(identificadorCuenta == 3 || identificadorCuenta == 5 ){
              alertify.error("Esta serie corresponde a una cuenta de tipo Ahorro ...!!!");
              $('#nro_cuenta').val('');
              document.getElementById('registrar_cuentab').style.display = 'none';
            }else{
                document.getElementById('registrar_cuentab').style.display = 'block';
            }
            
        });
    });

    </script>


