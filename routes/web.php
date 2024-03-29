<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LovController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
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
        Route::get('/list/{user}', [CustomerController::class, 'list']);
        Route::get('/index', [CustomerController::class, 'index']);
        Route::get('/register', [CustomerController::class, 'view']);
        Route::post('/register', [CustomerController::class, 'register']);
        Route::group(['prefix' => 'upload'], function () {
            Route::post('/', [CustomerController::class, 'upload']);
            Route::post('/delete', [CustomerController::class, 'delete_uploaded_img']);
        });
        Route::get('/profile/{task_id}/{route_id}/{id}', [CustomerController::class, 'profile']);
    });
    Route::group([
        'prefix' => 'inventory'
    ], function () {
        Route::get('/{user}', [InventoryController::class, 'index']);
        Route::post('/', [InventoryController::class, 'filter']);
        Route::post('/store', [InventoryController::class, 'store']);
    });
    Route::group([
        'prefix' => 'task'
    ], function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/create', [TaskController::class, 'create']);
        Route::get('/list/{user}', [TaskController::class, 'list']);
        Route::get('/details/{id}', [TaskController::class, 'details']);
        Route::get('/edit/{taskid}', [TaskController::class, 'updateTaskDetails']);
        Route::delete('/delete/{taskid}', [TaskController::class, 'deleteTask']);
        Route::group([
            'prefix' => 'route'
        ], function () {
            Route::get('/index', [TaskController::class, 'home']);
            Route::post('/add', [TaskController::class, 'addRoute']);
            Route::delete('/delete/{routeid}', [TaskController::class, 'deleteRoute']);
            Route::put('/update/{routeid}', [TaskController::class, 'updateRoute']);
            Route::group(['prefix' => 'upload'], function () {
                Route::post('/{routeid}', [TaskController::class, 'upload']);
                Route::post('/delete/{routeid}', [TaskController::class, 'delete_uploaded_img']);
            });
        });
    });
    Route::group([
        'prefix' => 'catalog'
    ], function () {
        Route::post('/add', [CatalogController::class, 'add']);
    });
    Route::group([
        'prefix' => 'report'
    ], function () {
        Route::get('/', [ReportController::class, 'index_mob']);
        Route::get('/export', [ReportController::class, 'export']);
        Route::get('/export/{user}', [ReportController::class, 'exportByUser']);
    });
});

Route::group([
    'prefix' => 'web'
], function () {
    Route::get('/index', [HomeController::class, 'home']);
    Route::group([
        'prefix' => 'inventory'
    ], function () {
        Route::get('/', [InventoryController::class, 'windex']);
        Route::post('/', [InventoryController::class, 'filter']);
    });
    Route::group([
        'prefix' => 'shop'
    ], function () {
        Route::get('/', [ShopController::class, 'index']);
        Route::get('/add', [ShopController::class, 'addShop']);
        Route::post('/create', [ShopController::class, 'save']);
        Route::get('/edit/{id}', [ShopController::class, 'editShop']);
        Route::put('/update', [ShopController::class, 'update']);
        Route::delete('/delete', [ShopController::class, 'delete']);
        Route::group(['prefix' => 'upload'], function () {
            Route::post('/', [ShopController::class, 'upload']);
            Route::post('/delete', [ShopController::class, 'delete_uploaded_img']);
        });
    });
    Route::group([
        'prefix' => 'branch'
    ], function () {
        Route::get('/', [BranchController::class, 'index']);
        Route::get('/get/{id}', [BranchController::class, 'show']);
        Route::post('/create', [BranchController::class, 'create']);
        Route::put('/update/{id}', [BranchController::class, 'update']);
        Route::delete('/delete/{id}', [BranchController::class, 'delete']);
        Route::group([
            'prefix' => 'inventory'
        ], function () {
            Route::get('/', [InventoryController::class, 'branchInventoryIndex']);
            Route::post('/create', [InventoryController::class, 'createBranchInventory']);
            Route::put('/update/{id}', [InventoryController::class, 'updateBranchInventory']);
            Route::delete('/delete/{id}', [InventoryController::class, 'deleteBranchInventory']);
        });
    });
    Route::group([
        'prefix' => 'report'
    ], function () {
        Route::get('/', [ReportController::class, 'index']);
        Route::get('export', [ReportController::class, 'export']);
    });
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('create', [UserController::class, 'create']);
        Route::put('update', [UserController::class, 'update']);
        Route::delete('delete', [UserController::class, 'delete']);
    });
    Route::group([
        'prefix' => 'lov'
    ], function () {
        Route::get('/', [LovController::class, 'getLovs']);
        Route::get('/get/{id}', [LovController::class, 'getLovById']);
        Route::post('/create', [LovController::class, 'create']);
        Route::put('/update', [LovController::class, 'update']);
        Route::delete('/delete', [LovController::class, 'delete']);
        Route::get('/category/default/', [LovController::class, 'getDefaultLovByCodeCategory']);
    });
    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('create', [ProductController::class, 'create']);
        Route::put('update', [ProductController::class, 'update']);
        Route::delete('delete', [ProductController::class, 'delete']);
    });
    Route::group([
        'prefix' => 'team'
    ], function () {
        Route::get('/', [TeamController::class, 'index']);
        Route::post('create', [TeamController::class, 'create']);
        Route::put('update', [TeamController::class, 'update']);
        Route::delete('delete', [TeamController::class, 'delete']);
        Route::group([
            'prefix' => 'member'
        ], function () {
            Route::get('/{team_id}', [TeamController::class, 'indexMember']);
            Route::post('create', [TeamController::class, 'addMember']);
            Route::put('update', [TeamController::class, 'updateMember']);
            Route::delete('delete', [TeamController::class, 'deleteMember']);
        });
    });
});

Route::group([
    'prefix' => 'profile'
], function () {
    Route::get('/{id}', [UserController::class, 'viewProfile']);
});

Route::prefix('/print-data')->group(function () {
    Route::get('/sales/{no_resit}', [SalesController::class, 'getSalesResit']);
});
