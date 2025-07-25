<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Gate::define('watch-admin', function (User $user){
            return $user->role == 'admin';
        });

        Gate::define('watch-leader', function (User $user){
            return $user->role == 'leader';
        });

        Gate::define('watch-common', function (User $user){
            return $user->role == 'comun';
        });
    }
}
