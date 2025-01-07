{{-- MODAL DE EDICION --}}

<form id="form_edit_config">
    @csrf

    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Hidden que almacena el id para hacer la edicion del usuario --}}
    <input type="hidden" name="config_id" id="config_id">

    <div class="modal fade" id="md_edit_config" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="config_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_categories" style="display: none;">
                        <ul class="m-0" id="lista-errores-categories-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">
                        <div class="mb-3">

                            <div class="row">
                                <div class="col">
                                    <label for="config_name" class="form-label">Color</label>
                                    {{-- Minimal --}}
                                    <select class="form-control" name="selectColor" id="selectColor">
                                        <option value="orange">Naranja</option>
                                        <option value="red">Rojo</option>
                                        <option value="secondary">Gris</option>
                                        <option value="primary">Azul</option>
                                        <option value="success">Verde</option>
                                        <option value="info">Cyan</option>
                                        <option value="warning">Amarillo</option>
                                        <option value="purple">Purpura</option>
                                        <option value="indigo">Morado</option>
                                        <option value="pink">Rosado</option>
                                        <option value="olive">Olivo</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="config_name" class="form-label">Muestra</label>

                                    <div>
                                        <div id="muestraColor" class="bg-"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Seleccionar Color" id="bt_edit_config" class="btn btn-primary">

                </div>
            </div>
        </div>
    </div>
</form>
