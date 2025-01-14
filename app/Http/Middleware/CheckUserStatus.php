<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado y su estado
        if ($user && $user->status == 'inactivo') {
            // Redirige al usuario al login
            Auth::logout(); // Opcional: cierra la sesión del usuario

            session()->flash('error', '(usuario inactivo)');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
