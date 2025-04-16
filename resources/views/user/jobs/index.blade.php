@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Jornada')
@section('content_header_title', 'Jornada')
@section('content_header_subtitle', 'Inicio')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- <p>Aqui puedes gestionar las distintas Unidades Orgánicas de la entidad</p> --}}

    <div class="row">
        <div class="col col-lg-3 col-12">
            <div class="card card-outline card-{{ config('app.theme_color') }}" style="overflow-x: auto;">
                <div class="card-header text-center">
                    <i class="fas fa-plus"></i>
                    <strong>
                        Registrar una nueva jornada
                    </strong>
                </div>


                <div class="card-body">

                    <div class="alert alert-danger" id="alerta_create_jobs" style="display: none;">
                        <ul class="m-0" id="lista-errores-jobs-create"></ul>
                    </div>

                    <form id="form_create_job" style="max-width: 100%;">
                        <div class="form-group">

                            <div class="mb-3">
                                <label for="date_start_create" class="form-label">Fecha</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control form-control-sm" name="date_start_create"
                                        id="date_start_create_id">
                                    <span class="input-group-text form-control-sm"> <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="select_computer_create" class="form-label">Computadora</label>
                                <select name="select_computer_create" class="form-control form-control-sm"
                                    id="select_computer_create_id"></select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success btn-sm">
                            Crear
                        </button>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-{{ config('app.theme_color') }}" style="overflow-x: auto;">

                <div class="card-header text-center">
                    <i class="fas fa-eye"></i>
                    <strong>
                        Detalle de jornada
                    </strong>
                </div>

                <div class="card-body">

                    <ol id="job_deail_list_id">

                    </ol>
                </div>
            </div>

        </div>

        <div class="col col-lg-9 col-12">
            <div class="card card-outline card-{{ config('app.theme_color') }}">
                <div class="card-header text-center">
                    <i class="fas fa-table"></i>
                    <strong>
                        Jornada de trabajo
                    </strong>
                </div>
                <div class="card-body">

                    <table id="jobs-table" class="table-striped table-hover dt-responsive nowrap display compact"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Estado</th>
                                <th>Pc Nombre</th>
                                <th>Pc Dueño</th>
                                <th>Pago</th>
                                <th>Fecha de trabajo</th>
                                <th>Fecha y hora de cierre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



@stop

{{-- Primero se definen los partials --}}
@include('user.jobs.componentes.modal_jobs_partials')


{{-- Push extra CSS --}}

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
    @include('user.jobs.componentes.js_jobs_partials')
@endpush
