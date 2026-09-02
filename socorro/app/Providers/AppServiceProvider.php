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

        Gate::define('watch-admin', fn (User $user) => $user->role === 'admin');

        Gate::define('watch-leader', function (User $user){
            return $user->role == 'leader' || $user->hasPermission('rescues.manage');
        });

        Gate::define('watch-common', function (User $user){
            return $user->role == 'comun';
        });

        Gate::define('view-rescue-records', function (User $user) {
            return $user->role !== 'comun' && $user->hasPermission('rescues.manage');
        });

        Gate::define('watch-jefe-operaciones', function (User $user){
            return $user->role == 'jefe_operaciones' || $user->hasPermission('rescues.manage');
        });


        Gate::define('watch-organizador-guardia', function (User $user){
            return $user->role == 'organizador_guardia' || $user->hasPermission('calendar.manage');
        });

        Gate::define('manage-guards', fn (User $user) => in_array($user->role, ['admin', 'organizador_guardia'], true));

        Gate::define('watch-cuartelero', function (User $user){
            return $user->role == 'cuartelero' || $user->hasPermission('inventory.manage');
        });

        Gate::define('watch-administrador-nacional', function (User $user){
            return $user->role == 'administrador_nacional' || $user->hasPermission('users.manage');
        });

        Gate::define('watch-comunicaciones', function (User $user){
            return $user->role == 'comunicaciones' || $user->hasPermission('news.manage');
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
