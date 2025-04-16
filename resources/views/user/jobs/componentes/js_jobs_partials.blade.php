{{-- ----- INICIALIZAR YAJRA-DATATABLES ############################################################ --}}

<script>
    let job_table;
    let listaErrores = $("#lista-errores-jobs-edit");
    let alerta_edit_jobs = $("#alerta_edit_jobs");

    let listaErroresCreate = $("#lista-errores-jobs-create");
    let alerta_create_jobs = $("#alerta_create_jobs");

    let lista_pc;
    let lista_estados_pago;

    function limpiarListaErrores() {
        listaErrores.empty();
        alerta_edit_jobs.hide();
    }

    function limpiarListaErroresCreate() {
        listaErroresCreate.empty();
        alerta_create_jobs.hide();
    }

    // Función para formatear fechas en formato dd-mm-yy H:m:s
    function formatDate(dateString) {
        let date = new Date(dateString);
        let day = String(date.getDate()).padStart(2, "0");
        let month = String(date.getMonth() + 1).padStart(2, "0");
        let year = String(date.getFullYear());
        let hours = String(date.getHours()).padStart(2, "0");
        let minutes = String(date.getMinutes()).padStart(2, "0");
        let seconds = String(date.getSeconds()).padStart(2, "0");
        return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    }
    function formatOnlyDate(dateString) {
        let date = new Date(dateString);
        let day = String(date.getDate()).padStart(2, "0");
        let month = String(date.getMonth() + 1).padStart(2, "0");
        let year = String(date.getFullYear());

        return `${day}/${month}/${year}`;
    }

    async function ObtenerListaPc() {

        let listapc = []

        try {
            let response = await $.ajax({
                url: '{{ route('admin.computers.listar_computers') }}', // Ruta definida en web.php
                method: 'GET',
                dataType: 'json'
            });

            //Recorremos la respuesta y agregamos cada opción
            $.each(response.data, function(index, pc) {
                if (pc.status === "activo") {
                    listapc.push({
                        id: pc.id,
                        name: pc.name,
                        owner: pc.owner
                    });
                }
            });

            //console.log(listapc);

            return listapc; // 👈 MUY IMPORTANTE

        } catch (error) {
            console.error("Error al cargar las pc:", error);
            return [];
        }
    }


    function cargar_lista_jobs() {
        let lista_ajax = $('#jobs-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                "lengthMenu": "Mostrando _MENU_ registros por página",
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
            ajax: '{{ route('user.jobs.listar_jobs') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'owner',
                    name: 'name'
                },
                {
                    data: 'pay_status',
                    name: 'pay_status'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'end_datetime',
                    name: 'end_datetime'
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
            pageLength: 10,

            createdRow: function(row, data, dataIndex) {
                // Columna 1: status
                if (data.status === 'activo') {
                    $('td:eq(1)', row).addClass('badge badge-success mt-1');
                } else if (data.status === 'inactivo') {
                    $('td:eq(1)', row).addClass('badge badge-secondary mt-1');
                }

                // Columna 4: pay_status
                if (data.pay_status === 'cancelado') {
                    $('td:eq(4)', row).addClass('badge badge-success mt-1');
                } else if (data.pay_status === 'pendiente') {
                    $('td:eq(4)', row).addClass('badge badge-secondary mt-1');
                } else if (data.pay_status === 'anulado') {
                    $('td:eq(4)', row).addClass('badge badge-dark mt-1');
                }
            }
        });

        return lista_ajax;
    }



    // ############################################################ Funcion incial para cargar el datatable por primera vez

    $(document).ready(async function() {
        try {
            // Configuración del token CSRF para la solicitud AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            job_table = cargar_lista_jobs();

            // Obtener lista de PCs
            let lista_pc = await ObtenerListaPc();

            // Referencia al select
            const select = $("#select_computer_create_id");
            // Limpiar el select antes de llenarlo
            select.empty();
            // Agregar una opción por defecto
            select.append(new Option("Seleccione una PC", ""));
            // Llenar el select con las PCs activas
            lista_pc.forEach(pc => {
                const label = `${pc.name} - ${pc.owner}`; // Concatenación correcta
                select.append(new Option(label, pc.id));
            });

        } catch (error) {
            console.error("Error al inicializar la página:", error);
        }
    });



    // ############################################################ Funcion Ocultar modal de creacion
    // function hideModal() {
    //     $("#job_name").val("");
    //     $("#job_detail").val("");

    //     // Selecciona el botón por su id
    //     var close_create = $('#close_create');

    //     // Programáticamente dispara un evento de clic en el botón
    //     close_create.trigger('click');
    // }

    // ############################################################ Funcion Ocultar modal de edicion
    function hideModalEdit() {

        // Selecciona el botón por su id
        var close_edit = $('#close_edit');
        // Programáticamente dispara un evento de clic en el botón
        close_edit.trigger('click');
    }


    // ############################################################ Funcion Para limpiar el campo de creacion del modal

    $('#create_job_buttom_modal').click(function(e) {
        limpiarListaErroresCreate();
    });


    // ############################################################ Funcion Crear (OK)
    $('#form_create_job').on('submit', function(e) {

        limpiarListaErroresCreate();
        e.preventDefault();

        let formData = $(this).serialize();

        // console.log(formData);

        $.ajax({
            type: 'POST',
            url: '{{ route('user.jobs.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);
                job_table.ajax.reload(); //recargar la tabla

                Swal.fire({
                    title: 'Éxito',
                    text: '¡Operación completada con éxito!',
                    icon: 'success', // Opciones: 'success', 'error', 'warning', 'info', 'question'
                    confirmButtonText: 'Aceptar'
                });

                //hideModal(); //ocultar modal de creacion
            },
            error: function(xhr) {

                // Manejar errores (opcional)
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErroresCreate.append("<li>" + error + "</li>");
                    });
                    alerta_create_jobs.show(); // Mostrar la alerta
                }
            }
        });


    });


    // ############################################################ Funcion Editar


    // <input type="checkbox" name="close_sell" id="close_sell_id">
    //             <label for="observations" class="form-label"> ¿Estás cerrando la venta y saliendo de la tienda?</label>

    $('body').on('click', '#bt_job_edit', function() {

        var id = $(this).data('id');
        limpiarListaErrores();

        $("#job").val(id);

        //console.log(id);


        $.ajax({
            type: 'GET',
            url: '{{ url('jobs', '') }}/' + id + '/edit',
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                //console.log(response);

                //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION


                $("#job_id").val(id);
                $("#job_text_id").val(id);
                $("#date_id").val(response[0].date);
                $("#observations_id").val(response[0].observations);
                $("#status_id").val(response[0].status);
                $("#pay_status_id").val(response[0].pay_status);

            },
            error: function(xhr) {
                //console.log(xhr);
            }
        });
    });


    // ############################################################ Funcion Actualizar (ok)
    //ajax para hacer la actualizacion enviado el formulario con los datos


    $('#form_edit_job').on('submit', function(e) {
        e.preventDefault();
        limpiarListaErrores();

        let formData = $(this).serialize();
        let id = $("#job_id").val();

        // Paso 1: validar sin guardar aún (puedes usar una ruta custom o la misma con método POST)
        $.ajax({
            type: 'PUT',
            url: '{{ url('jobs', '') }}/' + id,
            data: formData,
            success: function(response) {
                // Si pasa la validación, ahora sí mostramos el SweetAlert
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Vas a actualizar el registro de este trabajo",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, actualizar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'PUT',
                            url: '{{ url('jobs', '') }}/' + id,
                            data: formData,
                            success: function(response) {
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Actualizado!",
                                    text: "Registro actualizado correctamente"
                                });
                                job_table.ajax.reload();
                                hideModalEdit();
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    var errores = xhr.responseJSON.errors;
                                    $.each(errores, function(index, error) {
                                        listaErrores.append("<li>" +
                                            error + "</li>");
                                    });
                                    alerta_edit_jobs.show();
                                }
                            }
                        });
                    }
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errores = xhr.responseJSON.errors;
                    $.each(errores, function(index, error) {
                        listaErrores.append("<li>" + error + "</li>");
                    });
                    alerta_edit_jobs.show();
                }
            }
        });
    });

    // ############################################################ Listar detalle (ok)
    //ajax para hacer la actualizacion enviado el formulario con los datos




    // Escuchar clic en el botón con ID "user_show"
    $("body").on("click", "#job_show", function() {
        // Obtener el ID del usuario desde el atributo data-id
        var id = $(this).data("id");

        // Realizar la solicitud AJAX para obtener la información del usuario
        $.ajax({
            type: "GET",
            url: "{{ url('ver_job', '') }}/" + id,
            success: function(response) {

                // Mostrar información personal del usuario en el modal
                $("#job_deail_list_id").html(`

                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">id</div>
                            ${response[0].id}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Estado</div>
                            ${response[0].status}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Pago estado</div>
                            ${response[0].pay_status}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Observaciones</div>
                            ${response[0].observations}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Fecha</div>
                            ${formatOnlyDate(response[0].date)}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Fecha de cierre</div>
                            ${response.end_datetime ?
                            formatDate(response[0].end_datetime) :
                            "<strong style='color:yellow'> No ha cerrado venta </strong"}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Fecha y hora de creacion</div>
                            ${formatDate(response[0].created_at)}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Monto Total</div>
                            S/. ${response[0].total_mount}
                        </div>
                    </li>
                    <li>
                        <div class="ms-2 me-auto">
                            <div class="text-bold">Monto 50% </div>
                            S/. ${response[0].worker_pay}
                        </div>
                    </li>

                `);

            },

                error: function(xhr) {
                // Manejo de errores en la solicitud AJAX
                console.error("Error al obtener los datos del usuario:", xhr.responseText);
            },
        });
    });











    // ############################################################ Funcion Eliminar (PENDIENTE)
    //ajax para desactivar las jobs

    $("body").on("click", "#job_delete", function() {


        var id = $(this).data('id');

        // Puedes realizar una solicitud AJAX para eliminar el registro o cualquier otra acción que necesites
        //e.preventDefault(); //NO ES NECESARIO ACTIVAR EL PREVENT DEFAULT CUANDO SE HACE UNA DESACTIVACION

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Si tu desactivas esta pc, esta no podrá visualizarse para creacion de los trabajos",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, desactívalo"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Aceptar", ejecutamos la lógica de eliminación aquí

                // console.log(id);
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('jobs', '') }}/' + id,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);
                        job_table.ajax.reload(); //recargar la tabla
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });

                Swal.fire({
                    title: "Desactivado",
                    text: "La Computadora ha sido desactivada",
                    icon: "success"
                });
            }
        });

        // Si el usuario hace clic en "Cancelar", no hacemos nada
        // Aquí puedes agregar cualquier otra acción que desees realizar si el usuario cancela

    });


    // ############################################################ Funcion ACtivar trabajo (PENDIENTE)

    //usamos el evento on() porque estamos trabajando con elementos que son dinamicos y no
    //fueron creados al momento de iniciar la página, por ello no usamos ".click(function()"
    $("body").on("click", "#job_activate", function() {
        var id = $(this).data('id');
        // LOGICA DE ACTIVACION
        $.ajax({
            type: 'GET',
            url: '{{ url('jobs', '') }}/' + id,
            success: function(response) {
                // Manejar la respuesta del servidor (opcional)
                Swal.fire(
                    'Activada',
                    'La Computadora ha sido activada',
                    'success'
                );
                job_table.ajax.reload(); //recargar la tabla
            },
            error: function(xhr) {
                // Manejar errores (opcional)
                //console.error(xhr.responseText);
            }
        });
    });
</script>
