<br>
<style>
.scroll {
    /* definir una altura peque単a para forzar el scroll */
    height: 350px;
    overflow-y: scroll;
    width: auto;

}
</style>

<input class="form-control" id="myInput2" type="text"  placeholder="Filtrar Solicitudes..">
<div class="scroll">
<table class="table table-hover table-striped clearfix visible-lg" id="tblDatos"><br>
    <p>&nbsp;&nbsp;&nbsp;<strong><span class="label label-default" style='box-shadow: 2px 2px 5px #666;'>Solicitudes Realizadas</span></strong></p>
    <thead>
        <tr>
            <th align='justify'>Ref.</th>
            <th align='justify'>Fecha</th>
            <th align='justify'>Monto</th>
            <th align='justify'>Destinatario</th>
            <th align='justify'>Operaci&oacute;n</th>
            <th align='justify'>Estatus</th>
            <th align='justify'>Adjunto</th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable2'>";
    if ($solicitudes) {
        foreach ($solicitudes as $solicitud) {
            $id_transferencia = $solicitud->id_transferencia;
            $id_cuenta = $solicitud->id_cuenta;
            $id_usuario = $solicitud->id_usuario;
            $nombres = $solicitud->nombres;
            $apellidos = $solicitud->apellidos;
            $id_pais = $solicitud->id_pais;
            $nombre_pais = $solicitud->nombre_pais;
            $monto_pesos = $solicitud->monto_pesos;
            $tasa = $solicitud->tasa;
            $estatus = $solicitud->estatus;
            $fecha_registro = $solicitud->fecha_registro;
            $monto_a_transferir = $solicitud->monto_a_transferir;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $adjunto_resp = $solicitud->adjunto_resp;
            $tipo_operacion = $solicitud->tipo_operacion;
            $monto_a_transferir_convert = number_format($monto_a_transferir, 2, ',', '.');
            if(($adjunto_resp=='') || ($adjunto_resp==NULL)){
                $adj='<span tooltip="Ver Adjunto" flow="left"><button style="box-shadow: 2px 2px 5px #666;" type="button" data-id="'.$id_transferencia.'" onclick="myFunction(6)" class="btn bg-navy btn-xs detalle_adjunto">
                <span class="fa  fa-search"></span>
                </button></span>';
            }else{
                $adj='<span tooltip="Ver Adjunto" flow="left"><button style="box-shadow: 2px 2px 5px #666;" type="button" data-id2="'.$id_transferencia.'" onclick="myFunction(6)" class="btn btn-primary btn-xs detalle_adjunto_resp" >
                <span class="fa  fa-search"></span>
                </button></span>';
            }

            if($estatus=='CANCELADO'){
              $est='<td align="justify">' .'<span class="label label-danger">'. $estatus . '</span>'.'</td>';
            }elseif($estatus=='ENVIADO'){
                $est='<td align="justify">' .'<span class="label label-warning">'. $estatus . '</span>'.'</td>';  
            }
            elseif($estatus=='RECIBIDO'){
                $est='<td align="justify">' .'<font color="blue">'. $estatus . '</font>'.'</td>';  
            }
            
            else{
                $est='<td align="justify">' .'<span class="label label-success">'. $estatus . '</span>'.'</td>';  
            }

            echo "
        <tr align='right'> 
        <td align='right'>" ."Reft-". $id_transferencia . "</td>      
        <td align='justify'>" . $fecha_registro . "</td>
        <td align='justify'>" . $monto_a_transferir_convert ." Bs". "</td>
        <td align='justify'>" . $nombres_apellidos . "</td>
        <td align='justify'>" . $tipo_operacion . "</td>
        $est
        <td align='center'>
             $adj
          
            </td>
        </tr>";
        }
    } else {
        echo "<br><div class='alert alert-warning clearfix visible-lg'>
    No posee Solicitudes registradas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='myFunction(1)' class='alert-link'>Registrar Solicitud</a>.
  </div>";
    }
    echo "<tbody>";
    ?>
</table>

<table class="table table-hover table-striped clearfix visible-xs" id="tblDatos"><br>
    <thead>
        <tr>
            <th align='justify'>Ref.</th>
            <th align='justify'>Adjunto</th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable2'>";
    if ($solicitudes) {
        foreach ($solicitudes as $solicitud) {
            $id_transferencia = $solicitud->id_transferencia;
            $id_cuenta = $solicitud->id_cuenta;
            $id_usuario = $solicitud->id_usuario;
            $nombres = $solicitud->nombres;
            $apellidos = $solicitud->apellidos;
            $id_pais = $solicitud->id_pais;
            $nombre_pais = $solicitud->nombre_pais;
            $monto_pesos = $solicitud->monto_pesos;
            $tasa = $solicitud->tasa;
            $estatus = $solicitud->estatus;
            $fecha_registro = $solicitud->fecha_registro;
            $monto_a_transferir = $solicitud->monto_a_transferir;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $adjunto_resp = $solicitud->adjunto_resp;
            $tipo_operacion = $solicitud->tipo_operacion;
            $monto_a_transferir_convert = number_format($monto_a_transferir, 2, ',', '.');
            if(($adjunto_resp=='') || ($adjunto_resp==NULL)){
                $adj='<span tooltip="Ver Adjunto" flow="left"><button style="box-shadow: 2px 2px 5px #666;" type="button" data-id="'.$id_transferencia.'" onclick="myFunction(6)" class="btn bg-navy btn-lg detalle_adjunto">
                <span class="fa  fa-search"></span>
                </button></span>';
            }else{
                $adj='<span tooltip="Ver Adjunto" flow="left"><button style="box-shadow: 2px 2px 5px #666;" type="button" data-id2="'.$id_transferencia.'" onclick="myFunction(6)" class="btn btn-primary btn-lg detalle_adjunto_resp" >
                <span class="fa  fa-search"></span>
                </button></span>';
            }

            if($estatus=='CANCELADO'){
              $est='<span class="label label-danger">'. $estatus . '</span>';
            }elseif($estatus=='ENVIADO'){
                $est='<span class="label label-warning">'. $estatus . '</span>';  
            }
            elseif($estatus=='RECIBIDO'){
                $est='<font color="blue">'. $estatus . '</font>';  
            }
            
            else{
                $est='<span class="label label-success">'. $estatus . '</span>';  
            }

            echo "
        <tr align='right'> 
        <td align='right'>" ."Reft ". $id_transferencia . " / " . $fecha_registro . "<br>" . $monto_a_transferir_convert ." Bs". "<br>" . $nombres_apellidos . "<br>" . $est. "</td>      
        <td align='center'>
             $adj
          
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning clearfix visible-xs'>
    No posee Solicitudes registradas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='myFunction(1)' class='alert-link'>Registrar Solicitud</a>.
  </div>";
    }
    echo "<tbody>";
    ?>
</table>
</div>
<br>


<script>

    $('.detalle_adjunto').on('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/transferencias/verAdjunto/'; ?>" + id,
            method: 'GET',
            beforeSend: function() {
                $("#cargando").html('<img src="<?php echo base_url(); ?>application/recursos/imagenes/loader1.gif">');
                },

        }).success(function(data) {

            $("#transferencias_adjunto").html(data);
            $("#cargando").html('');
        });
    });

    $('.detalle_adjunto_resp').on('click', function() {
        var id = $(this).attr('data-id2');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/transferencias/verAdjunto_respuesta/'; ?>" + id,
            method: 'GET',
            beforeSend: function() {
                $("#cargando2").html('<img src="<?php echo base_url(); ?>application/recursos/imagenes/loader1.gif">');
                },

        }).success(function(data) {

            $("#transferencias_adjunto").html(data);
            $("#cargando2").html('');
        });
    });

    $(document).ready(function() {
        $("#myInput2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable2 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

