<br><br><br><br>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="description" content="Software para gestion de casas de cambio">
<meta name="theme-color" content="#1976D2">
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
</style>
<style>
    .panel-heading {
        padding: 5px 15px;
    }

    /*1976D2*/
    .panel-footer {
        padding: 1px 15px;
        color: #A0A0A0;
    }

    .profile-img {
        width: 96px;
        height: 96px;
        margin: 0 auto 10px;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 25px;
        background-color: #253B51;
        color: white;
        text-align: center;
    }

    .jumbotron-cover-image {
        position: relative;
        /* background: #000 url("https://himpfencom.ams3.cdn.digitaloceanspaces.com/codepen-asset-hosting/yeshi-kangrang-276043-unsplash.jpg") center center;*/
        background: #000 url("<?php echo base_url(); ?>application/recursos/imagenes/jumbo3.jpg") center center;
        width: auto;
        height: 100%;
        background-size: cover;
        color: #fff;
    }

    #sticky {
        width: 100%;
        height: 54px;
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/menus.css">


<script>
    function myFunction(idButton) {
        var login = document.getElementById('login');
        var registrar = document.getElementById('registrar');
        var recuperar_clave = document.getElementById('recuperar_clave');
        var inicio = document.getElementById('inicio');


        switch (idButton) {
            case 1:
            login.style.display = 'block';
            registrar.style.display = 'none';
            recuperar_clave.style.display = 'none';
            inicio.style.display = 'none';
            break;

            case 2:
            login.style.display = 'none';
            registrar.style.display = 'block';
            recuperar_clave.style.display = 'none';
            inicio.style.display = 'none';
            break;

            case 3:
            login.style.display = 'none';
            registrar.style.display = 'none';
            recuperar_clave.style.display = 'block';
            inicio.style.display = 'none';
            break;

            case 4:
            login.style.display = 'none';
            registrar.style.display = 'none';
            recuperar_clave.style.display = 'none';
            inicio.style.display = 'block';
            break;

            default:
            alert("hay un problema: No existe la Ruta.")
        }

    }
</script>








<html>
<div class="loader"></div>
<!--
<body oncontextmenu='return false' background="<?php echo base_url(); ?>application/recursos/imagenes/jumbo1.png"
style="background-size: cover;"
    >-->

    <body oncontextmenu='return false'>


    <div class="container-fluid clearfix visible-lg" style="margin-top: -80px; position: fixed; width: 100%; z-index: 999;background-color: #FFFFF;">
        <!--position: fixed; width: 100%; z-index: 999;background-color: #FFFFF; -->
        <div class="col-sm-4"><img height="90" width="90" src="<?php echo base_url(); ?>application/recursos/imagenes/logo5.png"></div>
        <div class="col-sm-8" align="right">
            <p>&nbsp;</p>
            <a  href="#" onclick="myFunction(4)"><i class="fa fa-home"></i> Inicio </a>&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="myFunction(1)"><i class="fa fa-user"></i> Login</a>&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="myFunction(2)"><i class="fa fa-user-plus"></i> Registrarse</a>&nbsp;&nbsp;&nbsp;
        </div>
    </div>


    <div class="container-fulid clearfix visible-xs" style="box-shadow: 2px 2px 5px #666; margin-top: -90px;">
      <div class="container">
       <div style=" margin-top: 25px;">
         <img height="40" width="40" src="<?php echo base_url(); ?>application/recursos/imagenes/logo6.png">&nbsp;&nbsp;&nbsp;
         <a  href="#" onclick="myFunction(4)"><i class="fa fa-home"></i> Inicio </a>&nbsp;&nbsp;&nbsp;
         <a href="#" onclick="myFunction(1)"><i class="fa fa-user"></i> Login</a>&nbsp;&nbsp;&nbsp;
         <a href="#" onclick="myFunction(2)"><i class="fa fa-user-plus"></i> Registrarse</a>&nbsp;&nbsp;&nbsp;
     </div>
 </div>
 <br>
</div>

<!--
<div class="container-fluid clearfix visible-xs" style="margin-top: -80px; box-shadow: 2px 2px 10px #666;">
    <div class="col-sm-4"><img height="90" width="90" src="<?php echo base_url(); ?>application/recursos/imagenes/logo5.png"></div>
    <div class="col-sm-8" align="right">

    </div>
</div>
-->
    <!--<nav style="margin-top: -80px; box-shadow: 2px 2px 10px #666;">
        <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
        <ul class="menu">
            <li><a class="homer" href="#" onclick="myFunction(4)"><i class="fa fa-home"></i> SGC </a></li>
            <li><a href="#" onclick="myFunction(1)"><i class="fa fa-user"></i> Login</a></li>
            <li><a href="#" onclick="myFunction(2)"><i class="fa fa-user-plus"></i> Registrarse</a></li>

        </ul>
    </nav>-->
    <br>






    <div id="inicio" class="d-sm-none d-md-block">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo base_url(); ?>application/recursos/imagenes/J4.png" width="100%">
            </div>

            <div class="item">
                <img src="<?php echo base_url(); ?>application/recursos/imagenes/j2.png" width="100%">
            </div>

            <div class="item">
                <img src="<?php echo base_url(); ?>application/recursos/imagenes/j3.png" width="100%" </div> </div> <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><br><br>

            
             
                <div class="col-md-4">
                    <div class="panel panel-primary" style="box-shadow: 2px 2px 5px #666;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Informaci&oacute;n de Cuentas </strong></h3>
                        </div>
                        <div class="panel-body">
                            <p><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Javier La Cruz</p>
                            <p><i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727<p>
                                    <p><i class="fa  fa-envelope-o"></i> jlacruz@idsistemas15.com</p>
                                    <p><i class="fa fa-institution"></i> Banco Santander</p>
                                    <p><i class="fa fa-credit-card"></i> Cuenta Corriente: 123456789</p>

                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="panel panel-primary" style="box-shadow: 2px 2px 5px #666;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Bancos </strong></h3>
                        </div>
                        <div class="panel-body">
                            <div id="tabla_bancos_info"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary" style="box-shadow: 2px 2px 5px #666;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Tasas </strong></h3>
                            <p id="resultado"></p>
                        </div>
                        <div class="panel-body">
                            <div id="tabla_tasas"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12">&nbsp;</div>

                <div class="col-md-6" style="background:#2D475A">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><font color="white">Ubicaci&oacute;n </font></strong></h3>
                        </div>
                        <div class="panel-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.0634620639357!2d-70.6562347843862!3d-33.44765310475567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c509c9bc335f%3A0x235f7f1940030896!2sTarapac%C3%A1%201331%2C%20Santiago%2C%20Regi%C3%B3n%20Metropolitana!5e0!3m2!1ses!2scl!4v1570039159265!5m2!1ses!2scl" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    
                </div>
                <div class="col-md-6 visible-lg" style="background:#2D475A">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><font color="white">Facebook </font></strong></h3>
                        </div>
                        <div class="panel-body resp-container">
                            <iframe align="center" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FIdsistemas15-106227264137162%2F%3Fmodal%3Dadmin_todo_tour&tabs=timeline&width=1000&height=399&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=769752866793193" width="900" height="455" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    
                </div>
                <br><br>
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12"> &nbsp;</div>
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12"> &nbsp;</div>
            </div>
        </div>

</div>

<!--============================================== Login de Usuarios ================================================= -->
<div id="login" style="display:none;">
    <div class="container" style="margin-top:40px">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">

                <div class="panel-heading" align="center">
                    <strong> Sistema de Cambios</strong>
                </div>
                <div class="panel-body">
                    <form action='' name="formulario" id="formulario" method="post">
                        <fieldset>
                            <div class="row">
                                <div class="center-block" align="center">
                                    <img height="90" width="90" src="<?php echo base_url(); ?>application/recursos/imagenes/logo5.png">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                                <input class="form-control redondeado" id="usuario" name="usuario" type="text " placeholder="Usuario" onkeyup="javascript:this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Clave">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id='loader_login'></div>
                                        <div class="form-group">
                                            <button type="submit" id="ingresar" style="box-shadow: 2px 2px 10px #666; display:block;" class="btn bg-navy btn-block" onclick="myFunction(1)"><i class="fa fa-sign-in"></i>
                                            Ingresar</button>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" style="box-shadow: 2px 2px 10px #666;" class="btn bg-primary btn-block" onclick="myFunction(3)"><i class="fa fa-edit"></i>
                                            Olvide mi clave....!!!</button>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" id="ingresar_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(4)">
                                                <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--============================================== registro de Usuarios ================================================= -->
        <div id="registrar" style="display:none;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">&nbsp;</div>
                    <div class="col-sm-6">
                        <br>
                        <div class="panel-heading" align="center">
                            <strong> Registro de Usuario</strong>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="formulario_registro" action="">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Nombres:</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="nombres" class="form-control text-uppercase redondeado" id="nombres" onKeyPress="return soloLetras(event)" name="nombres" placeholder="Nombres" maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Apellidos:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-uppercase" id="apellidos" onKeyPress="return soloLetras(event)" name="apellidos" placeholder="Apellidos" maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd" align="left">Rut/Pasaporte:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-uppercase" id="rut_pasaporte"  name="rut_pasaporte" placeholder="Rut/Pasaporte" maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Usuario:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" onkeyup="javascript:this.value = this.value.toUpperCase()" placeholder="Nombre de Usuario" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Fono:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-uppercase" id="telefono" onKeyPress="return soloNumeros(event)" name="telefono" placeholder="Fono" maxlength="12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" onkeyup="javascript:this.value = this.value.toUpperCase()" id="correo" name="correo" placeholder="Correo El&eacute;ctronico" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Clave:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control text-uppercase" id="confirmar_clave" name="confirmar_clave" placeholder="Clave" maxlength="15">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Confirmar Clave:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control text-uppercase" id="clave" name="clave" placeholder="Confirmar Clave" maxlength="15">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn bg-navy btn-block" style="box-shadow: 2px 2px 10px #666; display:block;" id="registrar" onclick="myFunction(2)"><i class="fa fa-check"></i> Registrase</button>
                                        <button class="btn btn-primary btn-block" id="registrar_loader" style="box-shadow: 2px 2px 10px #666; display:none;" onclick="myFunction(4)">
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

            <!--============================================== recuperar clave  ================================================= -->
            <div id="recuperar_clave" style="display:none;">
                <div class="container" style="margin-top:40px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">

                            <div class="panel-heading" align="center">
                                <strong> Recuperar Clave</strong>
                            </div>
                            <div class="panel-body">
                                <form action='' name="recuperar_clave" id="recuperar_clave" method="post">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-envelope"></i>
                                                            </span>
                                                            <input class="form-control" id="correo_recuperar" name="correo_recuperar" type="text " placeholder="Email" onkeyup="javascript:this.value = this.value.toUpperCase()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id='loader_recuperar'></div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="button" id="verificar" style='display:block;' style="box-shadow: 2px 2px 10px #666;" class="btn bg-primary btn-block" onclick="event.preventDefault();"><i class="fa fa-search"></i>
                                                        Verificar</button>
                                                        <button type="submit" id="enviar" style='display:none;' style="box-shadow: 2px 2px 10px #666;" class="btn bg-navy btn-block"><i class="fa fa-check"></i>
                                                        Correo Verificado..!!! Enviar</button>
                                                        <button class="btn btn-primary btn-block" id="recuperar_loader" style="box-shadow: 2px 2px 10px #666; display:none;">
                                                            <i class="glyphicon glyphicon-refresh gly-spin"></i> Procesando....</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br>


                    <footer id="sticky">
                        <p>idsistemas15.com &nbsp;<i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp; 9 6417 4727 &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
                            <a class="btn btn-social-icon btn-instagram"><span class="fa fa-instagram"></span></a>
                            <a href='https://www.facebook.com/Idsistemas15-106227264137162/?modal=admin_todo_tour' class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a>
                            <a class="btn btn-social-icon btn-google"><span class="fa fa-google"></span></a>
                        </p>

                    </footer>

                </body>


                </html>











                <script>
    //validacion con boostrap

    $('#formulario').formValidation({
        framework: 'bootstrap',
        fields: {
            usuario: {
                row: '.col-md-12',
                validators: {
                    notEmpty: {
                        message: 'Nombre de Usuario Requerido'
                    }
                }
            },
            clave: {
                row: '.col-md-12',
                validators: {
                    notEmpty: {
                        message: 'La Clave es Requerida'
                    }
                }
            }

        }

    });

    //consultamos is el usuario existe en login
    $(document).on("blur", '#usuario', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {
                usuario: $('#usuario').val()
            },
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                console.log(respuesta);
                if (respuesta == 0) {
                    $('#usuario').val('');
                    alertify.error("El Usuario NO existe...!!!");

                }
            }
        });
    });
    //consultamos is el usuario existe para registro
    $(document).on("click", '#telefono', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {
                usuario: $('#usuario_registro').val()
            },
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                console.log(respuesta);
                if (respuesta == 1) {
                    $('#usuario_registro').val('');
                    alertify.error("Nombre de  Usuario NO disponible...!!!");

                }
            }
        });
    });
    
    $(document).on("click", '#correo', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {
                usuario: $('#usuario_registro').val()
            },
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                console.log(respuesta);
                if (respuesta == 1) {
                    $('#usuario_registro').val('');
                    alertify.error("Nombre de  Usuario NO disponible...!!!");

                }
            }
        });
    });

    $(document).on("blur", '#correo', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_correo2'; ?>",
            data: {
                correo: $('#correo').val()
            },
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                console.log(respuesta);
                if (respuesta == 1) {
                    $('#correo').val('');
                    alertify.error("Correo NO disponible...!!!");

                }
            }
        });
    });




    $(document).ready(function() {
        $("#verificar").click(function() {
            $.ajax({
                url: "<?php echo base_url() . 'index.php/administracion/consultar_correo_recuprar'; ?>",
                data: {
                    correo_recuperar: $('#correo_recuperar').val()
                },
                dataType: 'html',
                type: 'post',
                success: function(respuesta) {

                    console.log(respuesta);
                    if (respuesta == 0) {
                        $('#correo_recuperar').val('');
                        alertify.error("Correo NO registrado...!!!");
                        document.getElementById('enviar').style.display = 'none';
                        document.getElementById('verificar').style.display = 'block';

                    } else {
                        alertify.log("Correo Verificado...!!!");
                        document.getElementById('enviar').style.display = 'block';
                        document.getElementById('verificar').style.display = 'none';
                        document.getElementById('correo_recuperar').disabled = true;

                    }
                }
            });
        });
    });


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
</script>

<script>
    $(document).ready(function() {
        $('#formulario_registro').formValidation({
            fields: {
                cedula: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                correo: {
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
                usuario_registro: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                rol: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                nombres: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                apellidos: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                rut_pasaporte: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },

                confirmar_clave: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial
                        regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,12}$',
                            message: 'La contrase&ntilde;a debe contener m&iacute;nimo 6 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula, 1 min&uacute;sculas y 1 N&uacute;mero'
                        }
                    }
                },
                clave: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        identical: {
                            field: 'confirmar_clave',
                            message: 'Las contrase&ntilde;a deben ser iguales'
                        }
                    }
                }
            }


            //==============  registro de Usuario ======================================================          
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "registrar_usuario",
                method: 'POST',
                data: $form.serialize(),
                beforeSend: function() {
                    document.getElementById('registrar_loader').style.display = 'block';
                    document.getElementById('registrar').style.display = 'none';
                },
            }).success(function(response) {

                alertify.log("Se ha Registrado Exitosamente...!!");
                document.getElementById('registrar_loader').style.display = 'none';
                document.getElementById('registrar').style.display = 'block';
                myFunction(1)

            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('#formulario').formValidation({
            fields: {
             
             
                clave: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        identical: {
                            field: 'confirmar_clave',
                            message: 'Las contrase&ntilde;a deben ser iguales'
                        }
                    }
                }
            }


            //==============  login de Usuario ======================================================          
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "<?php echo base_url() . 'principal/login'; ?>",
                method: 'POST',
                beforeSend: function() {
                    document.getElementById('ingresar_loader').style.display = 'block';
                    document.getElementById('ingresar').style.display = 'none';
                },
                data: $form.serialize()
            }).success(function(response) {
                var user_rol = JSON.parse(response);
                //console.log(response);

                if (response != 0) {
                    // alert('entro');
                    // myFunction(2)
                    if (user_rol.rol == 1) {
                        location.href = '<?php echo base_url() . 'Transferencias/inicio'; ?>';
                        document.getElementById('ingresar').style.display = 'none';
                    } else {
                        location.href = '<?php echo base_url() . 'Transferencias/inicio'; ?>';
                        document.getElementById('ingresar').style.display = 'none';
                    }


                } else {
                    alertify.error("Datos de aceso incorrecto...!!!");
                    document.getElementById('ingresar_loader').style.display = 'none';
                    document.getElementById('ingresar').style.display = 'block';
                    $("#loader_login").hide();
                }

            });
        });
    });

    $("#recuperar_clave").submit(function(e) {
        
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        
        
        var dataUser = {
            "correo_recuperar": $("#correo_recuperar").val()
        };
        
        //alert(dataUser.correo_recuperar);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'principal/recuperarClave'; ?>",
            data: dataUser, // serializes the form's elements.
            beforeSend: function() {
                document.getElementById('recuperar_loader').style.display = 'block';
                document.getElementById('enviar').style.display = 'none';
                document.getElementById('verificar').style.display = 'none';
            },
            success: function(data) {
                alertify.log("Clave enviada al Email...!!!");
                document.getElementById("correo_recuperar").value = "";
                document.getElementById('enviar').style.display = 'none';
                document.getElementById('verificar').style.display = 'block';
                document.getElementById('correo_recuperar').disabled = false;
                document.getElementById('recuperar_loader').style.display = 'none';
                myFunction(1);
                $("#loader_recuperar").hide();

            }
        });
    });

    function leerBancos() {
        $.get("<?php echo base_url() . 'index.php/configuraciones/bancos_info'; ?>", {}, function(data, status) {
            var x = $("#tabla_bancos_info").html(data);
        });
    }
    $(document).ready(function() {
        leerBancos();
    });
    
    
    
    
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#tabla_tasas").load("<?php echo base_url() ?>index.php/Transferencias/tasas")
            .error(function() {
                alert("Error");
            });
        }, 1000);
        $.ajaxSetup({
            cache: false
        });
    });
    
    
    
</script>



<script>
    $(document).ready(function() {
        var touch = $('#resp-menu');
        var menu = $('.menu');

        $(touch).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });

        $(window).resize(function() {
            var w = $(window).width();
            if (w > 767 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });

    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
        '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

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


<script type="text/javascript">
    /* $(document).ready(function() {
    var refreshId = setInterval(function() {
      $("#valor").load("<?php echo base_url() ?>Configuraciones/tasa_vivo")
      .error(function() { alert("Error"); });
    }, 1000);
    $.ajaxSetup({ cache: false });        
});*/
</script>
<!--
https://developers.facebook.com/docs/plugins/page-plugin/
<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fecuanegos%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>





<div class='embedsocial-instagram' data-ref="29d552555ad18423467edd0a35b7bc971f11d494"></div><script>(function(d, s, id){var js; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "https://embedsocial.com/embedscript/in.js"; d.getElementsByTagName("head")[0].appendChild(js);}(document, "script", "EmbedSocialInstagramScript"));</script>

-->
