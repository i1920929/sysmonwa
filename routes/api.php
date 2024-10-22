<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WaterConsumptionController;
use App\Http\Controllers\Api\WaterLevelController;


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

Route::get('/water-consumption', [WaterConsumptionController::class, 'index']);

Route::get('/water-level', [WaterLevelController::class, 'index']);
Route::get('/daily-level', [WaterLevelController::class, 'getDailyLevel']);
