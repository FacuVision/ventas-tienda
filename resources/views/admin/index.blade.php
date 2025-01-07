@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Bienvenido')
@section('content_header_title', 'Inicio')
@section('content_header_subtitle', 'Perfil y Resumen')

{{-- Content body: main page content --}}

@section('content_body')

    <p>
        Bienvenido al panel de administracion del sistema de registro de ventas</p>

    <div class="row">
        <div class="col-lg-4 col-sm-12">

            <x-adminlte-profile-widget name="{{ $user->name }} {{ $user->lastname }}" desc="Trabajador" theme="{{config('app.theme_color')}}"
                img="{{ $user->profile_photo_url }}" id="profile">

                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <input type="hidden" name="color_profile" id="color_profile" value="{{config('app.theme_color')}}">

                <table class="table table-compact">
                    <tbody>
                        <tr>
                            <th scope="row">Documento</th>
                            <td>{{ $user->document_type }} N° {{ $user->n_document }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Telefono</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Direccion</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cambiar color</th>
                            <td>
                                <button type="button" id="create_category_buttom_modal" class="btn btn-primary"
                                    data-toggle="modal" data-target="#md_edit_config">
                                    Cambiar
                                </button>
                            </td>
                            {{--  --}}
                        </tr>
                    </tbody>
                </table>
            </x-adminlte-profile-widget>

        </div>

        <div class="col">
            <div class="card card-outline card-{{config('app.theme_color')}}">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
                        <div class="col">
                            <a href="{{ route('admin.categories.index') }}">

                                <div class="info-box bg-info shadow-on-hover">
                                    <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Categorias</span>
                                        <span class="info-box-number">registros</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.index') }}">
                                <div class="info-box bg-primary shadow-on-hover">
                                    <span class="info-box-icon">
                                        <i class="fas fa-cubes"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Unidades Orgánicas</span>
                                        <span class="info-box-number">registros</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.index') }}">
                                <div class="info-box bg-olive shadow-on-hover ">
                                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Proveedores</span>
                                        <span class="info-box-number">registros</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="{{ route('admin.index') }}">
                                <div class="info-box bg-purple shadow-on-hover">
                                    <span class="info-box-icon"><i class="fas fa-university"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tipos de Contrato</span>
                                        <span class="info-box-number">registros</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('admin.index') }}">
                                <div class="info-box bg-maroon shadow-on-hover">
                                    <span class="info-box-icon"><i class="fas fa-book"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tipos de Documentos</span>
                                        <span class="info-box-number">registros </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <div class="info-box bg-gray shadow-on-hover ">
                                <span class="info-box-icon"><i class="fas fa-regular fa-address-book"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Historial</span>
                                    <span class="info-box-number">10 registros</span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="info-box bg-yellow shadow-on-hover ">
                                <span class="info-box-icon"><i class="fas fa-solid fa-clipboard"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Comprobantes de pago</span>
                                    <span class="info-box-number">10 registros</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('admin.users.componentes.modal_config_partials')


@stop

{{-- Push extra CSS --}}


@push('css')

    <style>
        /* CSS */
        .shadow-on-hover {
            transition: box-shadow 0.1s ease;
            /* Transición suave de 0.3 segundos */
        }

        .shadow-on-hover:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            /* Sombra leve al pasar el mouse */
        }
    </style>
@endpush

{{-- Push extra scripts --}}

@push('js')
    @include('admin.users.componentes.js_users_partials')
@endpush
