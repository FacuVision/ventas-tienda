@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Bienvenido')
@section('content_header_title', 'Inicio')
@section('content_header_subtitle', 'Resumen')

{{-- Content body: main page content --}}

@section('content_body')
    <p>Welcome to this beautiful admin panel.</p>

    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
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
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush
