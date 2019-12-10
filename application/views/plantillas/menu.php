<style>
   .tooltip {
      position: relative;
      display: inline-block;
      border-bottom: 1px dotted black;
   }

   .tooltip .tooltiptext {
      visibility: hidden;
      width: 120px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      /* Position the tooltip */
      position: absolute;
      z-index: 1;
   }

   .tooltip:hover .tooltiptext {
      visibility: visible;
   }


   .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      opacity:0.9;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
   }

   .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 15px;
      color: #818181;
      display: block;
      transition: 0.3s;
   }

   .sidenav a:hover {
      color: #f1f1f1;
   }

   .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
   }

   @media screen and (max-height: 450px) {
      .sidenav {
         padding-top: 15px;
      }

      .sidenav a {
         font-size: 14px;
      }

   }
</style>
<?php
$variablesSesion = $this->session->userdata('usuario');
//print_r($variablesSesion);
if ($variablesSesion == "") {
   redirect('principal/session');
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/menu.css">
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
   <div class="clearfix visible-lg">
      <?php if ($variablesSesion['rol'] == 1) { ?>
         <nav style="box-shadow: 2px 2px 10px #666;">
            <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
            <ul class="menu">
               <li><a class="homer" href="#"><i class="fa fa-home"></i> SGC</a></li>
               </li>
               <li style="float: right;"><a href="#" id="salir"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Salir</a></li>
               <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar" data-toggle="tooltip" data-placement="top" class="navbar-link"><span class="fa fa-wrench"></span>&nbsp;
                     <?php echo $variablesSesion['nombres'] . " " . $variablesSesion['apellidos'] ?></a>
               </li>
            </ul>
         </nav>
      <?php } ?>


      <?php if ($variablesSesion['rol'] == 2) { ?>
         <nav style="box-shadow: 2px 2px 10px #666;">
            <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
            <ul class="menu">
               <li><a class="homer" href="<?php echo BASE_URL() ?>transferencias/inicio"><i class="fa fa-home"></i> Inicio</a></li>
               </li>
               <li style="float: right;"><a href="#" id="salir"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Salir</a></li>
               <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar" data-toggle="tooltip" data-placement="top" class="navbar-link"><span class="fa fa-wrench"></span>&nbsp;
                     <?php echo $variablesSesion['nombres'] . " " . $variablesSesion['apellidos'] ?></a>
               </li>
            </ul>
         </nav>
      <?php } ?>
   </div>


   <div class="container-fulid clearfix visible-xs" style="background-color: #253B51; box-shadow: 2px 2px 5px #666;">
      <div class="container">
         <div style=" margin-top: 25px;">
            <font color="white"><i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp;+56 9 6417 4727</font>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
            <a class="btn btn-social-icon btn-instagram"><span class="fa fa-instagram"></span></a>
            <a class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a>
            <a class="btn btn-social-icon btn-google"><span class="fa fa-google"></span></a>
         </div>
      </div>
      <br>
   </div>
   <br>
   <div class="container clearfix visible-xs">
      <div id="mySidenav" class="sidenav">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
         <a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar"><span class="fa fa-wrench"></span>&nbsp; Mi Usuario</a>
         <a href="<?php echo base_url() ?>index.php/principal/logout" id="salir"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Salir</a>
   
      </div>


      <span style="font-size:18px;cursor:pointer;" onclick="openNav()">&#9776; SGC </span>
   </div>
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
         ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
         var s = document.getElementsByTagName('script')[0];
         s.parentNode.insertBefore(ga, s);
      })();
   </script>
   <script>
      $(document).ready(function() {
         $("#salir").click(function() {
            $.ajax({
               url: "<?php echo base_url() . 'index.php/principal/logout'; ?>",
               dataType: 'html',
               type: 'post',
               beforeSend: function() {
                  $("#loader_login").show();
                  $('#loader_login').html('<div id="loading-wrapper"><div id="loading-text"></div><div id="loading-content"></div></div>')
               },
               success: function(respuesta) {

                  console.log(respuesta);
                  location.href = '<?php echo base_url() . 'Principal'; ?>';

               }
            });
         });
      });
   </script>


   <script>
      function openNav() {
         document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
      }
   </script>
</body>

</html>