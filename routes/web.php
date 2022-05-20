<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::post('custom_login', [App\Http\Controllers\Auth\LoginController::class, 'custom_login'])->name('custom_login');
Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::group([
    'prefix' => 'inventory'
], function () {
    // Route::get('/', 'InventoryController@getInventoryList');
    // Route::post('/create', 'InventoryController@addInventory');
    // Route::post('/delete', 'InventoryController@deleteInventory');
});

Route::group([
    'prefix' => 'branch'
], function () {
    // Route::get('/', 'BranchController@getBranchs');
    // Route::post('/create', 'BranchController@addBranch');
    // Route::post('/update', 'BranchController@updateBranch');
    // Route::post('/delete', 'BranchController@deleteBranch');
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

Route::group([
    'prefix' => 'product'
], function () {
    // Route::get('/', 'ProductController@getProducts');
    // Route::post('/create', 'ProductController@addProduct');
    // Route::post('/update', 'ProductController@updateProduct');
    // Route::post('/delete', 'ProductController@deleteProduct');
    // Route::group([
    //     'prefix' => 'package'
    // ], function () {
    //     Route::get('/', 'ProductController@getProductPackages');
    //     Route::post('/create', 'ProductController@addProductPackage');
    //     Route::post('/update', 'ProductController@updateProductPackage');
    //     Route::post('/delete', 'ProductController@deleteProductPackage');
    // });
});

Route::group([
    'prefix' => 'team'
], function () {
    // Route::get('/', 'TeamController@getTeams');
    // Route::post('/create', 'TeamController@addTeam');
    // Route::post('/update', 'TeamController@updateTeam');
    // Route::post('/delete', 'TeamController@deleteTeam');
    // Route::group([
    //     'prefix' => 'agent'
    // ], function () {
    //     Route::get('/', 'AgentController@getAgents');
    //     Route::post('/create', 'AgentController@addAgent');
    //     Route::post('/update', 'AgentController@updateAgent');
    //     Route::post('/delete', 'AgentController@deleteAgent');
    // });
});
