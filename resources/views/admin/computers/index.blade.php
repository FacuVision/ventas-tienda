@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Computadoras')
@section('content_header_title', 'Computadoras')
@section('content_header_subtitle', 'Listado de computadoras')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}
    <div class="card card-outline card-{{config('app.theme_color')}}">
        <div class="card-header text-center">
            <i class="fas fa-laptop"></i>
            <strong>
                Computadoras
            </strong>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" id="create_computer_buttom_modal" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#md_create_computer">
                    Crear registro
                </button>
            </div>

            <table id="computers-table" class="table-striped table-hover dt-responsive nowrap display compact"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Dueño</th>
                        <th>Detalle</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Primero se definen los partials --}}
    @include('admin.computers.componentes.modal_computers_partials')
@stop

{{-- Push extra CSS --}}

@push('css')


@endpush

{{-- Push extra scripts --}}

@push('js')

    @include('admin.computers.componentes.js_computers_partials')

@endpush
