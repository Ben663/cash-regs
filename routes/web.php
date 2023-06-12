<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
 
// Route::get('/connecting', function () {
//    return view('connecting');
// });

Route::get('/', [ProductsController::class, 'index']);
Route::get('cart-favorite', [ProductsController::class, 'index']);
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::post('cart-favorite', [ProductsController::class, 'index'])->name('cart/{id}');
Route::patch('update-cart', [ProductsController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');


