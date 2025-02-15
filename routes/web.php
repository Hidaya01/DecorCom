<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\CartController;

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

Route::middleware(['auth'])->group(function () {
    
    //decors (CRUD)
    Route::resource('decors', DecorController::class);

    // Utilisateurs(Admin seulement)
    Route::middleware('check.admin')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
        Route::resource('shops', ShopController::class);
    });

    //Route reviews
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    //Route des commandes
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);

    //Routes de Panier
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/{decor}/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{decor}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});    

//Pour tester
Route::get('/test', function () {
    return 'It works!';
});
