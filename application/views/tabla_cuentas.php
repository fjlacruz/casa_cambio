<br>

<style>
.scroll {
    /* definir una altura peque単a para forzar el scroll */
    height: 350px;
    overflow-y: scroll;
    width: auto;

}
</style>
<input class="form-control" id="myInput" type="text" placeholder="Filtrar Cuentas..">
<div class="scroll">
<table class="table table-hover table-striped visible-lg" id="tblDatos">

    <thead>
        <tr>
            <th align='justify'>Titulares Registrados

            </th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable'>";
    if ($cuentas) {
        foreach ($cuentas as $cuenta) {
            $id_cuenta = $cuenta->id_cuenta;
            $tipo_cuenta = $cuenta->tipo_cuenta;
            $nombre_banco = $cuenta->nombre_banco;
            $nro_cuenta = $cuenta->nro_cuenta;
            $cedula_titular = $cuenta->cedula_titular;
            $nombres_apellidos = $cuenta->nombres_apellidos;
            $email = $cuenta->email;
            $estatus = $cuenta->estatus;
            $fecha_registro = $cuenta->fecha_registro;
            $id_banco = $cuenta->id_banco;
            //Hacemos la verificacion del saldo del banco para habilitar o no el boton de tramsfreencias//
            $banco_saldo=$this->Transferencias_model->verificar_saldo($id_banco);
            if($banco_saldo){
            foreach($banco_saldo as $saldo_banco){
                $saldo=$saldo_banco->saldo;
                //echo $saldo;
            }
            if($saldo<=1500000){
                 $boton_transferencia="Banco No disponible"; 
            }else{
                $boton_transferencia="<span tooltip='Solicitar Transferencia..' flow='left'><button type='button' style='box-shadow: 2px 2px 5px #666;' data-id='$id_cuenta' onclick='myFunction(4)' class='btn bg-navy btn-xs editButton'>
            <span class='fa  fa-money'></span>
            </button></span>";
            }
            }else{
                $boton_transferencia="Banco No disponible";
            }
           
        echo"
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_cuenta . "</td>      
        <td align='justify'>" . $nombres_apellidos . " / " . $nombre_banco . "</td>
        <td align='center'> 
        $boton_transferencia
        &nbsp;&nbsp;
            <span tooltip='Editar Cuenta' flow='left'><button type='button' style='box-shadow: 2px 2px 5px #666;' data-id='$id_cuenta' onclick='myFunction(2)' class='btn bg-navy btn-xs editButton'>
            <span class='fa  fa-edit'></span>
            </button></span>
            </td>
        </tr>";
        }
    } else {
        echo "<br><div class='alert alert-warning visible-lg'>
    No posee cuentas registradas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='myFunction(3)' class='alert-link' data-toggle='modal' data-target='#myModal'>Registrar cuentas</a>.
  </div>";
    }
    echo "<tbody>";
    ?>
    
</table>

<table class="table table-hover table-striped visible-xs" id="tblDatos">

    <thead>
        <tr>
            <th align='justify'>Titulares Registrados

            </th>
        </tr>
    </thead>

    <?php
    echo "<tbody  id='myTable'>";
    if ($cuentas) {
        foreach ($cuentas as $cuenta) {
            $id_cuenta = $cuenta->id_cuenta;
            $tipo_cuenta = $cuenta->tipo_cuenta;
            $nombre_banco = $cuenta->nombre_banco;
            $nro_cuenta = $cuenta->nro_cuenta;
            $cedula_titular = $cuenta->cedula_titular;
            $nombres_apellidos = $cuenta->nombres_apellidos;
            $email = $cuenta->email;
            $estatus = $cuenta->estatus;
            $fecha_registro = $cuenta->fecha_registro;
            $id_banco = $cuenta->id_banco;
            //Hacemos la verificacion del saldo del banco para habilitar o no el boton de tramsfreencias//
            $banco_saldo=$this->Transferencias_model->verificar_saldo($id_banco);
            if($banco_saldo){
            foreach($banco_saldo as $saldo_banco){
                $saldo=$saldo_banco->saldo;
            }
            if($saldo<=1500000){
                 $boton_transferencia="Banco No disponible"; 
            }else{
                $boton_transferencia="<span tooltip='Solicitar Transferencia' flow='left'><button type='button' style='box-shadow: 2px 2px 5px #666;' data-id='$id_cuenta' onclick='myFunction(4)' class='btn bg-navy btn-lg editButton'>
            <span class='fa  fa-money'></span>";
            }
            }else{
                $boton_transferencia="Banco No disponible";
            }

            echo "
       
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_cuenta . "</td>      
        <td align='justify'>" . $nombres_apellidos . " <br> " .  " Banco: " .$nombre_banco . "</td>
        <td align='center'> 
        $boton_transferencia
            </button></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span tooltip='Editar Cuenta' flow='left'><button type='button' style='box-shadow: 2px 2px 5px #666;' data-id='$id_cuenta' onclick='myFunction(2)' class='btn bg-navy btn-lg editButton'>
            <span class='fa  fa-edit'></span>
            </button></span>
            </td>
        </tr>";
        }
    } else {
        echo "<div class='alert alert-warning visible-xs'>
    No posee cuentas registradas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='myFunction(3)' class='alert-link'  data-toggle='modal' data-target='#myModal'>Registrar cuentas</a>.
  </div>";
    }
    echo "<tbody>";
    ?>
    
</table>
</div>
<br>


<script>
    $(document).ready(function() {
        $('#formulario_editar_cuenta').formValidation({
            fields: {
                email_edit: {
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
                nombres_apellidos_edit: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                identificacion_edit: {
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                cedula_titular_edit: {
                    row: '.col-sm-8',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                id_banco_edit: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                nro_cuenta_edit: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                tipo_cuenta_edit: {
                    row: '.col-sm-10',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "<?php echo base_url() . 'index.php/transferencias/actualizar_cuenta'; ?>",
                method: 'POST',
                data: {
                    id_cuenta: $('#id_cuenta').val(),
                    id_banco_edit: $('#id_banco_edit').val(),
                    id_cuenta: $('#id_cuenta').val(),
                    tipo_cuenta_edit: $('#tipo_cuenta_edit').val(),
                    identificacion_edit: $('#identificacion_edit').val(),
                    cedula_titular_edit: $('#cedula_titular_edit').val(),
                    nombres_apellidos_edit: $('#nombres_apellidos_edit').val(),
                    email_edit: $('#email_edit').val(),
                    nro_cuenta_edit: $('#nro_cuenta_edit').val()
                },
                beforeSend: function() {
                    document.getElementById('editar_cuenta_loader').style.display = 'block';
                    document.getElementById('editar_cuenta').style.display = 'none';
                    // $('#formulario_editar_cuenta').bootstrapValidator("resetForm",true);
                },

            }).success(function(response) {
                alertify.log("Cuenta Actualizada...!!!");
                leerCuentas();
                document.getElementById('editar_cuenta_loader').style.display = 'none';
                document.getElementById('editar_cuenta').style.display = 'block';
                $('#nombres_apellidos_edit').val('');
                myFunction(1);
                $('#formulario_editar_cuenta').bootstrapValidator("resetForm",true);
            });
        });
    });

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
        });
    });
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
