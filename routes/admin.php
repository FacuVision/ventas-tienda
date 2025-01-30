<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComputerController;
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

Route::get('/', [HomeController::class, 'index'])->name('admin.index');

// Rutas para categorías
Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::get('listar_categories', [CategoryController::class, 'listar_categories'])->name('admin.categories.listar_categories');

// Rutas para categorías
Route::resource('computers', ComputerController::class)->names('admin.computers');
    Route::get('listar_computers', [ComputerController::class, 'listar_computers'])->name('admin.computers.listar_computers');

// Rutas para usuarios
Route::resource('users', UserController::class)->names('admin.users');
    Route::put('update_config/{id}', [UserController::class, 'update_config'])->name('admin.users.update_config');
    Route::get('listar_usuarios', [UserController::class, 'listar_usuarios'])->name('admin.users.listar_usuarios');
    Route::get("listar_roles", [UserController::class , "listar_roles"])->name("admin.users.listar_roles");
    Route::get("ver_usuario/{id}", [UserController::class , "ver_usuario"])->name("admin.users.ver_usuario");
