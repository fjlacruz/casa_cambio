
<table class="table table-hover table-striped">
    <?php
    echo "
        <tbody class='buscar'>";
    foreach ($resultados as $resultado) {
        $id_banco = $resultado->id_banco;
        $nombre_banco = $resultado->nombre_banco;
        $estatus = $resultado->estatus;

        if ($estatus == 1) {
            $estatus_actual = '<span tooltip="Desactivar" flow="left"><button type="button" data-id2="' . $id_banco . '" class="btn bg-navy btn-xs desactivar_banco">
            <span class="fa  fa- fa-thumbs-o-up"></span>
            </button></span>';
        } else {
            $estatus_actual = '<span tooltip="Activar" flow="left"><button type="submit" data-id="' . $id_banco . '"  class="btn bg-primary btn-xs activar_banco">
            <span class="fa  fa-thumbs-o-down"></span>
            </button></span>';
        }

        echo "
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_banco . "</td>      
        <td align='justify'>" . $nombre_banco . "</td>   
                 
        <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id3='$id_banco' class='btn bg-navy btn-xs editButton'>
            <span class='fa  fa-edit'></span>
            </button></span>
            $estatus_actual
            <span tooltip='Eliminar' flow='left'><button type='button' data-id4='$id_banco' class='btn btn-danger btn-xs deleteButton'>
            <span class='fa  fa-close'></span>
            </button></span>
            </td>
        </tr>";
    }
    echo "
        <tbody>
        ";
    ?>
</table>


<script>
    $(document).ready(function() {
        $("#editBanco").click(function() {
            var dataBanco = {
                "nombre_banco": $("#nombre_banco").val()
            };
            if (dataBanco.nombre_banco === '') {
                // alertify.error("Deba Argregar nombre de Banco...!!");
                return false;
                myFunction(2);
            }
        });
    });

    $(document).ready(function() {
        $('#editBanco').formValidation({
            fields: {
                nombre_bancossss: {
                    row: '.col-lg-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO....'
                        },

                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/actualizar_banco'; ?>",
                method: 'POST',
                data: $form.serialize(),
                beforeSend: function() {
                    document.getElementById('editBanco_loader').style.display = 'block';
                    document.getElementById('edit_Banco').style.display = 'none';
                },

            }).success(function(response) {
                alertify.log("Banco Actualizado...!!!");
                leerBancos();
                document.getElementById('editBanco_loader').style.display = 'none';
                document.getElementById('edit_Banco').style.display = 'block';
                $('#nombre_banco').val('');
                $('#id_banco').val('');
                myFunction(2);
                limpiar_duplicados();
            });
        });
    });

    $('.editButton').on('click', function() {
        var id = $(this).attr('data-id3');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/configuraciones/consultar_banco_id/'; ?>" + id,
            method: 'GET'

        }).success(function(data) {

            var obj1 = JSON.parse(data); //parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")"); // limpiamos el json
            console.log(obj);
            $('#userForm')
            $('[name="id_banco"]').val(obj.id_banco);
            $('[name="nombre_banco"]').val(obj.nombre_banco);
        });
    });

    $(document).ready(function() {
        $('.activar_banco').on('click', function() {
            var id = $(this).attr('data-id');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/activar_banco/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Banco Activado...!!!");
                leerBancos();
            });
        });
    });

    $(document).ready(function() {
        $('.desactivar_banco').on('click', function() {
            var id = $(this).attr('data-id2');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/desactivar_banco/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.error("Banco Desactivado...!!!");
                leerBancos();
            });
        });
    });

    $(document).ready(function() {
        $('.modificar_rol_sol').on('click', function() {
            var id = $(this).attr('data-id2');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/administracion/cambiar_a_sol/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Usuario Eliminado...!!!");
                leerBancos();
            });
        });
    });

    $(document).ready(function() {
        $('.deleteButton').on('click', function() {
            var id = $(this).attr('data-id4');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/eliminar_banco/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Banco Eliminado...!!!");
                leerBancos();
                myFunction(2)
            });
        });
    });
</script>