<?php

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
Route::get('/members', [RoutesController::class, 'members']);
