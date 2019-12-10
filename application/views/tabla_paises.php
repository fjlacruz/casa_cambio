
<table class="table table-hover table-striped">
    <?php
    echo "
        <tbody class='buscar'>";
    foreach ($resultados as $resultado) {
        $id_pais = $resultado->id_pais;
        $nombre_pais = $resultado->nombre_pais;
        $estatus = $resultado->estatus;

        if ($estatus == 1) {
            $estatus_actual = '<span tooltip="Desactivar" flow="left"><button type="button" data-id2="' . $id_pais . '" class="btn bg-navy btn-xs desactivar_pais">
            <span class="fa  fa- fa-thumbs-o-up"></span>
            </button></span>';
        } else {
            $estatus_actual = '<span tooltip="Activar" flow="left"><button type="button" data-id="' . $id_pais . '"  class="btn bg-primary btn-xs activar_pais">
            <span class="fa  fa-thumbs-o-down"></span>
            </button></span>';
        }

        echo "
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_pais . "</td>      
        <td align='justify'>" . $nombre_pais . "</td>   
                 
        <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id3='$id_pais' class='btn bg-navy btn-xs editButton'>
            <span class='fa  fa-edit'></span>
            </button></span>
            $estatus_actual
            <span tooltip='Eliminar' flow='left'><button type='button' data-id4='$id_pais' class='btn btn-danger btn-xs deleteButton'>
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
        $("#edit_pais").click(function() {
            var dataBanco = {
                "nombre_pais": $("#nombre_pais").val()
            };
            if (dataBanco.nombre_pais === '') {
                // alertify.error("Deba Argregar nombre de Banco...!!");
                return false;
                myFunction(2);
            }
        });
    });


    $(document).ready(function() {
        $('#editPais').formValidation({
            fields: {
                nombre_paisssss: {
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
                url: "<?php echo base_url() . 'index.php/configuraciones/actualizar_pais'; ?>",
                method: 'POST',
                data: {
                "nombre_pais": $("#nombre_pais").val()
                 },
                beforeSend: function() {
                    document.getElementById('editPais_loader').style.display = 'block';
                    document.getElementById('edit_Banco').style.display = 'none';
                    leerSelect();
                },

            }).success(function(response) {
                alertify.log("Pais Actualizado...!!!");
                leerPises();
                leerSelect();
                document.getElementById('editPais_loader').style.display = 'none';
                document.getElementById('edit_Banco').style.display = 'block';
                $('#nombre_pais').val('');
                $('#id_pais').val('');
                limpiar_duplicados_paises();
                myFunction(2);
            });
        });
    });


    $('.editButton').on('click', function() {
        var id = $(this).attr('data-id3');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/configuraciones/consultar_pais_id/'; ?>" + id,
            method: 'GET'

        }).success(function(data) {

            var obj1 = JSON.parse(data); //parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")"); // limpiamos el json
            console.log(obj);
            $('#userForm')
            $('[name="id_pais"]').val(obj.id_pais);
            $('[name="nombre_pais"]').val(obj.nombre_pais);
            leerSelect();
        });
    });


    $(document).ready(function() {
        $('.activar_pais').on('click', function() {
            var id = $(this).attr('data-id');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/activar_pais/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Pais Activado...!!!");
                leerPises();
                leerSelect();
            });
        });
    });

    $(document).ready(function() {
        $('.desactivar_pais').on('click', function() {
            var id = $(this).attr('data-id2');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/desactivar_pais/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.error("Pais Desactivado...!!!");
                leerPises();
                leerSelect();
            });
        });
    });

    $(document).ready(function() {
        $('.deleteButton').on('click', function() {
            var id = $(this).attr('data-id4');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/configuraciones/eliminar_pais/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Pais Eliminado...!!!");
                leerPises();
                leerSelect();
                myFunction(2)
            });
        });
    });
</script>