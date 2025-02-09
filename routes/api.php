<?php

use App\Http\Controllers\Admin\StatisticsController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me'])->name('api.me');

});

Route::post('/review/create', [\App\Http\Controllers\ReviewController::class, 'create'])->name('review.create');
Route::get('/review/statistics', [\App\Http\Controllers\ReviewController::class, 'statistics'])->name('review.statistics');
Route::get('/statistics/{branchId}/{monthYear}', [StatisticsController::class, 'statistics']);
