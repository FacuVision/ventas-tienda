{{-- MODAL DE CREACION --}}

<form id="form_create_computer">
    <div class="modal fade" id="md_create_computer" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar una Computadora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_create_computers" style="display: none;">
                        <ul class="m-0" id="lista-errores-computers-create"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_name" class="form-label">Nombre</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="computer_name"
                                placeholder="Nombre de la PC" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_owner" class="form-label">Dueño</label>
                            <select name="owner" class="form-control form-control-sm"
                                id="computer_owner_create" placeholder="Dueño">
                                {{-- <option value="EMMANUEL">Emmanuel</option>
                                <option value="ANA">Ana</option> --}}
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_detail" class="form-label">Detalle</label>
                            <textarea name="detail" id="computer_detail" class="form-control" placeholder="Detalles"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_computer" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>


{{-- MODAL DE EDICION --}}

<form id="form_edit_computer">

    {{-- Hidden que almacena el id para hacer la edicion de la Categoría --}}
    <input type="hidden" name="computer" id="computer_id">


    <div class="modal fade" id="md_edit_computer" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="computer_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_computers" style="display: none;">
                        <ul class="m-0" id="lista-errores-computers-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_name" class="form-label">Nombre</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="computer_name_id"
                                placeholder="Nombre de la PC" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_owner" class="form-label">Dueño</label>
                            <div class="select-dinamic-edit">
                                {{-- <select name="owner" class="form-control form-control-sm"
                                    id="computer_owner_id" placeholder="Dueño">
                                    <option value="EMMANUEL">Emmanuel</option>
                                    <option value="ANA">Ana</option>
                                </select> --}}

                                <select name="owner" class="form-control form-control-sm" id="computer_owner_edit" placeholder="Dueño">
                                    <!-- Las opciones se cargarán dinámicamente -->
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="computer_detail_id" class="form-label">Detalle</label>
                            <textarea name="detail" id="computer_detail_id" class="form-control" placeholder="Detalles"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_computer" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>
