<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);
Route::post('/forgot', [App\Http\Controllers\ForgotController::class, 'forgot']);
Route::get('/forgot/check/token', [App\Http\Controllers\ForgotController::class, 'check']);
Route::post('/reset/password', [App\Http\Controllers\ResetPasswordController::class, 'reset']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/me', function (){
        return Auth()->user();
    });

    Route::get('/my/beats', function (){
        return Auth()->user()->getUserBeats;
    });

    Route::get('/my/payments', function (){
        return Auth()->user()->getUserPayments()->paginate(15);
    });

    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);

    Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store']);
});

Route::group(['middleware' => ['auth:sanctum', 'is.admin'], 'prefix' => 'admin'], function(){
    Route::get('/category/parent', [App\Http\Controllers\Admin\CategoryController::class, 'getParent']);
    Route::get('/category/child/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'getChild']);
    Route::apiResource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::apiResource('author', App\Http\Controllers\Admin\AuthorController::class);
    Route::apiResource('beat', App\Http\Controllers\Admin\BeatController::class);
    Route::apiResource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('/sales', [App\Http\Controllers\Admin\SaleController::class, 'index']);
    Route::get('/sales/{period}', [App\Http\Controllers\Admin\SaleController::class, 'period'])->where('period', 'day|week|month|year');
});

Route::get('/category/parent', [App\Http\Controllers\Admin\CategoryController::class, 'getParent']);
Route::get('/category/child/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'getChild']);
Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index']);
Route::get('/beat/{id}', [App\Http\Controllers\BeatController::class, 'show']);
Route::post('/pay', [App\Http\Controllers\PayController::class, 'pay']);
