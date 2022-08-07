<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiTeamController;
use App\Http\Controllers\Api\ApiInventoryController;
use App\Http\Controllers\Sales\SalesController as Sales;

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

Route::prefix('/v1')->group(function(){
    Route::prefix('/sales')->group(function () {
        Route::post('/create', [Sales::class, 'createSales']);
    });

    Route::prefix('/member')->group(function () {
        Route::post('/list', [ApiTeamController::class, 'listByTeamId']);
    });

    Route::prefix('/inventory')->group(function () {
        Route::post('/validate', [ApiInventoryController::class, 'validateStockAtBranchInventory']);
    });
});
