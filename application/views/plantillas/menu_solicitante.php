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
   <body >
      <?php if ($variablesSesion['rol'] == 1) { ?>
      <nav style="box-shadow: 2px 2px 10px #666;">
         <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
         <ul class="menu">
            <li><a  class="homer" href="<?php echo BASE_URL() ?>principal/dashboard" ><i class="fa fa-home"></i> SGC</a></li>
            </li>
            <li style="float: right;"><a href="#" id="salir"><span class="glyphicon glyphicon-log-in" ></span>&nbsp; Salir</a></li>
            <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar" data-toggle="tooltip" data-placement="top" class="navbar-link" ><span class="fa fa-wrench" ></span>&nbsp;
               <?php echo $variablesSesion['nombres'] . " " . $variablesSesion['apellidos'] ?></a>
            </li>
         </ul>
      </nav>
      <?php } ?>
    
   
       <?php if ($variablesSesion['rol'] == 4) { ?>
      <nav>
         <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
         <ul class="menu">
            <li><a  class="homer" href="<?php echo BASE_URL() ?>principal/bienvenida" ><i class="fa fa-home"></i> SAC</a></li>
            </li>
            <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Principal/logout"><span class="glyphicon glyphicon-log-in" ></span>&nbsp; Salir</a></li>
            <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Administracion/usuarioModificar" data-toggle="tooltip" data-placement="top" class="navbar-link" ><span class="fa fa-wrench" ></span>&nbsp;Usuario:
               <?php echo $variablesSesion['nombres'] . " " . $variablesSesion['apellidos'] ?></a>
            </li>
         </ul>
      </nav>
      <?php } ?>
 
      <script>
         $(document).ready(function(){ 
             var touch   = $('#resp-menu');
             var menu    = $('.menu');
          
             $(touch).on('click', function(e) {
                 e.preventDefault();
                 menu.slideToggle();
             });
             
             $(window).resize(function(){
                 var w = $(window).width();
                 if(w > 767 && menu.is(':hidden')) {
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
           var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
           ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
         
      </script>
      <script>
        

$(document).ready(function() {
    $("#salir").click(function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/principal/logout'; ?>",
            dataType: 'html',
            type: 'post',
            beforeSend: function () {
				$("#loader_login").show();
				$('#loader_login').html('<div id="loading-wrapper"><div id="loading-text"></div><div id="loading-content"></div></div>')
			},
            success: function(respuesta) {

                console.log(respuesta);
                location.href = '<?php echo base_url().'Principal'; ?>';
                
            }
        });
    });
});

</script>
   </body>
</html>


