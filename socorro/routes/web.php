<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\DelegacionController;

Route::get('/create-user', [UserController::class,'create_user'])->name('create-user');
Route::get('/', [UserController::class,'login_new'])->name('login');
Route::post('/logear', [UserController::class,'login'])->name('logear');

Route::middleware('auth')->group(function(){
    
    Route::prefix('dashboard')->group(function(){
        Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    });

    Route::prefix('usuarios')->group(function(){
        Route::get('/', [UserController::class,'index'])->name('usuarios');
        Route::get('/data', [UserController::class,'data'])->name('usuarios.data');
        Route::get('/create', [UserController::class,'create'])->name('usuarios.create');
        Route::post('/store', [UserController::class,'store'])->name('usuarios.store');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('usuarios.edit');
        Route::put('/update/{id}', [UserController::class,'update'])->name('usuarios.update');
        Route::delete('/destroy/{id}', [UserController::class,'destroy'])->name('usuarios.destroy');
    });

    Route::prefix('delegaciones')->group(function(){
        Route::get('/', [DelegacionController::class,'index'])->name('delegaciones');
        Route::get('/data', [DelegacionController::class,'data'])->name('delegaciones.data');
        Route::get('/show/{id}', [DelegacionController::class,'show'])->name('delegaciones.show');
        Route::get('/create', [DelegacionController::class,'create'])->name('delegaciones.create');
        Route::post('/store', [DelegacionController::class,'store'])->name('delegaciones.store');
        Route::get('/edit/{id}', [DelegacionController::class,'edit'])->name('delegaciones.edit');
        Route::put('/update/{id}', [DelegacionController::class,'update'])->name('delegaciones.update');
        Route::delete('/destroy/{id}', [DelegacionController::class,'destroy'])->name('delegaciones.destroy');
    });

    Route::prefix('voluntarios')->group(function(){
        Route::get('/', [VoluntarioController::class,'index'])->name('voluntarios');
        Route::get('/data', [VoluntarioController::class,'data'])->name('voluntarios.data');
        Route::get('/show/{id}', [VoluntarioController::class,'show'])->name('voluntarios.show');
        Route::get('/create', [VoluntarioController::class,'create'])->name('voluntarios.create');
        Route::post('/store', [VoluntarioController::class,'store'])->name('voluntarios.store');
        Route::get('/edit/{id}', [VoluntarioController::class,'edit'])->name('voluntarios.edit');
        Route::put('/update/{id}', [VoluntarioController::class,'update'])->name('voluntarios.update');
        Route::delete('/destroy/{id}', [VoluntarioController::class,'destroy'])->name('voluntarios.destroy');
    });

    Route::prefix('inventario')->group(function(){
        Route::get('/', [InventarioController::class,'index'])->name('inventario');
        Route::get('/data', [InventarioController::class,'data'])->name('inventario.data');
        Route::get('/create', [InventarioController::class,'create'])->name('inventario.create');
        Route::post('/store', [InventarioController::class,'store'])->name('inventario.store');
        Route::get('/edit/{id}', [InventarioController::class,'edit'])->name('inventario.edit');
        Route::put('/update/{id}', [InventarioController::class,'update'])->name('inventario.update');
        Route::delete('/destroy/{id}', [InventarioController::class,'destroy'])->name('inventario.destroy');
    });

    Route::prefix('checklist')->group(function(){
        Route::get('/', [ChecklistController::class,'index'])->name('checklist');
        Route::get('/data', [ChecklistController::class,'data'])->name('checklist.data');
        Route::get('/create', [ChecklistController::class,'create'])->name('checklist.create');
        Route::post('/store', [ChecklistController::class,'store'])->name('checklist.store');
        Route::get('/edit/{id}', [ChecklistController::class,'edit'])->name('checklist.edit');
        Route::put('/update/{id}', [ChecklistController::class,'update'])->name('checklist.update');
        Route::delete('/destroy/{id}', [ChecklistController::class,'destroy'])->name('checklist.destroy');
    });

    Route::get('/logout', [UserController::class,'logout'])->name('logout');
});
