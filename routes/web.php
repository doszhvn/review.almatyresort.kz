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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/review', [\App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');
Route::get('/review/success', [\App\Http\Controllers\ReviewController::class, 'success'])->name('review.success');
