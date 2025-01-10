{{-- MODAL DE CREACION --}}

<form id="form_create_user">
    <div class="modal fade" id="md_create_user" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar un nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_create_users" style="display: none;">
                        <ul class="m-0" id="lista-errores-users-create"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}
                    <div class="form-group">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Nombres</label>
                                    <input name="name" id="user_name" autocomplete="off"
                                        class="form-control form-control-sm" type="text" placeholder="Nombres">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="user_lastname" class="form-label">Apellidos</label>
                                    <input name="lastname" id="user_lastname" autocomplete="off"
                                        class="form-control form-control-sm" type="text" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="user_document_type" class="form-label">Tipo de documento</label>
                                    <select name="document_type" class="form-control form-control-sm"
                                        id="user_document_type" placeholder="Tipo de documento">
                                        <option value="DNI">DNI</option>
                                        <option value="PASAPORTE">Pasaporte</option>
                                        <option value="CARNET DE EXTRANJERIA">Carnet de extranjeria</option>
                                        <option value="CEDULA DE IDENTIDAD">Cedula de identidad</option>
                                        <option value="PTP">PTP</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="user_n_document" class="form-label">Número de documento</label>
                                    <input name="n_document" id="user_n_document" autocomplete="off"
                                        class="form-control form-control-sm" type="text"
                                        placeholder="N° de Documento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Correo Electronico</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="email"
                                            id="user_email" placeholder="Correo electrónico">
                                        <span class="input-group-text form-control-sm"> <i
                                                class="fas fa-envelope-open"></i> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Numero Celular</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="phone"
                                            id="user_phone" placeholder="Número de Celular">
                                        <span class="input-group-text form-control-sm"> <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Direccion</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="address"
                                            id="user_address" placeholder="Dirección">
                                        <span class="input-group-text form-control-sm"> <i class="fas fa-home"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="select_roles" class="form-label">Rol de acceso</label>
                                    <select name="select_roles" class="form-control form-control-sm"
                                        id="user_select_roles"
                                        data-placeholder="Selecciona un rol de acceso para el usuario"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_create"
                        data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" id="bt_create_user" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>


{{-- MODAL DE EDICION --}}

<form id="form_edit_user">

    {{-- Hidden que almacena el id para hacer la edicion de la unidad orgánica --}}
    <input type="hidden" name="user_id" id="user_id">


    <div class="modal fade" id="md_edit_user" tabindex="-1" role="dialog" aria-hidden="true"
        data-keyboard="false" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar <span id="user_title" style="font-weight: bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- DIV DE ERRORES --}}
                    <div class="alert alert-danger" id="alerta_edit_users" style="display: none;">
                        <ul class="m-0" id="lista-errores-users-edit"></ul>
                    </div>
                    {{-- FIN DE DIV DE ERRORES --}}

                    <div class="form-group">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name_edit" class="form-label">Nombres</label>
                                    <input name="name_edit" id="name_edit" autocomplete="off"
                                        class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="lastname_edit" class="form-label">Apellidos</label>
                                    <input name="lastname_edit" id="lastname_edit" autocomplete="off"
                                        class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="document_type_edit" class="form-label">Tipo de documento</label>
                                    <select name="document_type_edit" class="form-control form-control-sm"
                                        id="document_type_edit" placeholder="Tipo de documento">
                                        <option value="DNI">DNI</option>
                                        <option value="PASAPORTE">Pasaporte</option>
                                        <option value="CARNET DE EXTRANJERIA">Carnet de extranjeria</option>
                                        <option value="CEDULA DE IDENTIDAD">Cedula de identidad</option>
                                        <option value="PTP">PTP</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="n_document_edit" class="form-label">Número de documento</label>
                                    <input name="n_document_edit" id="n_document_edit" autocomplete="off"
                                        class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="email_edit" class="form-label">Correo Electronico</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="email_edit"
                                            id="email_edit">
                                        <span class="input-group-text form-control-sm"> <i
                                                class="fas fa-envelope-open"></i> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone_edit" class="form-label">Numero Celular</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="phone_edit"
                                            id="phone_edit">
                                        <span class="input-group-text form-control-sm"> <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="address_edit" class="form-label">Direccion</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm"
                                            name="address_edit" id="address_edit">
                                        <span class="input-group-text form-control-sm"> <i class="fas fa-home"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="select_roles_edit" class="form-label">Rol de acceso</label>
                                    <select name="edit_select_roles" class="form-control form-control-sm"
                                        id="select_roles_edit"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_edit"
                        data-dismiss="modal">Cerrar</button>

                    <input type="submit" value="Actualizar" id="bt_edit_user" class="btn btn-primary">


                </div>
            </div>
        </div>
    </div>
</form>

{{-- MODAL DE VISUALIZACION --}}

<div class="modal fade" id="md_show_user" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <span id="user_title_show" style="font-weight: bold"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="informacion" class="form-label">Inormacion</label>
                                <div class="input-group mb-3">
                                    <div id="informacion"></div>
                                </div>
                                <label for="sesion" class="form-label">Sesion y permisos</label>
                                <div class="input-group mb-3">
                                    <div id="sesion"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_create"
                    data-dismiss="modal">Cerrar</button>
                <input type="submit" value="Ver historial" id="bt_historial" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
