{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let computer_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-computers-edit");
    let alerta_edit_computers = $("#alerta_edit_computers");

    let listaErroresCreate = $("#lista-errores-computers-create");
    let alerta_create_computers = $("#alerta_create_computers");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_computers.hide();
    }

    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_computers.hide();
    }

    function cargar_lista_computers() {
        let lista_ajax = $('#computers-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "lengthMenu": "Mostrando _MENU_ registros por pagina",
                "zeroRecords": "No hay registros, lo sentimos",
                "info": "Mostrando _PAGE_ de _PAGES_",
                "infoEmpty": "No hay datos",
                "infoFiltered": "(Filtrado de _MAX_ registros)",
                "search": "Buscar:",
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            },
            ajax: '{{ route('admin.computers.listar_computers') }}',
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'owner',
                    name: 'owner'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ],
            pageLength: 10, // Aquí defines la cantidad de registros por página que deseas mostrar por defecto

            createdRow: function(row, data, dataIndex) {
                // Añadir clase CSS a la columna 'status' según el valor
                if (data.status == 'activo') {
                    $('td:eq(4)', row).addClass('badge badge-success');
                } else if (data.status == 'inactivo') {
                    $('td:eq(4)', row).addClass('badge badge-secondary');
                }
            }

        });
        return lista_ajax;
    }


    // ############################################################ Funcion incial para cargar el datatable por primera vez
    $(document).ready(function() {

        //ESTE TOKEC CSRF LO SOLICITA LA LIBRERIA YAJRA PARA PODER HACER EL ENVIO DE LA
        //PETICION Y LA RECEPCION DE LA MISMA
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        computer_table = cargar_lista_computers()
    });





    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#computer_name").val("");
        $("#computer_detail").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#computer_name_id").val("");
        $("#computer_detail_id").val("");

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');

        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }


    // ############################################################ Funcion Para limpiar el campo de creacion del modal

    $('#create_computer_buttom_modal').click(function(e) {
        limpiarListaErroresCreate();
    });


    // ############################################################ Funcion Crear
    $('#form_create_computer').on('submit', function(e) {

        limpiarListaErroresCreate();
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.computers.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                computer_table.ajax.reload(); //recargar la tabla

                Swal.fire({
                    title: 'Éxito',
                    text: '¡Operación completada con éxito!',
                    icon: 'success', // Opciones: 'success', 'error', 'warning', 'info', 'question'
                    confirmButtonText: 'Aceptar'
                });

                hideModal(); //ocultar modal de creacion
            },
            error: function(xhr) {

                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErroresCreate.append("<li>" + error + "</li>");
                    });
                    alerta_create_computers.show(); // Mostrar la alerta
                }
            }
        });


    });


    // ############################################################ Funcion Editar

    $('body').on('click', '#bt_computer_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        // console.log(id);
        $("#computer").val(id);

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/computers', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)

                //console.log(response);

                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION

                $("#computer_id").val(id);
                $("#computer_title").html(response.name);
                $("#computer_name_id").val(response.name);
                $("#computer_detail_id").val(response.detail);
                $("#computer_owner_id").val(response.owner);

            },
            error: function(xhr) {
                //console.log(xhr);

            }
        });
    });




    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos

    $('#form_edit_computer').on('submit', function(e) {

        limpiarListaErrores();
        e.preventDefault();

        e.preventDefault();

        let formData = $(this).serialize();
        let id = $("#computer_id").val();



        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/computers', '') }}/' + id,
            data: formData,
            success: function(response) {


                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: "Registro actualizado correctamente"
                });

                computer_table.ajax.reload(); //recargar la tabla

                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_computers.show(); // Mostrar la alerta
                }

                // console.log(xhr);


            }



        });

    });

    // ############################################################ Funcion Eliminar
    //ajax para desactivar las computers

    $("body").on("click", "#computer_delete", function() {


        var id = $(this).data('id');

        // Puedes realizar una solicitud AJAX para eliminar el registro o cualquier otra acción que necesites
        //e.preventDefault(); //NO ES NECESARIO ACTIVAR EL PREVENT DEFAULT CUANDO SE HACE UNA DESACTIVACION

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Si tu desactivas esta Categoría, esta no podrá visualizarse en el menu de creacion de comprobantes",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, desactívalo"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Aceptar", ejecutamos la lógica de eliminación aquí

                //console.log(id);
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('admin/computers', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);
                        computer_table.ajax.reload(); //recargar la tabla
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        //console.error(xhr.responseText);
                    }
                });

                Swal.fire({
                    title: "Desactivado",
                    text: "La Categoría ha sido desactivada",
                    icon: "success"
                });
            }
        });

        // Si el usuario hace clic en "Cancelar", no hacemos nada
        // Aquí puedes agregar cualquier otra acción que desees realizar si el usuario cancela

    });


    // ############################################################ Funcion ACtivar Categoría

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#computer_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/computers', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'La Categoría ha sido activada',
                    'success'
                );
                computer_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                //console.error(xhr.responseText);
            }
        });
    });
</script>
