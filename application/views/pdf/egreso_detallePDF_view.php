

<?php
$fecha=date('d-m-Y');
if($periodo==1){
   $periodo_des='ENERO';
    }
if($periodo==2){
   $periodo_des='FRBRERO';
    }
    if($periodo==3){
   $periodo_des='MARZO';
    }
    if($periodo==4){
   $periodo_des='ABRIL';
    }
    if($periodo==5){
   $periodo_des='MAYO';
    }if($periodo==6){
   $periodo_des='JUNIO';
    }
    if($periodo==7){
   $periodo_des='JULIO';
    }
    if($periodo==8){
   $periodo_des='AGOSTO';
    }
    if($periodo==9){
   $periodo_des='SEPTIEMBRE';
    }
    if($periodo==10){
   $periodo_des='OCTUBRE';
    }
    if($periodo==11){
   $periodo_des='NOVIEMBRE';
    }
    if($periodo==12){
   $periodo_des='DICIRMBRE';
    }

?>


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


<br/><br/>
<p align='center'><strong>INFORME GASTOS COMUNES AL MES <?php echo $periodo_des;?>-<?php echo $anio;?></strong></p>
<p align='center'><strong> <?php
            foreach($comunidad2 as $resultado)
            {
            ?>
             COMUNIDAD:<?php echo $resultado->nombre_comunidad?><br>
             DIRECCI&Oacute;N:<?php echo $resultado->direccion?><br>
             FONO:<?php echo $resultado->telefono?>
             <?php
            }
            ?>
</strong></p>
<br/><br/>

 <table width="100%" border='1' >
     <tr align='center'>
        <td class="text-center" bgcolor="#B6D6E3">REMUNERACIONES</td> 
     </tr>
 </table>
     
     
      <table class="table table-bordered " cellspacing="0" width="100%" >
                            
                        <tr align='center'>
                            
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                 
                           
                        </tr>
                        
                            <?php
                            
                            if ($gastos_admnistracion != "") {
                            $contenido = "";
                            foreach ($gastos_admnistracion as $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2' bgcolor="#DEEDF3"></td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Sub-Total</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3"><?php
                                   foreach($suma_adminstracion as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table> 
                       
                        



                         <br>
                        <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">OTRAS REMUNERACIONES</td> 
                         </tr>
                          </table>

                 <table class="table table-bordered " cellspacing="0" width="100%" >
                            
                        <tr align='center'>
                            
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                 
                           
                        </tr>
                        
                            <?php
                            
                            if ($gastos_varios != "") {
                            $contenido = "";
                            foreach ($gastos_varios as $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_varios as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table> 
 
                        <br>
                        <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">ADMINISTRACI&Oacute;N</td> 
                         </tr>
                          </table>
                          
                          <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                           <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($gastos_mantencion != "") {
                            $contenido = "";
                            foreach ($gastos_mantencion as $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_mantencion as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table> 
                        
                         <br>
                        <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">MANTENCI&Oacute;N Y REPARACI&Oacute;N</td> 
                         </tr>
                          </table>
                           <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($gastos_comun != "") {
                            $contenido = "";
                            foreach ($gastos_comun as  $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_comun as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table> 
                        
                        <br>
                        <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">GASTOS SERVICIOS B&Aacute;SICOS</td> 
                         </tr>
                          </table>
                           <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($gastos_serv_bas != "") {
                            $contenido = "";
                            foreach ($gastos_serv_bas as  $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_serv_basicos as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table>
                        <BR>
                            
                            
                            <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">GASTOS GENERALES</td> 
                         </tr>
                          </table>
                           <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($gastos_gen != "") {
                            $contenido = "";
                            foreach ($gastos_gen as  $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_gastos_gen as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table>
                            <BR>
                            
                        <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">GASTOS SERVICIOS Y SEGUROS</td> 
                         </tr>
                          </table>
                           <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($servicios_seguros != "") {
                            $contenido = "";
                            foreach ($servicios_seguros as  $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($sum_servicios_seguros as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table>        
                            <BR>
                         <table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">OTROS RUBROS</td> 
                         </tr>
                          </table>
                           <table class="table table-bordered " cellspacing="0" width="100%" >
                        <tr align='center'>
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Nro Egreso</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Detalle</td>   
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Cheque</td> 
                            <td class="text-center" class='Estilo1' bgcolor="#DEEDF3">Monto</td>
                        </tr>
                        
                            <?php
                            
                            if ($otros_rubros != "") {
                            $contenido = "";
                            foreach ($otros_rubros as  $resultado) {
                                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');

                            $contenido.="<tr>      

                               <td align='center' class='Estilo1'>" . "$resultado->id_egreso" . "</td>
                               <td align='justify' class='Estilo1'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center' class='Estilo1'>" .  "$resultado->nro_cheque" . "</td>
                               <td align='center' class='Estilo1'>". "$" .  "$nombre_format_francais" . "</td>     
                                
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                           
                            <tbody>                  
                                 <?php
                                 echo $contenido;
                                 ?>
                                   <tr align='center'>
                            <td class="text-center" class='Estilo1' colspan='2'></td> 
                            <td class="text-center" class='Estilo1'>Sub-Total</td> 
                            <td class="text-center" class='Estilo1'><?php
                                   foreach($suma_rubros as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></td>
                        </tr>
                            </tbody>
                        </table>         
                            
                            
                            
                           <BR><BR>  
                       <table class="table table-bordered " cellspacing="0" width="100%" >
                            <tr align='center'>
                            <td class="text-center" colspan='3' bgcolor="#B6D6E3"><strong>TOTAL GENERAL DE GASTOS DEL PER&iacute;ODO:</strong></td> 
                         
                            <td class="text-center" class='Estilo1' bgcolor="#B6D6E3"><strong><?php
                                   foreach($suma_egreso_periodo as $fila)
                          $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                         {
                        ?>
                   
                         <?php echo '$' . $nombre_format_francais?>
                        
                        
                        <?php
                         }
                        ?></strong></td>
                        </tr>
                        </table>
                         

<br><br>
<table width="100%" border='1' >
                        <tr align='center'>
                           <td class="text-center" bgcolor="#B6D6E3">INFORMACI&Oacute;N PARA LA COMUNIDAD</td> 
                         </tr>
                          </table>
 <table class="display" cellspacing="0" width="100%" >

        <?php
        if ($informacion != "") {
           $contenido = "";
           foreach ($informacion as $resultado) {
            $contenido.="<tr>      
            <td align='center'>" .  "$resultado->informacion" . "</td>
            </tr>";
        }
    } else {
      $contenido = '
      </div>
      <div class="alert alert-danger">
      <strong>No se Encontraron datos para esta busquedad!</strong>
      <a class="alert-link" href="#">Volver a consultar.</a>
      </div>';
  }
  ?>

  <tbody>                  
    <?php echo $contenido;?>    
</tbody>
</table>







