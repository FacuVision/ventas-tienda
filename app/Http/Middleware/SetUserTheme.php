<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class SetUserTheme
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el campo `theme_settings` del usuario autenticado
            $user = Auth::user();

            // Configurar un valor dinámico
            config(['app.theme_color' => $user->theme_settings]);
            // Obtiene el primer rol, por lo general solo se utilizará un solo rol por usuario
            config(['app.user_role' => $user->roles[0]->name_detail]);
        }

        // Continuar con la solicitud
        return $next($request);
    }
}
