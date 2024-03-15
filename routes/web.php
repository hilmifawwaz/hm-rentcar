<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\RoutesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [RoutesController::class, 'index']);
Route::get('/schedules', [RoutesController::class, 'schedules']);

Route::get('/cars', [RoutesController::class, 'cars']);
Route::post('/post-cars', [CarsController::class, 'store']);
Route::resource('/get-cars', CarsController::class);

Route::get('/members', [RoutesController::class, 'members']);

Route::get('/history', [RoutesController::class, 'history']);
