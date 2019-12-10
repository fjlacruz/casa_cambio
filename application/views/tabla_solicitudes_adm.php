<br>
<style>
.scroll {
    /* definir una altura peque単a para forzar el scroll */
    height: 350px;
    overflow-y: scroll;
    width: auto;

}
</style>

<!--<input class="form-control" id="myInput2" type="text" placeholder="Filtrar Solicitudes..">-->
<div class="scrollxxx">
<table class="table table-hover table-striped visible-lg" id="tblDatos" ><br>
    <thead >
        <tr>
            <th align='justify'>Ref.</th>
            <th align='justify'>Fecha</th>
            <th align='justify'>Monto</th>
            <th align='justify'>Destinatario</th>
            <th align='justify'>Procesar</th>
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
           // $estatus = $solicitud->estatus;
            $fecha_registro = $solicitud->fecha_registro;
            $monto_a_transferir = $solicitud->monto_a_transferir;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $adjunto_resp = $solicitud->adjunto_resp;
            $monto_a_transferir_convert = number_format($monto_a_transferir, 2, ',', '.');
            $id_banco = $solicitud->id_banco;
            $nombre_banco = $solicitud->nombre_banco;
            $banco_saldo=$this->Transferencias_model->verificar_saldo($id_banco);
            if($banco_saldo){
            foreach($banco_saldo as $saldo_banco){
                $saldo=$saldo_banco->saldo;
                //echo $saldo;
            }
            if($saldo<$monto_a_transferir){
                 $boton_transferencia="Fondo insuficiente"; 
            }else{
                $boton_transferencia="<span tooltip='Procesar Transferencias' flow='left'><button type='button' data-id='$id_transferencia' onclick='myFunction(2); limpiarForm();' class='btn bg-navy btn-xs detalle_adjunto'>
            <span class='fa  fa-edit'></span>
            </button></span>";
             }
            }else{
                $boton_transferencia="Fondo insuficiente";
            }

            echo "
        <tr align='right'> 
        <td align='right'>" ."Reft-". $id_transferencia . "</td>      
        <td align='justify'>" . $fecha_registro . "</td>
        <td align='justify'>" . $monto_a_transferir_convert ." Bs". "</td>
        <td align='justify'>" . $nombres_apellidos ." <br>". $nombre_banco . "</td>
        <td align='center'>
        $boton_transferencia
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-xs'>
    No posee hay Solicitudes Pendientes.....
  </div>";
    }
    echo "<tbody>";
    ?>
   
</table>



<table class="table table-hover table-striped visible-xs" id="tblDatos" ><br>
    
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
           // $estatus = $solicitud->estatus;
            $fecha_registro = $solicitud->fecha_registro;
            $monto_a_transferir = $solicitud->monto_a_transferir;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $adjunto_resp = $solicitud->adjunto_resp;
            $monto_a_transferir_convert = number_format($monto_a_transferir, 2, ',', '.');
            $id_banco = $solicitud->id_banco;
            $nombre_banco = $solicitud->nombre_banco;
            $banco_saldo=$this->Transferencias_model->verificar_saldo($id_banco);
            if($banco_saldo){
            foreach($banco_saldo as $saldo_banco){
                $saldo=$saldo_banco->saldo;
            }
            if($saldo<$monto_a_transferir){
                 $boton_transferencia="Fondo insuficiente"; 
            }else{
                $boton_transferencia="<span tooltip='Procesar Transferencias' flow='left'><button type='button' data-id='$id_transferencia' onclick='myFunction(2); limpiarForm();' class='btn bg-navy btn-lg detalle_adjunto'>
            <span class='fa  fa-edit'></span>
            </button></span>";
             }
            }else{
                $boton_transferencia="Fondo insuficiente";
            }
          

            echo "
        <tr align='right'> 
        <td align='right'>" ."Reft-". $id_transferencia . "/ " . $fecha_registro . "<br>" . $monto_a_transferir_convert . " Bs". "<br>" . $nombres_apellidos ."<br>" . $nombre_banco . "</td>      

        <td align='center'>
            $boton_transferencia
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-lg'>
    No posee hay Solicitudes Pendientes.
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

        }).success(function(resp) {
            $("#transferencias_adjuntos").html(resp);
            $("#cargando").html('');
        });
    });



    $('.detalle_adjunto').on('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/transferencias/verDetatlle_Solicitud/'; ?>" + id,
            method: 'GET'

        }).success(function(data) {

            var obj1 = JSON.parse(data); //parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")"); // limpiamos el json
            
            const formatter = new Intl.NumberFormat('it-IT', {
            minimumFractionDigits: 2
            });
            
            $('#userForm')
            $("#nombre_pais").html('<strong>Pais Origen:</strong> ' + obj[0].nombre_pais);
            $("#depositante").html('<strong>Deposintante:</strong> ' + obj[0].nombres + ' ' + obj[0].apellidos);
            $("#telefono").html('<strong>Tel&eacute;fono:</strong> ' + obj[0].telefono);
            $("#correo").html('<strong>Correo Deposintate: </strong> ' + obj[0].correo);
            $("#destinatario").html('<strong>Desatinatario: </strong> ' + obj[0].nombres_apellidos);
            $("#identificacion").html('<strong>C&eacute;dula/Rif:</strong> ' + obj[0].identificacion + '-' + obj[0].cedula_titular);
            $("#email").html('<strong>Correo Destinatrio: </strong> ' + obj[0].email);
            $("#banco").html('<strong>Banco:</strong> ' + obj[0].nombre_banco);
            $("#cuenta_tipo").html('<strong>Cuenta/Tipo: </strong> ' + obj[0].nro_cuenta + ' / ' + obj[0].tipo_cuenta); 
            $("#monto_pesos").html('<strong>Monto Transferido por depositante:</strong> ' + formatter.format(obj[0].monto_pesos)); 
            $("#tasa").html('<strong>Tasa:</strong> ' + obj[0].tasa); 
            $("#monto_a_transferir").html('<strong>Monto a transferir segun tasa:</strong> ' + formatter.format(obj[0].monto_a_transferir) + ' Bs');
            $("#fecha_registro").html('<strong>Fecha: </strong> ' + obj[0].fecha_registro); 
            $('[name="id_transferencia"]').val(obj[0].id_transferencia);
            $('[name="id_banco"]').val(obj[0].id_banco);
            $('[name="monto_a_transferir"]').val(obj[0].monto_a_transferir);
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

