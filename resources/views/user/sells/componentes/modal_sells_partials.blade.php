{{-- MODAL DE CREACION --}}
{{--
<form id="form_create_job_modal">
    <div class="modal fade" id="md_create_job" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar una Computadora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body"> --}}

{{-- DIV DE ERRORES --}}
{{-- <div class="alert alert-danger" id="alerta_create_jobs" style="display: none;">
                        <ul class="m-0" id="lista-errores-jobs-create"></ul>
                    </div> --}}
{{-- FIN DE DIV DE ERRORES --}}
{{-- <div class="form-group">
                        <div class="mb-3">
                            <label for="job_name" class="form-label">Nombre</label>
                            <input autocomplete="off" type="text" class="form-control" name="name" id="job_name"
                                placeholder="Nombre de la PC" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="job_owner" class="form-label">Dueño</label>
                            <select name="owner" class="form-control form-control-sm" id="job_owner_create"
                                placeholder="Dueño"> --}}
{{-- <option value="EMMANUEL">Emmanuel</option>
                                <option value="ANA">Ana</option> --}}
{{-- </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="job_detail" class="form-label">Detalle</label>
                            <textarea name="detail" id="job_detail" class="form-control" placeholder="Detalles"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_job" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form> --}}

{{-- MODAL DE EDICION --}}

<form id="form_edit_job">

    {{-- Hidden que almacena el id para hacer la edicion de la Categoría --}}
    <input type="hidden" name="job" id="job_id">


    <div class="modal fade" id="md_edit_job" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="job_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_jobs" style="display: none;">
                        <ul class="m-0" id="lista-errores-jobs-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">

                        <div class="row">
                            <div class="col col-2">
                                <div class="mb-3">
                                    <label for="id" class="form-label">Id</label>
                                    <input type="text" class="form-control form-control-sm" readonly name="id"
                                        id="job_text_id" />
                                </div>
                            </div>

                            <div class="col col-4">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Fecha</label>
                                    <input type="date" class="form-control form-control-sm" readonly name="date" id="date_id" />
                                </div>
                            </div>

                            <div class="col col-6">
                                <div class="mb-3">
                                    <label for="status_job" class="form-label">Estado</label>
                                    <select name="status" class="form-control form-control-sm" id="status_job_id">
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Solo cambiar en caso de
                                        equivocaciones, una vez modificado no se podrá agregar registros</small>

                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3"> --}}
                                    {{-- <label for="pay_status_job" class="form-label">Estado de pago</label>
                                    <select name="pay_status" class="form-control form-control-sm" id="pay_status_id">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="cancelado">Cancelado</option>
                                        <option value="anulado">Anulado</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Modificar cuando se haya
                                        terminado la jornada laboral</small> --}}
                                {{-- </div>
                            </div>
                        </div> --}}


                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="observations" class="form-label">Observaciones (*)</label>
                                    <textarea class="form-control form-control-sm" name="observations" id="observations_id" rows="3"></textarea>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3" id="div_close_sell">

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_job" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>
