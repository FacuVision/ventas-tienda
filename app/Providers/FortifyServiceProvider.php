<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        // Aquí agregamos la autenticación personalizada
        Fortify::authenticateUsing(function (Request $request) {

            $user = User::where('n_document', $request->n_document)->first();

            $request->validate([
                'n_document' => 'required|string', // Valida el número de documento
                'password' => 'required|string',
            ], [
                'n_document.required' => 'El campo N° de documento es obligatorio.',
                'password.required' => 'La contraseña es obligatoria.',
            ]);

            if (!$user || !Hash::check($request->password, $user->password) || $user->status !== "activo") {
                // Si falla la autenticación, muestra un mensaje de error
                session()->flash('error', '(usuario y/o contraseña incorrecta) o usuario inactivo.');
                return null;
            }

            return $user; // Devuelve el usuario autenticado
        });



        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });



        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
