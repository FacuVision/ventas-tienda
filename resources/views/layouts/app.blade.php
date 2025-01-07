@extends('adminlte::page')


{{-- Extend and customize the browser title --}}

@section('title')

    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

<input type="hidden" name="sidebar" id="sidebar" value="{{config('app.theme_color')}}">


{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>



    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'Tienda 16') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    <script>
        $(document).ready(function() {
            $(document).ready(function() {

                // Inicializar el color y asignarlo al elemento correspondiente
                const inicialColorSideBar = $("#sidebar").val();
                actualizarMuestraColorSideBar(inicialColorSideBar);

                // Función para actualizar la muestra de color
                function actualizarMuestraColorSideBar(color) {
                    $(".main-sidebar").removeClass("sidebar-dark").addClass(
                    `sidebar-dark-${color}`); // Agrega la nueva clase

                }
            });

        });
    </script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"> <!-- Para favicon.ico --> --}}
    <link rel="icon" type="image/png" href="{{ asset('img/AdminLTELogo.png') }}"> <!-- Para favicon.png -->
@endpush
