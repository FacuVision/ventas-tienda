<script>
    $(document).ready(function() {

        //ESTE TOKEN CSRF LO SOLICITA LA LIBRERIA YAJRA PARA PODER HACER EL ENVIO DE LA
        //PETICION Y LA RECEPCION DE LA MISMA
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




        //Para inicializar el color
        var InicialColor = $("#primary").attr("id");
        $("#muestraColor")
            .removeClass() // Elimina todas las clases actuales
            .addClass("p-4 bg-" + InicialColor); // Agrega la nueva clase basada en el valor

        // Establecer la opción seleccionada
        $("#selectColor").val(InicialColor).trigger('change');


        //Para reducir el padding de las cards
        $(".card-footer").addClass("pb-0");


        //Para cambiar el color segun el select
        // Escucha el cambio en el select
        $("#selectColor").change(function() {
            // Obtén el valor seleccionado
            var selectedColor = $(this).val();

            // Cambia la clase del botón según el valor seleccionado
            $("#muestraColor")
                .removeClass() // Elimina todas las clases actuales
                .addClass("p-4 bg-" + selectedColor); // Agrega la nueva clase basada en el valor
        });


        $('#form_edit_config').on('submit', function(e) {

            e.preventDefault();

            let formData = $(this).serialize();
            let id = $("#user_id").val();

            $("#config_id").val(id);

            // Verifica que el ID se asigna correctamente
            console.log('ID Config:', $("#config_id").val());
            console.log('Form Data:', formData);


            $.ajax({
                type: 'PUT',
                url: '{{ url('admin/update_config', '') }}/' + id,
                data: formData,
                success: function(response) {
                    // Manejar la respuesta del servidor (opcional)
                    console.log(response);
                    location.reload();


                },
                error: function(xhr) {

                    console.error(xhr.responseText);

                }
            });
        });


    });
</script>
