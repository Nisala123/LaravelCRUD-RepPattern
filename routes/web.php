<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'getProducts'])->name('products.view_products');
Route::get('/products/add-products', [ProductController::class, 'addProducts'])->name('products.add_products');
Route::post('/product', [ProductController::class, 'storeProduct'])->name('products.store');
Route::get('/product/{product}/edit-products', [ProductController::class, 'editProducts'])->name('products.edit_products');
Route::put('/product/{product}/update-products', [ProductController::class, 'updateProducts'])->name('products.update_products');
Route::delete('/product/{product}/delete-products', [ProductController::class, 'deleteProducts'])->name('products.delete_products');
