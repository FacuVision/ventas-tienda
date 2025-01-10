<script>
    $(document).ready(function() {
        // Configurar el token CSRF requerido para las solicitudes AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        // Inicializar el color y asignarlo al elemento correspondiente
        const inicialColor = $("#color_profile").val();
        const inicialColorSideBar = $("#sidebar").val();
        actualizarMuestraColor(inicialColor);

        // Establecer la opción seleccionada en el select
        $("#selectColor").val(inicialColor).trigger("change");

        // Reducir el padding de las cards para un diseño más compacto
        $(".card-footer").addClass("pb-0");

        // Cambiar el color de muestra al seleccionar una nueva opción
        $("#selectColor").change(function() {
            const selectedColor = $(this).val();
            actualizarMuestraColor(selectedColor);
        });

        // Manejar el envío del formulario para actualizar configuración
        $("#form_edit_config").on("submit", function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const id = $("#user_id").val();
            $("#config_id").val(id);

            // Verificar que los datos se asignan correctamente

            // Enviar solicitud AJAX
            $.ajax({
                type: "PUT",
                url: '{{ url('admin/update_config', '') }}/' + id,
                data: formData,
                success: function(response) {
                    //console.log("Respuesta del servidor:", response);
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: "La configuración se actualizó correctamente."
                    }).then(() => {
                        location.reload(); // Recargar la página
                    });
                },
                error: function(xhr) {
                    console.error("Error en la solicitud:", xhr.responseText);
                    manejarErrores(xhr);
                },
            });
        });

        // Función para actualizar la muestra de color
        function actualizarMuestraColor(color) {
            $("#muestraColor")
                .attr("class", "") // Elimina todas las clases actuales
                .addClass(`p-4 bg-${color}`); // Agrega la nueva clase
        }

        // Función para manejar errores
        function manejarErrores(xhr) {
            if (xhr.status === 422) {
                const errores = xhr.responseJSON.errors;
                const listaErrores = $("#lista-errores-categories-edit").empty();
                $.each(errores, function(index, error) {
                    listaErrores.append(`<li>${error}</li>`);
                });
                $("#alerta_edit_categories").show();
            }
        }
    });
</script>
