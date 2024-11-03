<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanqueController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\WaterConsumptionController;
use App\Http\Controllers\Api\WaterLevelController;


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


// Route::get('/', function () {
//     return view('auth/login');
// });

 Route::get('/', function () {
     return view('index');
 });


Route::resource('tanques', TanqueController::class);
Route::resource('clients', ClientController::class);
Route::resource('sensors', SensorController::class);
Auth::routes();
Route::resource('users', UserController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/consumption/realtime', function () {
    return view('consumption.realtime');
});
Route::get('/level/realtime', function () {
    return view('level.realtime');
});

// Route::get('/consumption/historical', function () {
//     return view('consumption.historical');
// });


Route::get('/api/water-consumption', [WaterConsumptionController::class, 'index']);
Route::get('/api/daily-consumption', [WaterConsumptionController::class, 'getDailyConsumption']);

Route::get('/consumption/historical', [WaterConsumptionController::class, 'historicalData'])->name('historical.data');

Route::get('/export-water-consumption', [WaterConsumptionController::class, 'exportCSV'])->name('export.water.consumption');
Route::get('/export-water-consumption-xls', [WaterConsumptionController::class, 'exportXLS'])->name('export.water.consumption.xls');

Route::get('/enviar-alerta', [WaterConsumptionController::class, 'enviarAlertaConsumo']);


// Rutas Nivel de agua

Route::get('/level/realtime', function () {
    return view('level.realtime');
});

Route::get('/water-level', [WaterLevelController::class, 'index']);
Route::get('/daily-level', [WaterLevelController::class, 'getDailyLevel']);
Route::get('/api/water-level/latest', [WaterLevelController::class, 'getLatestLevel']);
Route::get('/level/historical', [WaterLevelController::class, 'historicalData'])->name('historical.data');
Route::get('/export-water-level', [WaterLevelController::class, 'exportCSV'])->name('export.water.level');
Route::get('/export-water-level-xls', [WaterLevelController::class, 'exportXLS'])->name('export.water.level.xls');
Route::get('/send-test-water-alert', [WaterLevelController::class, 'enviarAlertaNivel']);