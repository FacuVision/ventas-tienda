<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,"index"])->name("admin.index");

Route::resource('categories', CategoryController::class)->names("admin.categories");
    Route::get("listar_categories", [CategoryController::class , "listar_categories"])->name("admin.categories.listar_categories");
    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un area */

Route::resource('users', UserController::class)->names("admin.users");
    Route::put('update_config/{id}', [UserController::class, 'update_config'])->name('admin.users.update_config');
    Route::get("listar_users", [UserController::class , "listar_users"])->name("admin.users.listar_users");

    /* Notas:
    - function show($id) - Se está reutilizando para reactivar un area */
