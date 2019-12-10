<meta name="theme-color" content="#F0DB4F">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="./img/ProgramadorFitness.png">
  <link rel="apple-touch-icon" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes/ProgramadorFitness.png">
  <link rel="apple-touch-startup-image" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes//ProgramadorFitness.png">
  <link rel="manifest" href="https://sac-jlacruz.c9users.io/manifest.json">
<style type="text/css">
    .Estilo1 {font-size: 11px}

    .Estilo2 {font-size: 9px}
    
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    
    td {
    text-align: center;
    }


</style>




<section class="content">
    <form id='formulario' method="post" action="imprimirPDF">
    <div class="box box-danger">
        <div class="box-header with-border">
             <?php 
          foreach($resultado as $datosDetalle)
           {
          ?>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-sm-12" align="center" class='Estilo1'>Comprobante de Egreso Nro: <?php echo $datosDetalle->id_egreso?> </div>
                  <div class="form-group col-sm-12">
                      
                       <table class="table table-bordered " cellspacing="0" width="100%" >
                            
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Comunidad</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Per&iacute;odo</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">A&ntilde;o</td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->nombre_comunidad?></td> 
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->periodo?>
                            </td>   
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->anio?></td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Proveedor</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Motivo</td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->proveedor?></td> 
                            <td class="text-center" class='Estilo1'>$<?php echo $monto= number_format($datosDetalle->monto, 2, ',', '.');?></td>   
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->motivo?></td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cuenta</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Item</td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->nro_cheque?></td> 
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->cuenta?></td>   
                            <td class="text-center" class='Estilo1'><?php echo $datosDetalle->item?></td> 
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3" colspan='2'>Descripci&oacute;n Item</td>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3" >Fecha de Registro</td>
                        </tr>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2' ><?php echo $datosDetalle->descripcion_item?></td>
                            <td class="text-center" class='Estilo1'  ><?php echo $datosDetalle->fecha_registro?></td> 
                        </tr>
                            <tbody>                  
                            </tbody>
                        </table> 
                  </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
     }
      ?>
      </form>
</section>



 




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





















