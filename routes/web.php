<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolisaOsiguranjaController;
use App\Http\Controllers\novi;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminPanelController;

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

Route::get('/osiguranje', [PolisaOsiguranjaController::class, 'metoda']);

Route::post('/osiguranje/dodajPolisu', [PolisaOsiguranjaController::class, 'dodajPolisu']);

Route::get('/blog', [BlogController::class, 'metoda']);

Route::get('/adminPanel', [AdminPanelController::class, 'metoda']);

Route::get('/adminPanel/server', [AdminPanelController::class, 'metodaServer']);

Route::get('/adminPanel/blog', [AdminPanelController::class, 'svePolise']);