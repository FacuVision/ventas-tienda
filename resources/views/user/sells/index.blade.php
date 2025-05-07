@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Ventas')
@section('content_header_title', 'Ventas')
@section('content_header_subtitle', 'Inicio')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}

    <div class="row">
        <div class="col col-lg-3 col-12">
            <div class="card card-outline card-{{ config('app.theme_color') }}" style="overflow-x: auto;">
                <div class="card-header text-center">
                    <i class="fas fa-keyboard"></i>
                    <strong>
                        Registrar Trabajo
                    </strong>
                </div>


                <div class="card-body">

                    <div class="alert alert-danger" id="alerta_create_sells" style="display: none;">
                        <ul class="m-0" id="lista-errores-sells-create"></ul>
                    </div>

                    <form id="form_create_sell" style="max-width: 100%;" class="mb-0">
                        <div class="form-group">

                            <div class="mb-3">
                                <label for="select_category" class="form-label">Categoria</label>
                                <select name="select_category" class="form-control form-control-sm"
                                    id="select_category_id"></select>
                            </div>

                            <div class="mb-3">
                                <label for="select_description" class="form-label">Descripcion</label>
                                <input type="text" name="description" id="total_mount_paper_id"
                                    class="form-control form-control-sm">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div>
                                        <label for="total_mount_paper" class="form-label">Precio</label>
                                        <input type="text" name="total_mount_paper" id="total_mount_paper_id"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col">

                                    <div>
                                        <label for="select_payment_type" class="form-label">Tipo de pago</label>
                                        <select name="payment_type" class="form-control form-control-sm"
                                            id="payment_type_id"></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-{{ config('app.theme_color') }}" style="overflow-x: auto;">

                <div class="card-header text-center">
                    <i class="fas fa-folder"></i>
                    <strong>
                        Registrar papelería
                    </strong>
                </div>

                <div class="card-body">

                    <div class="alert alert-danger" id="alerta_create_sells" style="display: none;">
                        <ul class="m-0" id="lista-errores-sells-create"></ul>
                    </div>

                    <form id="form_create_paper" style="max-width: 100%;" class="mb-0">
                        <div class="form-group">

                            <div class="mb-3">
                                <label for="select_paper_create" class="form-label">Producto</label>
                                <select name="select_paper_create" class="form-control form-control-sm"
                                    id="select_paper_create_id"></select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="quantity_paper" class="form-label">Cantidad</label>
                                        <input type="number" name="quantity_paper" id="quantity_paper_id"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="total_mount_paper" class="form-label">Precio</label>
                                        <input type="text" name="total_mount_paper" id="total_mount_paper_id"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subtotal_paper" class="form-label">Subtotal</label>
                                <input type="text" name="subtotal_paper" id="subtotal_paper_id"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-12">
            <div class="card card-{{ config('app.theme_color') }}">
                <div class="card-header text-center">
                    <i class="fas fa-table"></i>
                    <strong>
                        Trabajos
                    </strong>
                </div>
                <div class="card-body">

                    <table id="sells-table" class="table-striped table-hover dt-responsive nowrap display compact"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Categoria</th>
                                <th>Descripcion</th>
                                <th>Tipo de pago</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Fecha/Hora de registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-{{ config('app.theme_color') }}">
                <div class="card-header text-center">
                    <i class="fas fa-table"></i>
                    <strong>
                        Papelería
                    </strong>
                </div>
                <div class="card-body">

                    <table id="papers-table" class="table-striped table-hover dt-responsive nowrap display compact"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col col-lg-3 col-12">
            <div class="card card-navy">
                <div class="card-header text-center">
                    <i class="fas fa-pen"></i>
                    <strong>
                        Resumen (Jornada ID) <span id="job_id"></span>
                    </strong>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover dt-responsive nowrap display compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Column 1</th>
                                    <th scope="col">Column 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td scope="row">R1C1</td>
                                    <td>R1C2</td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Item</td>
                                    <td>Item</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="card footer"></div>
            </div>


        </div>


    </div>



@stop

{{-- Primero se definen los partials --}}
{{-- @include('user.sells.componentes.modal_sells_partials') --}}


{{-- Push extra CSS --}}

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
    @include('user.sells.componentes.js_sells_partials')
@endpush
