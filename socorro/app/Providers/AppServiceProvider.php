<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\ApiServices;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(ApiServices $apiServices): void
    {

        Gate::define('watch-admin', function (User $user){
            return $user->role == 'admin';
        });

        Gate::define('watch-leader', function (User $user){
            return $user->role == 'leader';
        });

        Gate::define('watch-common', function (User $user){
            return $user->role == 'comun';
        });

        Gate::define('watch-jefe-operaciones', function (User $user){
            return $user->role == 'jefe_operaciones';
        });


        Gate::define('watch-organizador-guardia', function (User $user){
            return $user->role == 'organizador_guardia';
        });

        Gate::define('watch-cuartelero', function (User $user){
            return $user->role == 'cuartelero';
        });

        Gate::define('watch-administrador-nacional', function (User $user){
            return $user->role == 'administrador_nacional';
        });

        Gate::define('watch-comunicaciones', function (User $user){
            return $user->role == 'comunicaciones';
        });


        try {
            $weatherData = $apiServices->consumeApiWeatherSanJosé();
            View::share('weatherData', $weatherData);
        } catch (\Exception $e) {
            Log::error('Error al obtener datos del clima: ' . $e->getMessage());
            View::share('weatherData', null);
        }

        try {
            $weatherData = $apiServices->consumeAPiWeatherLaParva();
            View::share('weatherDataLaParva', $weatherData);
        } catch (\Exception $e) {
            Log::error('Error al obtener datos del clima: ' . $e->getMessage());
            View::share('weatherDataLaParva', null);
        }
    }
}
