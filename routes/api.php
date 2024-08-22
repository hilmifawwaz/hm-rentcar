<?php

use App\Http\Controllers\API\CarsControllerAPI;
use App\Http\Controllers\API\FinanceControllerAPI;
use App\Http\Controllers\API\SchedulesControllerAPI;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthenticationController::class, 'index']);

Route::get('cars', [CarsControllerAPI::class, 'index'])->middleware('auth:sanctum');
Route::post('cars', [CarsControllerAPI::class, 'store']);
Route::patch('cars/{id}', [CarsControllerAPI::class, 'edit']);
Route::delete('cars/{id}', [CarsControllerAPI::class, 'destroy']);

Route::get('schedule', [SchedulesControllerAPI::class, 'index']);
Route::post('schedule', [SchedulesControllerAPI::class, 'store']);
Route::patch('schedule/{id}', [SchedulesControllerAPI::class, 'update']);
Route::delete('schedule/{id}', [SchedulesControllerAPI::class, 'destroy']);
Route::patch('schedule/status/{id}', [SchedulesControllerAPI::class, 'updateStatus']);

Route::get('finance', [FinanceControllerAPI::class, 'index']);
Route::post('finance', [FinanceControllerAPI::class, 'store']);
Route::patch('finance/{id}', [FinanceControllerAPI::class, 'update']);
Route::delete('finance/{id}', [FinanceControllerAPI::class, 'destroy']);
