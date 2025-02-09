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

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::get('/review/{branch_slug}', [\App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/reviews/{branch_slug}', [\App\Http\Controllers\Admin\AdminController::class, 'review_list'])->name('review.list');
    Route::get('/reports/{branch_slug}', [\App\Http\Controllers\Admin\AdminController::class, 'director_reports'])->name('reports.list');
});
