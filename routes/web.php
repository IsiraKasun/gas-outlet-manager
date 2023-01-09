<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'loginPage']);
Route::get('/signup', [AuthController::class, 'signupPage']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/outlets', [OutletController::class, 'index']);
Route::get('/add-outlet', [OutletController::class, 'addOutlet']);
Route::post('/create-outlet', [OutletController::class, 'createOutlet']);
Route::get('/change-price/{id}', [OutletController::class, 'changePrice']);
Route::get('/get-price/{id}', [OutletController::class, 'getPrices']);
Route::post('/update-price', [OutletController::class, 'updatePrice']);

Route::get('/new-order', [OrderController::class, 'newOrder']);
Route::get('/orders', [OrderController::class, 'orderHistory']);
Route::post('/create-order', [OrderController::class, 'createOrder']);




