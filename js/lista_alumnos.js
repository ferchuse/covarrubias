$(document).ready(function() {
    var filtros = {};
    cargarTabla(filtros);
    //--------FILTRO--------
    function cargarTabla(filtros) {
        var cargador = "<tr><td class='text-center' colspan='5'><i class='fa fa-spinner fa-spin fa-3x'></i></td></tr>";
        $('#cuerpo').html(cargador);
        $.ajax({
            url: 'control/lista_alumnos.php',
            method: 'GET',
            data: filtros
        }).done(function(respuesta) {
            $('#cuerpo').html(respuesta);

            //----------MODIFICAR ESTATUS--------
            $('.btn_baja').click(function btnBaja() {
                var boton = $(this);
                boton.prop('disabled', true);
                icono = boton.find(".fa");
                icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
                var id_alumnos = boton.data('id_alumnos');
                var fila = boton.closest('tr');
                function baja(evet,value) {
					$.ajax({
						url: 'control/fila_update.php',
						method: 'POST',
						data:{
						tabla: 'alumnos',
						id_campo: 'id_alumnos',
						id_valor: id_alumnos,
						valores: [
							{
								name: 'motivoBaja_alumnos',
								value: value
							},
							{
								name: 'estatus_alumnos',
								value: 'BAJA'
							}
						]
						}
					}).done(function(respuesta){
						alertify.success("Se ha dado de baja correctamente"); 
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						boton.prop('disabled', false);
						cargarTabla(filtros);
					});
                }
				
				
				
                alertify.prompt('Confirmacion', '¿Deseas darlo de baja?','Escribe el motivo', baja, function() {
                    icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
                    boton.prop('disabled', false);
                });

            });

            //--------CARGAR PREINSCRITOS-----------
            $('.btn_detalles').click(function() {
                $('#modal_alumno').modal('show');
                var boton = $(this);
                var id_alumnos = boton.data('id_alumnos');
                var icono = boton.find('.fa');
                icono.toggleClass("fa-eye fa-spinner fa-spin fa-floppy-o");

                $.ajax({
                    url: 'control/buscar_normal.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        campo: 'id_alumnos',
                        tabla: 'alumnos',
                        id_campo: id_alumnos
                    }
                }).done(function(respuesta) {
                    if (respuesta.encontrado == 1) {
                        $.each(respuesta["fila"], function(name, value) {
                            switch (name) {

                                case "discapacidad_alumnos":
                                    if (value == "SI") {
                                        $('#discapacidad_alumnos1').attr('checked', true);

                                    } else {
                                        $('#discapacidad_alumnos2').attr('checked', true);

                                    }
                                    break;

                                case "extranjero_alumnos":
                                    if (value == "SI") {
                                        $('#extranjero_alumnos1').attr('checked', true);
                                    } else {
                                        $('#extranjero_alumnos2').attr('checked', true);
                                    }

                            }

                            $("#" + name).val(value);
                        });
                    }
                    icono.toggleClass("fa-eye fa-spinner fa-spin fa-floppy-o");
                });

            });

            //----------INSCRIBIR-------------
            $('.btn-inscribir').click(function() {
                var boton = $(this);
                var icono = boton.find('.fa');
                boton.prop('disabled', true);
                var id_alumno = $('#id_alumnos').val();

                $.ajax({
                    url: 'control/inscribir_alumno.php',
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        id_alumno: id_alumno
                    }
                }).done(function(respuesta) {
                    if (respuesta.estatus == 'success') {
                        alertify.success("Se ha inscrito correctamente");
                        location.reload('inscripciones.php');
                    } else {
                        alertify.success(respuesta.estatus);
                    }
                });

            });

            //--------EDITAR------------
            $('.btn-editar').click(function(event) {
                event.preventDefault();

                var boton = $(this);
                boton.prop('disabled', true);
                var icono = boton.find('.fa');
                icono.toggleClass("fa-save fa-spinner fa-spin fa-floppy-o");

                $.ajax({
                    url: 'control/alta_alumnos.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: $('#form_alumno').serialize() + '&campo=EDITAR'
                }).done(function(respuesta) {
                    if (respuesta.estatus == "success") {
                        alertify.success(respuesta.mensaje);
                        location.reload('inscripciones.php');
                    } else {
                        alertify.error('Error al modificar');
                        console.log(respuesta.error);
                    }
                    icono.toggleClass("fa-save fa-spinner fa-spin fa-floppy-o");
                });


            });

            //--------CREAR CREDENCIAL--------
            $('.btn_credencial').click(function() {
                var boton = $(this);
                var icono = boton.find('fa');
                boton.prop('disabled', true);
                var id_alumno = boton.data('id_alumnos');
                console.log(id_alumno);

                window.open('credenciales.php?id_alumno=' + id_alumno);
            });
        });
    }
    //-------------FILTROS------------------------------

    $('#id_select').change(function seleccionNiveles() {
        var niveles = $('#id_select option:selected').data('id_nivel');
        console.log(niveles);
        filtros['niveles'] = $('#id_select option:selected').data('id_nivel');
        filtros['id_grados'] = $('#id_select option:selected').val();

        cargarTabla(filtros);
        console.log(filtros);
    });
    $('#id_grupos').change(function seleccionGrupos() {
        filtros['id_grupos'] = $(this).val();
        cargarTabla(filtros);
    });
});