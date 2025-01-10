<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RunAfterLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verificar si esta es la primera solicitud después de un login
        //Esta bandera la crea el Evento "MARKFIRSTLOGIN"
        if (Session::has('first_login')) {
            // Ejecutar la lógica necesaria
            // Por ejemplo, registrar una acción o actualizar algo
            Log::info('Lógica ejecutada después del login para el usuario: ' . $request->user()->id);

            // Eliminar la bandera para evitar que se ejecute en futuras solicitudes
            Session::forget('first_login');
        }

        return $next($request);
    }
}
