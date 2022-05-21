<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Sales\SalesController;
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

Auth::routes();

// Route::post('custom_login', [App\Http\Controllers\Auth\LoginController::class, 'custom_login'])->name('custom_login');
Route::get('/', [HomeController::class, 'root'])->name('root');
Route::get('/ui', [HomeController::class, 'ui_design'])->name('ui_design');

//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);

Route::group([
    'prefix' => 'mob'
], function () {
    Route::get('/index', [HomeController::class, 'home']);
    Route::group([
        'prefix' => 'customer'
    ], function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/index', [CustomerController::class, 'index']);
        Route::get('/register', [CustomerController::class, 'register']);
        Route::get('/profile', [CustomerController::class, 'profile']);
    });
});

Route::group([
    'prefix' => 'web'
], function () {
    Route::get('/index', [HomeController::class, 'home']);
    Route::group([
        'prefix' => 'inventory'
    ], function () {
        Route::get('/', [InventoryController::class, 'index']);
    });
    Route::group([
        'prefix' => 'shop'
    ], function () {
        Route::get('/', [ShopController::class, 'index']);
    });
    Route::group([
        'prefix' => 'branch'
    ], function () {
        Route::get('/', [BranchController::class, 'index']);
    });
    Route::group([
        'prefix' => 'report'
    ], function () {
        Route::get('/', [ReportController::class, 'index']);
    });
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [UserController::class, 'index']);
    });
});

Route::group([
    'prefix' => 'lov'
], function () {
    Route::get('/', 'LovController@getLovs');
    Route::post('/', 'LovController@getLovs');
    Route::get('/get/{id}', 'LovController@getLovById');
    Route::post('/create', 'LovController@create');
    Route::post('/update', 'LovController@update');
    Route::post('/delete', 'LovController@delete');
    Route::get('/category/list', 'LovController@getLovCategoryList');
    Route::get('/category/default/', 'LovController@getDefaultLovByCodeCategory');
});

Route::prefix('/print-data')->group(function () {
    Route::get('/sales/{no_resit}', [SalesController::class, 'getSalesResit']);
});
