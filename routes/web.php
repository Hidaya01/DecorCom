<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DecorController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.admin'])->group(function () {
    Route::resource('decors', DecorController::class);
});
Route::resource('decors', DecorController::class);

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
