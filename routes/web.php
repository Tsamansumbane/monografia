<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonografiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WhitelistController;
use App\Http\Controllers\TipoNoticiaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('monografias')->name('monografias.')->group(function () {
    Route::get('/', [MonografiaController::class, 'index'])->name('index')->middleware('auth');
    Route::post('/store', [MonografiaController::class, 'store'])->name('store')->middleware('auth');
});

Route::get('/', [MonografiaController::class, 'index'])->name('monografias')->middleware('auth');
Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard') ->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout') ->middleware('auth');

// White list
Route::get('/whitelist', [WhitelistController::class, 'index'])->name('whitelist.index')->middleware('auth');
Route::post('/whitelist', [WhitelistController::class, 'store'])->name('whitelist.store')->middleware('auth');


// Noticias e tipos
Route::get('/tipos/create', [TipoNoticiaController::class, 'createTipo'])->name('tipos.create');
Route::post('/tipos/create', [TipoNoticiaController::class, 'storeTipo'])->name('tipos.store');

Route::get('/noticias/create', [TipoNoticiaController::class, 'createNoticia'])->name('noticias.create');
Route::post('/noticias/create', [TipoNoticiaController::class, 'storeNoticia'])->name('noticias.store');


