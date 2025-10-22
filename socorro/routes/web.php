<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\DelegacionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MaindrawController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\SendOutController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\PostulationController;
use App\Http\Controllers\PostulationsPeopleController;

Route::get('/', [MaindrawController::class,'index'])->name('maindraw');
Route::get('/create-user', [UserController::class,'create_user'])->name('create-user');
Route::get('/login', [UserController::class,'login_new'])->name('login');
Route::post('/logear', [UserController::class,'login'])->name('logear');

Route::post('contact', [MainDrawController::class, 'store'])->name('contact');

Route::prefix('departure')->group(function(){
    Route::post('/create', [SendOutController::class, 'store'])->name('departure.create');
    Route::post('/search', [SendOutController::class, 'search'])->name('departure.search');
    Route::post('/finish', [SendOutController::class, 'finish'])->name('departure.finish');
});

Route::post('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donations/callback', [DonationController::class, 'callback'])->name('donations.callback');

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

    Route::prefix('postulations')->group(function(){
        Route::get('/voluntaries/data/{id}', [PostulationController::class, 'voluntariesData'])->name('postulations.voluntaries.data');
        Route::get('/data/{id}', [PostulationController::class, 'data'])->name('postulations.data');
        Route::post('/store', [PostulationController::class, 'store'])->name('postulations.store');
        Route::get('/details/{id}', [PostulationController::class, 'details'])->name('postulations.details');
    });

    Route::prefix('postulations-people')->group(function(){
        Route::get('/data/{id}', [PostulationsPeopleController::class, 'data'])->name('postulations-people.data');
        Route::post('/store', [PostulationsPeopleController::class, 'store'])->name('postulations-people.store');
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
        Route::post('/emergency', [VoluntarioController::class,'emergencyStore'])->name('voluntarios.emergency');
        Route::post('/remark', [VoluntarioController::class,'remarkStore'])->name('voluntarios.remark');
        Route::get('/edit/{id}', [VoluntarioController::class,'edit'])->name('voluntarios.edit');
        Route::put('/update/{id}', [VoluntarioController::class,'update'])->name('voluntarios.update');
        Route::delete('/destroy/{id}', [VoluntarioController::class,'destroy'])->name('voluntarios.destroy');
    });

    Route::prefix('inventario')->group(function(){
        Route::get('/', [InventarioController::class,'index'])->name('inventario');
        Route::get('/data', [InventarioController::class,'data'])->name('inventario.data');
        Route::get('/warehouse/data', [InventarioController::class,'dataWarehouse'])->name('inventario.warehouse');
        Route::get('/category/data', [InventarioController::class,'dataCategory'])->name('inventario.category');
        Route::get('/stock_movements', [InventarioController::class,'stock_movements'])->name('inventario.stock_movements');
        Route::post('/reduce_stock', [InventarioController::class,'reduce_stock'])->name('inventario.reduce_stock');
        Route::get('/create', [InventarioController::class,'create'])->name('inventario.create');
        Route::post('/store', [InventarioController::class,'store'])->name('inventario.store');
        Route::post('/category', [InventarioController::class, 'categoryStore'])->name('inventario.category');
        Route::post('/warehouse', [InventarioController::class, 'warehouseStore'])->name('inventario.warehouse');
        Route::get('/show/{id}', [InventarioController::class,'show'])->name('inventario.show');
        Route::get('/edit/{id}', [InventarioController::class,'edit'])->name('inventario.edit');
        Route::put('/update/{id}', [InventarioController::class,'update'])->name('inventario.update');
        Route::post('/add_stock', [InventarioController::class,'addStock'])->name('inventario.add_stock');
        Route::delete('/destroy/{id}', [InventarioController::class,'destroy'])->name('inventario.destroy');
    });

    Route::prefix('checklist')->group(function(){
        Route::get('/categoria', [ChecklistController::class,'categoria'])->name('checklist.categoria');
        Route::get('/respuesta', [ChecklistController::class,'respuesta'])->name('checklist.respuesta');
        Route::get('/categoria/data', [ChecklistController::class,'data'])->name('checklist.categoria.data');
        Route::get('/question/data/{id}', [ChecklistController::class,'questionData'])->name('checklist.question.data');
        Route::post('/categoria/store', [ChecklistController::class,'categoriaStore'])->name('checklist.categoria.store');
        Route::post('/question/store', [ChecklistController::class,'questionStore'])->name('checklist.question.store');
        Route::put('/categoria/update/{id}', [ChecklistController::class,'update'])->name('checklist.update');
        Route::delete('/categoria/destroy/{id}', [ChecklistController::class,'destroy'])->name('checklist.destroy');
    });

    Route::prefix('vehiculo')->group(function(){
        Route::get('/', [VehiculoController::class,'index'])->name('vehiculo');
        Route::get('/data', [VehiculoController::class,'data'])->name('vehiculo.data');
        Route::get('/brand/data', [VehiculoController::class,'brandData'])->name('vehiculo.brand.data');
        Route::get('/model/data', [VehiculoController::class,'modelData'])->name('vehiculo.model.data');
        Route::post('/store', [VehiculoController::class,'Store'])->name('vehiculo.store');
        Route::post('/brand/store', [VehiculoController::class,'brandStore'])->name('vehiculo.brand.store');
        Route::post('/model/store', [VehiculoController::class,'modelStore'])->name('vehiculo.model.store');
        Route::put('/update/{id}', [VehiculoController::class,'update'])->name('vehiculo.update');
        Route::delete('/destroy/{id}', [VehiculoController::class,'destroy'])->name('vehiculo.destroy');
        Route::get('/show/{id}', [VehiculoController::class,'show'])->name('vehiculo.show');
        Route::post('/document/store', [VehiculoController::class,'documentStore'])->name('vehiculo.document.store');
        Route::post('/maintenance/store', [VehiculoController::class,'maintenanceStore'])->name('vehiculo.maintenance.store');
    });

    Route::prefix('calendario')->group(function(){
        Route::get('/', [ScheduleController::class, 'index'])->name('calendario');
        Route::post('/store', [ScheduleController::class, 'store'])->name('calendario.store');
        Route::get('/events', [ScheduleController::class, 'getEvents'])->name('calendario.events');
        Route::delete('/destroy/{id}', [ScheduleController::class, 'destroy'])->name('calendario.destroy');

        Route::get('/dataGuard/{id}', [ScheduleController::class, 'dataGuard'])->name('calendario.dataGuard');
        Route::post('/assistant/store', [ScheduleController::class, 'storeGuard'])->name('calendario.assistant.store');
        Route::delete('/assistant/destroy/{id}', [ScheduleController::class, 'destroyGuard'])->name('calendario.assistant.destroy');

        Route::post('/file/store', [ScheduleController::class, 'storeFile'])->name('calendario.file.store');
        Route::get('/dataFile/{id}', [ScheduleController::class, 'dataFile'])->name('calendario.dataFile');
    });

    Route::prefix('contacto')->group(function(){
        Route::get('/', [ContactFormController::class, 'index'])->name('contacto');
        Route::get('/data', [ContactFormController::class, 'data'])->name('contacto.data');
    });

    Route::prefix('aviso')->group(function(){
        Route::get('/', [SendOutController::class, 'list'])->name('aviso.list');
        Route::get('/data', [SendOutController::class, 'data'])->name('aviso.data');
        Route::get('/download/{id}', [SendOutController::class, 'download'])->name('aviso.download');
    });

    Route::prefix('registro-rescate')->group(function(){
        Route::get('/', [RescueController::class, 'index'])->name('registro-rescate');
        Route::get('/data', [RescueController::class, 'data'])->name('registro-rescate.data');
        Route::post('/store', [RescueController::class, 'store'])->name('registro-rescate.store');
        Route::get('/edit/{id}', [RescueController::class, 'edit'])->name('registro-rescate.edit');
        Route::put('/update/{id}', [RescueController::class, 'update'])->name('registro-rescate.update');
        Route::delete('/destroy/{id}', [RescueController::class, 'destroy'])->name('registro-rescate.destroy');
    });

    Route::get('/logout', [UserController::class,'logout'])->name('logout');
});
