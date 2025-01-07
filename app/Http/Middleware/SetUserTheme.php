<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetUserTheme
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el campo `theme_settings` del usuario autenticado
            $theme = Auth::user()->theme_settings;

            // Configurar un valor dinámico
            config(['app.theme_color' => $theme]);
        }

        // Continuar con la solicitud
        return $next($request);
    }
}
