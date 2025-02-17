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
    Route::get('decors/{decor}', [DecorController::class, 'show'])->name('decors.show');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    //Import Export Excel
    Route::post('decors/import', [DecorController::class, 'import'])->name('decors.import');
    Route::get('decors/export', [DecorController::class, 'export'])->name('decors.export');


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
    Route::resource('cart', CartController::class)->except(['create', 'show']);
    Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('cart/pdf', [CartController::class, 'generatePDF'])->name('cart.pdf');

});    

//Pour tester
Route::get('/test', function () {
    return 'It works!';
});
