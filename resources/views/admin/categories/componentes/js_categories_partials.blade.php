{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let category_table; // Declarar la variable en un ámbito más amplio
    let listaErrores = $("#lista-errores-categories-edit");
    let alerta_edit_categories = $("#alerta_edit_categories");

    let listaErroresCreate = $("#lista-errores-categories-create");
    let alerta_create_categories = $("#alerta_create_categories");

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_categories.hide();
    }

    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_categories.hide();
    }

    function cargar_lista_categories() {
        let lista_ajax = $('#categories-table').DataTable({
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
            ajax: '{{ route('admin.categories.listar_categories') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
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
                    $('td:eq(2)', row).addClass('badge badge-success');
                } else if (data.status == 'inactivo') {
                    $('td:eq(2)', row).addClass('badge badge-secondary');
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

        category_table = cargar_lista_categories()
    });





    // ############################################################ Funcion Ocultar modal de creacion
    function hideModal() {
        $("#category_name").val("");

        // Selecciona el botón por su id
        var close_create = $('#close_create');

        // Programáticamente dispara un evento de clic en el botón
        close_create.trigger('click');
    }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {
        $("#category_name").val("");

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');

        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }


    // ############################################################ Funcion Para limpiar el campo de creacion del modal

    $('#create_category_buttom_modal').click(function(e) {
        limpiarListaErroresCreate();
    });


    // ############################################################ Funcion Crear
    $('#form_create_category').on('submit', function(e) {

        limpiarListaErroresCreate();
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.categories.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                category_table.ajax.reload(); //recargar la tabla

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
                    alerta_create_categories.show(); // Mostrar la alerta
                }
            }
        });


    });


    // ############################################################ Funcion Editar

    $('body').on('click', '#bt_category_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        //console.log(id);

        $.ajax({
            type: 'GET',
            url: '{{ url('admin/categories', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)

                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION
                $("#category_title").html(response[0].name)
                $("#name_edit").val(response[0].name);
                $("#category_id").val(id);

            },
            error: function(xhr) {
                // Manejar errores (opcional)
                //console.error(xhr.responseText);
            }
        });
    });




    // ############################################################ Funcion Actualizar
    //ajax para hacer la actualizacion enviado el formulario con los datos

    $('#form_edit_category').on('submit', function(e) {

        limpiarListaErrores();
        e.preventDefault();

        let formData = $(this).serialize();
        let id = $("#category_id").val();

        // console.log(formData);
        // console.log(id);

        $.ajax({
            type: 'PUT',
            url: '{{ url('admin/categories', '') }}/' + id,
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);

                // Muestra Sweet Alert con el mensaje de respuesta

                Swal.fire({
                    icon: "success",
                    title: "Éxito!",
                    text: "Registro actualizado correctamente"
                });

                category_table.ajax.reload(); //recargar la tabla

                hideModalEdit(); //ocultar modal de edicion
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_categories.show(); // Mostrar la alerta
                }

                //onsole.error(xhr.responseText);
                //console.error(xhr.responseText);

            }



        });

    });

    // ############################################################ Funcion Eliminar
    //ajax para desactivar las categories

    $("body").on("click", "#category_delete", function() {


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
                    url: '{{ url('admin/categories', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);
                        category_table.ajax.reload(); //recargar la tabla
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
    $("body").on("click", "#category_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        $.ajax({
            type: 'GET',
            url: '{{ url('admin/categories', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'La Categoría ha sido activada',
                    'success'
                );
                category_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                //console.error(xhr.responseText);
            }
        });
    });
</script>
