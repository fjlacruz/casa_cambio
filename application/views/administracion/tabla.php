<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<style>
    .scroll {
        /* definir una altura peque単a para forzar el scroll */
        height: 350px;
        overflow-y: scroll;
        width: auto;

    }
</style>
<br>
<input class="form-control" id="myInput2" type="text" placeholder="Filtrar Usuarios..">
<div class="scroll">
    <table class="table table-hover table-striped" id="tblDatos">
        <thead align='center'>
            <tr class="filters">
                <th style="display:none">id_usuario</th>
                <th onkeypress="return soloLetras(event)" align='center'>Nombres</th>
                <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
            </tr>
        </thead>
        <?php
        echo "
        <tbody id='myTable2'>";
        foreach ($resultados as $resultado) {
            $id_usuario = $resultado->id_usuario;
            $rol = $resultado->rol;

            if ($rol === 'ADMINISTRADOR') {
                $rol_actual = '<span tooltip="Establecer como Solicitante" flow="left"><button type="button" data-id="' . $id_usuario . '" class="btn bg-navy btn-md modificar_rol_adm">
            <span class="fa  fa-refresh"></span>
            </button></span>';
            } else {
                $rol_actual = '<span tooltip="Establecer como Administrador" flow="left"><button type="submit" data-id2="' . $id_usuario . '"  class="btn bg-primary btn-md modificar_rol_sol">
            <span class="fa  fa-refresh"></span>
            </button></span>';
            }
            $nombres = $resultado->nombres;
            $apellidos = $resultado->apellidos;
            //$estatus = $resultado->estatus;

            echo "
        <tr align='right'> 
        <td align='right' style='display:none'>" . $id_usuario . "</td>      
        <td align='justify'>" . $nombres . " " . $apellidos . "</td>   
                 
        <td align='center'> <span tooltip='Detalles' flow='left'><button type='button' data-id='$id_usuario' class='btn bg-navy btn-md editButton' onclick='myFunction(1)'>
            <span class='fa  fa-search'></span>
            </button></span>&nbsp;&nbsp;&nbsp;
            $rol_actual
            </td>
        </tr>";
        }
        echo "
        <tbody>
        ";
        ?>
    </table>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#userForm').formValidation({
            fields: {
                correo_modal: {
                    row: '.col-sm-12',
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
                usuario_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                rol_modal: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                estatus_modal: {
                    row: '.col-sm-12',
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
                url: "<?php echo base_url() . 'index.php/administracion/actualizar_usuario'; ?>",
                method: 'POST',
                data: $form.serialize()
            }).success(function(response) {
                //======== Script para notfificaciones push =============================//
                Push.create("Notificacion Push", {
                    body: "Este es el cuerpo de la notificacion",
                    icon: "<?php echo base_url(); ?>application/recursos/imagenes/icon_64.png",
                    //timeout: 12000,
                    requireInteraction: true, // para dejar la notificacion fija hasta que el usuario la cierre manualmente
                    onClick: function() {
                        window.location = "https://nickersoft.github.io/push.js/";
                        this.close();
                    }
                });
                alertify.log("Usuario Actualizado...!!!");
                return false;
                $('#formulario')[0].reset();
                myFunction(1)
                reload_table();
            });
        });
    });
    $('.editButton').on('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consultas/consultar_usuario_id/'; ?>" + id,
            method: 'GET'

        }).success(function(data) {

            var obj1 = JSON.parse(data); //parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")"); // limpiamos el json

            $('#userForm')
            $('[name="id"]').val(obj.id_usuario);
            $('[name="nombres_modal"]').val(obj.nombres);
            $('[name="apellidos_modal"]').val(obj.apellidos);
            $('[name="usuario_modal"]').val(obj.usuario);
            $('[name="correo_modal"]').val(obj.correo);
            $('[name="rol_modal"]').val(obj.rol);
            $('[name="estatus_modal"]').val(obj.estatus);
            $('[name="fecha_registro_modal"]').val(obj.fecha_registro);
            $('[name="telefono_modal"]').val(obj.telefono);
            $("#nombres_modal").html(obj.nombres);
            $("#apellidos_modal").html(obj.apellidos);
            $("#usuario_modal").html(obj.usuario);
            $("#correo_modal").html(obj.correo);
            $("#nombres_modal").html(obj.nombres);
            $("#fecha_registro_modal").html(obj.fecha_registro);
            $("#telefono_modal").html(obj.telefono);
            $("#rol_modal").html(obj.rol);
            $("#estatus_modal").html(obj.estatus);



        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.modificar_rol_adm').on('click', function() {
            var id = $(this).attr('data-id');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/administracion/cambiar_a_admin/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Ahora el Usuario es Solicitante...!!!");
                leerUsuarios();
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.modificar_rol_sol').on('click', function() {
            var id = $(this).attr('data-id2');
            //alert(id);return;
            $.ajax({
                url: "<?php echo base_url() . 'index.php/administracion/cambiar_a_sol/'; ?>" + id,
                method: 'POST'

            }).success(function(response) {
                alertify.log("Ahora el Usuario es Administrador...!!!");
                leerUsuarios();
            });
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

    function nobackbutton() {

        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button" //chrome
        window.onhashchange = function() {
            window.location.hash = "";
        }

    }
</script>