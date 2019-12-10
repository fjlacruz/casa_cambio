<br>
<style>
.scroll {
    height: 350px;
    overflow-y: scroll;
    width: auto;
}
</style>

<input class="form-control" id="myInput2" type="text" placeholder="Filtrar Caja..">
<div class="scroll">
<table class="table table-hover table-striped visible-lg" id="tblDatos" ><br>
    <thead >
        <tr>
            <th align='justify'>Banco</th>
            <th align='justify'>Monto Apertura (Bs)</th>
            <th align='justify'>Monto transferido (Bs)</th>
            <th align='justify'>Caja (Bs)</th>
            <th align='justify'>Estatus</th>
            <th align='justify'>Fecha Apertura</th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable2'>";
    if ($cajas) {
        foreach ($cajas as $caja) {
            $id_caja = $caja->id_caja;
            $id_banco = $caja->id_banco;
            $nombre_banco = $caja->nombre_banco;
            $monto_apertura = $caja->monto_apertura;
            $monto_transferido = $caja->monto_transferido;
            $estatus = $caja->estatus;
            $id_usuario = $caja->id_usuario;
            $usuario = $caja->usuario;
            $fecha_registro = $caja->fecha_registro;
            $saldo=ABS($monto_apertura-$monto_transferido);

            echo "
        <tr align='right'> 
        <td align='justify'>" . $nombre_banco . "</td>
        <td align='justify'>" . number_format($monto_apertura, 2, ',', '.') . "</td>
        <td align='justify'>" . number_format($monto_transferido, 2, ',', '.') . "</td>
        <td align='justify'>" . number_format($saldo, 2, ',', '.') . "</td>
        <td align='justify'>" . $estatus . "</td>
        <td align='justify'>" . $fecha_registro . "</td>

        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-xs'>
    No hay cajas agreagadas.....
  </div>";
    }
    echo "<tbody>";
    ?>
   
</table>



<table class="table table-hover table-striped visible-xs" id="tblDatos" ><br>
    
    <?php
    echo "<tbody  id='myTable2'>";
    if ($cajas) {
        foreach ($cajas as $caja) {
            $id_caja = $caja->id_caja;
            $id_banco = $caja->id_banco;
            $nombre_banco = $caja->nombre_banco;
            $monto_apertura = $caja->monto_apertura;
            $monto_transferido = $caja->monto_transferido;
            $estatus = $caja->estatus;
            $id_usuario = $caja->id_usuario;
            $usuario = $caja->usuario;
            $fecha_registro = $caja->fecha_registro;
            $saldo=ABS($monto_apertura-$monto_transferido);
          

            echo "
        <tr align='right'> 
        <td align='right'>Banco: ". $nombre_banco . "<br>Monto apertura(Bs): " . $monto_apertura . "<br>Monto transferido(Bs): " . $monto_transferido . "<br>Caja: " . $saldo . "<br>Caja: " . $estatus ."<br>Fecha: " . $fecha_registro ."</td>";
        }
    } else {
        echo "<div class='alert alert-warning visible-lg'>
    No hay cajas agreagadas.....
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

