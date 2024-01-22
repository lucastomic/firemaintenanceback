<?php

use App\Http\Controllers\Maintenance\MaintenanceController;
use App\Http\Controllers\Status\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Equipment\EquipmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('v1')->group(function () {
Route::middleware(['jwt.auth'])->group(function () {
        Route::get('/user', [AuthController::class, 'getUser']);
        Route::get('/maintenances', [MaintenanceController::class, 'getByUser']);
        Route::post('/maintenance/{id}', [MaintenanceController::class, 'createMaintenance']);
        Route::get('/equipments', [EquipmentController::class, 'getAll']);
        Route::get('/equipment/{id}/maintenances', [MaintenanceController::class, 'getByEquipment']);
        Route::get('/equipment/{id}/statuses', [StatusController::class, 'getByEquipment']);
        Route::get('/equipment/{id}/lastStatus', [StatusController::class, 'getLastStatus']);
        Route::post('/equipment/{id}/status', [StatusController::class, 'addStatus']);
    });
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

});


