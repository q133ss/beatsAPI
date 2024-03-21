<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Front\AuthController::class, 'login'])->middleware('guest');

Route::get('/logout', function (){
    Auth()->logout();
    return to_route('login');
});

Route::middleware('auth', 'is.admin')->group(function (){
    Route::get('/', function (){
        return to_route('category.index');
    })->name('index');
    Route::resource('category', App\Http\Controllers\Front\CategoryController::class);
    Route::resource('author', App\Http\Controllers\Front\AuthorController::class);
    Route::resource('beat', App\Http\Controllers\Front\BeatController::class);
    Route::resource('user', App\Http\Controllers\Front\UserController::class);
    Route::get('/sales', [App\Http\Controllers\Front\SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{period}', [App\Http\Controllers\Front\SaleController::class, 'period'])->name('sales.period');
    Route::get('/applications', [App\Http\Controllers\Front\ApplicationController::class, 'index'])->name('application.index');
});
