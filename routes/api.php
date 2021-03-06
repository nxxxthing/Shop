<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PagesController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'products'
], function ($router) {
    Route::get('/', [ApiController::class, 'index']);
    Route::get('/product/{id}', [ApiController::class, 'show']);
});

Route::group([
    'middleware' => ['api', 'role:admin|super-admin'],
    'prefix' => 'admin'
], function ($router) {
    Route::post('/order/save', [ApiController::class, 'save_admin']);
    Route::get('/pages', [PagesController::class, 'index']);
    Route::get('/pages/{id}', [PagesController::class, 'show']);
});


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
