<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

//Route::middleware('auth')->group(function (){
Route::get('/', [Controllers\IndexController::class, 'index'])->name('home');
Route::resource('users', Controllers\UserController::class);
Route::resource('roles', Controllers\RoleController::class);
Route::resource('logs', Controllers\LogController::class)->middleware('role:Администратор');
Route::resource('categories', Controllers\CategoryController::class);
Route::put('product/{id}', [Controllers\ProductController::class, 'deleteimage'])->name('deleteimage');
Route::resource('products', Controllers\ProductController::class);
Route::resource('units', Controllers\UnitController::class);
Route::resource('storages', Controllers\StorageController::class);
Route::resource('acceptances', Controllers\AcceptanceController::class);
Route::resource('movements', Controllers\MovementController::class);
Route::get('search', [Controllers\MovementController::class, 'search'])->name('search');
//});

require __DIR__ . '/auth.php';
