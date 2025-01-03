@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Categorias')
@section('content_header_title', 'Categorias')
@section('content_header_subtitle', 'Listado de categorias')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <i class="fas fa-cubes"></i>
            <strong>
                Categorias
            </strong>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" id="create_category_buttom_modal" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#md_create_category">
                    Crear registro
                </button>
            </div>

            <table id="categories-table" class="table-striped table-hover dt-responsive nowrap display compact"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
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
    @include('admin.categories.componentes.modal_categories_partials')
@stop

{{-- Push extra CSS --}}

@push('css')


@endpush

{{-- Push extra scripts --}}

@push('js')

    @include('admin.categories.componentes.js_categories_partials')

@endpush
