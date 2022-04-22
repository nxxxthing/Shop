<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/change', [\App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'role:admin|super-admin',
    'prefix' => 'admin-panel'
], function ($router) {
    Route::get('/', [HomeController::class, 'index'])->name('homeAdmin');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
