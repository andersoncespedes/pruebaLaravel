<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productoController;
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

    Route::post('/guardar', [productoController::class, "Guardar"]);
    Route::get('/obtener', [productoController::class, "Obtener"]);
    Route::post('/actualizar/{id}', [productoController::class, "Actualizar"]);
    Route::get('/buscarRelacion', [productoController::class, "ObtenerDatosRelacionados"]);





