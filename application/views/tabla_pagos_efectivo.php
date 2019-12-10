<br>
<style>
.scroll {
    /* definir una altura peque単a para forzar el scroll */
    height: 250px;
    overflow-y: scroll;
    width: auto;

}
</style>
<br>
<input class="form-control" id="myInput2" type="text" placeholder="Filtrar Solicitudes..">
<div class="scroll">
<table class="table table-hover table-striped visible-lg" id="tblDatos" ><br>
    <thead >
        <tr>
            <th align='justify'>Titular</th>
            <th align='justify'>C&eacute;dula</th>
            <th align='justify'>Banco</th>
            <th align='justify'>Transferir</th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable2'>";
    if ($pagosEfevtivo) {
        foreach ($pagosEfevtivo as $solicitud) {
            $id_cuenta = $solicitud->id_cuenta;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $nombre_banco = $solicitud->nombre_banco;
            $cedula_titular = $solicitud->cedula_titular;
            $identificacion = $solicitud->identificacion;

            echo "
        <tr align='right'> 
        <td align='right'>".$nombres_apellidos."</td>   
        <td align='right'>".$identificacion."-".$cedula_titular."</td>   
        <td align='right'>".$nombre_banco."</td> 

        <td align='center'>
        <span tooltip='Transferir' flow='left'><button type='button' data-id='$id_cuenta' onclick='myFunction(2)' class='btn bg-navy btn-xs editButton'>
            <span class='fa  fa-edit'></span>
            </button></span>
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-lg'>
    No Existen Registros en este periodo.
  </div>";
    }
    echo "<tbody>";
    ?>
   
</table>


<table class="table table-hover table-striped visible-xs" id="tblDatos" ><br>
    <thead >
        <tr>
            <th align='justify'>Titular</th>
            <th align='justify'>Transferir</th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable2'>";
    if ($pagosEfevtivo) {
        foreach ($pagosEfevtivo as $solicitud) {
            $id_cuenta = $solicitud->id_cuenta;
            $nombres_apellidos = $solicitud->nombres_apellidos;
            $nombre_banco = $solicitud->nombre_banco;
            $cedula_titular = $solicitud->cedula_titular;
            $identificacion = $solicitud->identificacion;

            echo "
        <tr align='right'> 
        <td align='right'>". $nombres_apellidos ."<br>". $identificacion ."-" .$cedula_titular."<br>". $nombre_banco."</td>      
        <td align='center'>
        <span tooltip='Transferir' flow='left'><button type='button' data-id='$id_cuenta' onclick='myFunction(2)' class='btn bg-navy btn-lg detalle_adjunto_historico'>
            <span class='fa  fa-money'></span>
            </button></span>
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-xs'>
    No Existen Registros en este periodo.
  </div>";
    }
    echo "<tbody>";
    ?>
   
</table>
</div>
<br>


<script>

    $('.editButton').on('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Transferencias/consultar_cuenta_id/'; ?>" + id,
            method: 'GET'

        }).success(function(data) {

            var obj1 = JSON.parse(data); //parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")"); // limpiamos el json
            console.log(obj);
            $('#userForm')
            $('[name="id_cuenta"]').val(obj.id_cuenta);
            $('[name="cuenta_id"]').val(obj.id_cuenta);
            $('[name="id_usuario"]').val(obj.id_usuario);
            $('[name="id_banco_edit"]').val(obj.id_banco);
            $('[name="banco_id"]').val(obj.id_banco);
            $('[name="tipo_cuenta_edit"]').val(obj.tipo_cuenta);
            $('[name="identificacion_edit"]').val(obj.identificacion);
            $('[name="cedula_titular_edit"]').val(obj.cedula_titular);
            $('[name="nombres_apellidos_edit"]').val(obj.nombres_apellidos);
            $('[name="email_edit"]').val(obj.email);
            $('[name="estatus_edit"]').val(obj.estatus);
            $('[name="id_usuario_edit"]').val(obj.id_usuario);
            $('[name="fecha_registro_edit"]').val(obj.fecha_registro);
            $('[name="nro_cuenta_edit"]').val(obj.nro_cuenta);

            $("#titular").html(obj.nombres_apellidos);
            $("#cedula").html(obj.identificacion + '-' + obj.cedula_titular);
            $("#nombre_banco").html(obj.nombre_banco);
            $("#cuentaNro").html(obj.nro_cuenta);
            $("#cuenta").html(obj.tipo_cuenta);
            $("#correo").html(obj.email);
            $("#id_usuario").html(obj.id_usuario);
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

