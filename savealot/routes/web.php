<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

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

// Adding more default view in //
Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/privacy', 'privacy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(InventoryController::class)->group(function () {
    Route::get('/', 'homepage');
    Route::get('/index', 'homepage');
    Route::get('/inventory-create', 'create');
    Route::post('/inventory-create', 'store');
    Route::get('/inventory-{id}', 'edit');
    Route::post('/inventory-{id}', 'update');
    Route::post('/inventory/{id}/destroy', 'destroy');
    Route::post('/inventory/{id}/updateQty', 'updateQuantity');
    Route::get('/shop', 'shop');
    Route::get('/shop/{id}', 'show');
    Route::post('/shop/{id}/addToCart', 'addToCart');
    Route::post('/shop/{id}/removeFromCart', 'removeFromCart');
    Route::get('/search', 'search');
    Route::get('/cart', 'cart');
    Route::post('/emptyCart', 'emptyCart');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/cart/checkout', 'checkOut');
    Route::get('/orderhistory', 'orderHistory');
    Route::put('/order/{id}', 'update');
    Route::delete('/order/{id}', 'destroy');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/inventory', 'inventoriesDashboard');
    Route::get('/admin', 'adminRedirect');
    Route::get('/adminDashboard', 'adminDashboard');
    Route::get('/orders', 'ordersDashboard');
    Route::get('/ordersList', 'allOrders');
    Route::get('/users', 'usersDashboard');
    Route::get('/usersList', 'allUsers');
    Route::get('/transactions', 'transactionsDashboard');
});