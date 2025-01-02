<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Starter Template - Hero Product : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="icon" type="image/png" sizes="152x152" href="http://192.168.11.13/siscom2024/img/favicon/apple-icon-152x152.png">

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
</head>

<body class="bg-gray-200 font-sans leading-normal tracking-normal">
    <!--Nav-->
    <nav class="bg-gray-800 p-2 mt-0 w-full"> <!-- Add this to make the nav fixed: "fixed z-10 top-0" -->
        <div class="container mx-auto flex flex-wrap items-center">
            <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                    <img style="display: inline-block" src="{{ asset('img/AdminLTELogo.png') }}"
                        width="50px" height="auto">
                    <span style="display: inline-block" class="text-1xl pl-2"> Sistema de control de ventas </span>
                </a>
            </div>

        </div>
    </nav>

    <!--Hero-->
    <div class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24">
        <!--Left Col-->
        <div class="flex flex-col w-full lg:w-1/2 justify-center items-start pt-12 pb-24 px-20">
            <p class="uppercase tracking-loose">SISTEMA DE CONTROL DE VENTAS</p>
            <h1 class="font-bold text-3xl my-4">TIENDA 16</h1>
            <p class="leading-normal mb-4">Permite llevar un registro detallado de los trabajos realizados</p>


         @if (Route::has('login'))
                @auth
                 <span style="padding: 10px; color: green; font-weight: bold">
                    Bienvenido
                </span>

                @else

                @endauth
        @endif

            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/admin') }}" class="bg-transparent hover:bg-green-900 text-green-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-green-900 hover:border-transparent">Ingresar al Panel de Administracion</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-gray-900 hover:border-transparent">Loguearse</a>
                    @endauth
            @endif



        </div>
        <!--Right Col-->
        <div class="w-full lg:w-1/2 lg:py-6 text-center">
            <!--Add your product image here-->
            <img src="{{ asset('img/pc.png') }}" style="margin: 0 0 0 100px" width="50%" srcset="">


        </div>
    </div>

    <!--Container-->
    {{-- <div class="bg-white h-screen">
		<div class="container mx-auto pt-24 md:pt-16 px-6">
			<p class="py-4"><i class="em em-wave"></i> <i class="em em-world_map"></i></p>
		</div>
	</div> --}}

</body>

</html>
