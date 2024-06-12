<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BomberoController,
    UserController,
    DashboardController,
    LoginController,
};


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
    return redirect('/login');
})->middleware('guest');

/**
 * Rutas de Profesor
 */
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::resource('/login', LoginController::class)->names('login')->middleware('guest');



Route::middleware('auth')->group(function () {
    Route::get('/panel', [DashboardController::class, 'index'])->name('admin.panel.index');

    Route::resource('/bomberos', BomberoController::class)->names('admin.bomberos');
    Route::resource('/equipos', UserController::class)->names('admin.equipos');
    Route::resource('/incidencias', UserController::class)->names('admin.incidencias');
    Route::resource('/formatos', UserController::class)->names('admin.formatos');
    Route::resource('/usuarios', UserController::class)->names('admin.usuarios');
});