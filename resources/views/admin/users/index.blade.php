@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Usuarios')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Listado de usuarios')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}
    <div class="card card-outline card-{{config('app.theme_color')}}">
        <div class="card-header text-center">
            <i class="fas fa-users"></i>
            <strong>
                Usuarios
            </strong>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" id="create_user_buttom_modal" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#md_create_user">
                    Crear registro
                </button>
            </div>

            <table id="users-table" class="table-striped table-hover dt-responsive nowrap display compact"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tipo de documento</th>
                        <th>Número de documento</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Primero se definen los partials --}}
    @include('admin.users.componentes.modal_users_partials')
@stop

{{-- Push extra CSS --}}

@push('css')


@endpush

{{-- Push extra scripts --}}

@push('js')

    @include('admin.users.componentes.js_users_partials')

@endpush
