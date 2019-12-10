
   
 
    $(document).ready(function() {
        var id_usuario = document.getElementById("id_usuario").value;
        var dataString = 'id_usuario=' + id_usuario;
        $.ajax({
            type: "POST",
            url: "buscar_usuario",
            data: dataString,
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                console.log(obj);             
                $("#id_usuario").val(obj.data[0].id_usuario);
                $("#nombres").val(obj.data[0].nombres);
                $("#apellidos").val(obj.data[0].apellidos);
                $("#correo").val(obj.data[0].correo);
                $("#usuario").val(obj.data[0].usuario);
                $("#telefono").val(obj.data[0].telefono);
                $("#rut_pasaporte").val(obj.data[0].rut_pasaporte);
            }
        });
    });
    
   


    // funcion para poner los inpunts en mayuscula
    $(document).on("keyup", '#correo', function()
    {
        $(this).val($(this).val().toUpperCase());

    });
    $(document).ready(function() {
        $('#formulario2')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        confirmar_clave: {
                            row: '.col-sm-10',
                            validators: {
                                notEmpty: {
                                    message: 'CAMPO OBLIGATORIO'
                                },
                                stringLength: {
                                    //min: 8,
                                    //max: 20,
                                    message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                                },
                                /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial
                               regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,12}$',
                            message: 'La contrase&ntilde;a debe contener m&iacute;nimo 6 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula, 1 min&uacute;sculas y 1 N&uacute;mero'
                        }
                            }
                        },
                        clave: {
                            row: '.col-sm-10',
                            validators: {
                                notEmpty: {
                                    message: 'CAMPO OBLIGATORIO'
                                },
                                stringLength: {
                                    //min: 8,
                                    //max: 20,
                                    message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                                },
                                /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial ej: POab12@, AAbb01**
                                /////NO importa el orden de como se llenen la password puede ser al contrario ej:12@abPO

                               regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,12}$',
                            message: 'La contrase&ntilde;a debe contener m&iacute;nimo 6 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula, 1 min&uacute;sculas y 1 N&uacute;mero'
                        },
                                identical: {
                                    field: 'confirmar_clave',
                                    message: 'Las contrase&ntilde;a deben ser iguales'
                                }
                            }
                        }
                    }
                });

    });

    $(document).ready(function() {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                correo: {
                    row: '.col-sm-8',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        },
                    }
                },
                usuario: {
                    row: '.col-sm-4',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            }
        });
    });


    $(document).ready(function() {
        $('#modificar').click(function() {
            var dataUser = {
                "id_usuario": $("#id_usuario").val(),
                "correo": $("#correo").val(),
                "usuario": $("#usuario").val(),
                "nombres": $("#nombres").val(),
                "apellidos": $("#apellidos").val(),
                "telefono": $("#telefono").val(),
                "rut_pasaporte": $("#rut_pasaporte").val()

            };
            if (dataUser.usuario === '' || dataUser.nombres === '' || dataUser.apellidos === ''|| dataUser.rut_pasaporte === '') {
                alertify.error("Debe Completar todos los Campos...!!"); 
                    return false;
            } else {

                $.ajax({
                    data: dataUser,
                    type: 'POST',
                    url: "actualizarUsuario",
                    beforeSend: function () {
                    document.getElementById('modificar').style.display = 'none';
                    document.getElementById('modificar_loader').style.display = 'block';
                    },
     
                    success: function(data) {
                    alertify.log("Datos Modificados...!!"); 
                    document.getElementById('modificar').style.display = 'block';
                    document.getElementById('modificar_loader').style.display = 'none';
                    return false;
                    }
                });
                
            }
        });
    });


    $(document).ready(function() {
        $("#actualizar").click(function() {
            var dataUser = {
                "clave": $("#clave").val(),
                "confirmar_clave": $("#confirmar_clave").val()
            };
            if (dataUser.clave === '') {
               alertify.error("Debe Completar todos los Campos...!!"); 
                    return false;
            } else {
                var vacio = 1;
            }
            if (dataUser.clave != dataUser.confirmar_clave) {
                $('#confirmar_clave').val('');
                $('#clave').val('');
                alertify.error("Las contrase&ntilde;a deben ser iguales"); 
                return false;
            } else {
                var diferente = 1;
            }
            if (vacio == 1 && diferente == 1) {
                $.ajax({
                    url: "contrasenna_actualizar",
                    type: 'POST',
                    data: dataUser,
                    success: function(data) {
                    $('#confirmar_clave').val('');
                    $('#clave').val('');
                    alertify.log("Clave Modificada...!!"); 
                    return false;
                    }
                });
            }

        });
    });
