<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::put('/update/user/{id}', [AdminController::class, 'update'])->middleware(['auth'])->name('update.user');

Route::get('/inmueble', [InmuebleController::class, 'index'])->middleware(['auth'])->name('inmueble.index');
Route::get('/inmueble/create', [InmuebleController::class, 'create'])->middleware(['auth'])->name('inmueble');
Route::post('/inmueble/paso1', [InmuebleController::class, 'store'])->middleware(['auth'])->name('inmueble.store1');
Route::get('/inmueble/paso2/{edificio_id}', [InmuebleController::class, 'create2'])->middleware(['auth'])->name('inmueble2');
Route::post('/inmueble/paso2', [InmuebleController::class, 'store2'])->middleware(['auth'])->name('inmueble.store2');
Route::get('/inmueble/paso3/{piso_id}', [InmuebleController::class, 'create3'])->middleware(['auth'])->name('inmueble3');
Route::post('/inmueble/paso3', [InmuebleController::class, 'store3'])->middleware(['auth'])->name('inmueble.store3');

Route::get('/inmuebles', [InmuebleController::class, 'userIndex'])->middleware(['auth'])->name('inmueble.userIndex');
Route::get('/inmueble/alquilar/{edificio_id}', [InmuebleController::class, 'alquilar'])->middleware(['auth'])->name('alquilar');
Route::post('/inmueble/alquilar', [InmuebleController::class, 'alquilarInmueble'])->middleware(['auth'])->name('alquilarInmueble');

Route::get('/perfil/{user_id}', [AdminController::class, 'editPersona'])->middleware(['auth'])->name('editar.perfil');
Route::post('/perfil', [AdminController::class, 'updatePersona'])->middleware(['auth'])->name('editar.perfil2');

Route::get('contrato/{contrato_id}', [InmuebleController::class, 'contratoPDF'])->name('contrato');

Route::get('/mis-inmuebles/{user_id}', [InmuebleController::class, 'misInmuebles'])->middleware(['auth'])->name('misInmuebles');
Route::get('/mis-inmuebles/detalle/{contrato_id}', [InmuebleController::class, 'detalleAlquiler'])->middleware(['auth'])->name('detalle-alquiler');
Route::put('/mis-inmuebles/detalle/contrato/{contrato_id}', [InmuebleController::class, 'updateContrato'])->middleware(['auth'])->name('update.contrato');

Route::get('/mis-inmuebles/historial/{user_id}', [InmuebleController::class, 'misInmueblesHistorial'])->middleware(['auth'])->name('misInmuebles-historial');

Route::get('/reporte/fecha', [ReporteController::class, 'reporteFecha'])->middleware(['auth'])->name('reporte.fecha');
Route::post('/reporte/fecha', [ReporteController::class, 'filtrar'])->middleware(['auth'])->name('reporte.filtrar');

Route::get('/reporte/fecha2', [ReporteController::class, 'reporteFecha2'])->middleware(['auth'])->name('reporte.fecha2');
Route::post('/reporte/fecha2', [ReporteController::class, 'filtrar2'])->middleware(['auth'])->name('reporte.filtrar2');

Route::get('/reporte/fecha3', [ReporteController::class, 'reporteFecha3'])->middleware(['auth'])->name('reporte.fecha3');
Route::post('/reporte/fecha3', [ReporteController::class, 'filtrar3'])->middleware(['auth'])->name('reporte.filtrar3');

Route::get('/reporte/fecha4', [ReporteController::class, 'reporteFecha4'])->middleware(['auth'])->name('reporte.fecha4');
Route::post('/reporte/fecha4', [ReporteController::class, 'filtrar4'])->middleware(['auth'])->name('reporte.filtrar4');

require __DIR__.'/auth.php';
