<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ChecklistController;

Route::get('/create-user', [UserController::class,'create_user'])->name('create-user');
Route::get('/', [UserController::class,'login_new'])->name('login');
Route::post('/logear', [UserController::class,'login'])->name('logear');

Route::middleware('auth')->group(function(){
    
    Route::prefix('dashboard')->group(function(){
        Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    });

    Route::prefix('usuarios')->group(function(){
        Route::get('/', [UserController::class,'index'])->name('usuarios');
        Route::get('/create', [UserController::class,'create'])->name('usuarios.create');
        Route::post('/store', [UserController::class,'store'])->name('usuarios.store');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('usuarios.edit');
        Route::put('/update/{id}', [UserController::class,'update'])->name('usuarios.update');
        Route::delete('/destroy/{id}', [UserController::class,'destroy'])->name('usuarios.destroy');
    });

    Route::prefix('voluntarios')->group(function(){
        Route::get('/', [VoluntarioController::class,'index'])->name('voluntarios');
    });

    Route::prefix('inventario')->group(function(){
        Route::get('/', [InventarioController::class,'index'])->name('inventario');
    });

    Route::prefix('checklist')->group(function(){
        Route::get('/', [ChecklistController::class,'index'])->name('checklist');
    });

    Route::get('/logout', [UserController::class,'logout'])->name('logout');
});
