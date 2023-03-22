<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InventoryController;

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
Route::view('/index', 'index');
Route::view('/shop', 'shop');
Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/cart', 'cart');
Route::view('/admin', 'admin');
// Route::get('/{page}', function (string $page) {
//     return view("$page");
// });
// These might all be phased out later //



// Route::get('/', function () {
//     return view('index.html');
// });

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('inventory',InventoryController::class)
//     ->only(['index']);

// Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'index']);
// Route::get('/inventory/{id}', [App\Http\Controllers\InventoryController::class, 'show']);
Route::get('/shop', [App\Http\Controllers\InventoryController::class, 'shop']);


Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventory', 'index');
    Route::get('/inventory/create', 'create');
    Route::get('/inventory/{id}', 'edit');
    Route::get('/shop/{id}', 'show');
    // Route::post('/orders', 'store');
});


