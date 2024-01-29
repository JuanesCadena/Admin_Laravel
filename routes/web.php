<?php

use App\Http\Controllers\ProfileController;
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
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');

Route::get('/users/firmas', [\App\Http\Controllers\UserController::class, 'peticionesFirmadas'])->middleware('auth');


Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');

Route::get('/users/firmas', [\App\Http\Controllers\UserController::class, 'peticionesFirmadas'])->middleware('auth');


    Route::controller(\App\Http\Controllers\PeticioneController::class)->group(function () {
        Route::get('peticiones/index', 'index')->name('peticiones.index');
        Route::get('mispeticiones', 'listMine')->name('peticiones.mine');
        Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('peticiones.peticionesfirmadas');
        Route::get('peticiones/{id}', 'show')->name('peticiones.show');
        Route::get('peticion/add', 'create')->name('peticiones.create');
        Route::post('peticion', 'store')->name('peticiones.store');
        Route::delete('peticiones/{id}', 'delete')->name('peticiones.delete');
        Route::put('peticiones/{id}', 'update')->name('peticiones.update');
        Route::post('peticiones/firmar/{id}', 'firmar')->name('peticiones.firmar');
        Route::get('peticiones/edit/{id}', 'update')->name('peticiones.edit');

       // Route::resource('peticiones',\App\Http\Controllers\PeticioneController::class);
        //Route::get('/peticiones/',[\App\Http\Controllers\PeticioneController::class, 'index']);

});


Route::middleware('admin')->controller(\App\Http\Controllers\Admin\AdminPeticionesController::class)->group(function () {
    Route::get('admin', 'index')->name('admin.home');
Route::get('admin/peticiones/index', 'index')->name('admin.peticiones.index');
Route::get('admin/peticiones/{id}', 'show')->name('admin.peticiones.show');
Route::get('admin/peticion/add', 'create')->name('admin.peticiones.create');
Route::get('admin/peticiones/edit/{id}', 'edit')->name('admin.peticiones.edit');
Route::post('admin/peticiones', 'store')->name('admin.peticiones.store');
Route::delete('admin/peticiones/{id}', 'delete')->name('admin.peticiones.delete');
Route::put('admin/peticiones/{id}', 'update')->name('admin.peticiones.update');
Route::put('admin/peticiones/estado/{id}', 'cambiarEstado')->name('admin.peticiones.estado');

});

Route::middleware('admin')->controller(\App\Http\Controllers\Admin\AdminUsersController::class)->group(function () {
    Route::get('admin/users/index', 'index')->name('admin.users.index');
    Route::get('admin/users/{id}', 'show')->name('admin.users.show');
    Route::get('admin/user/add', 'create')->name('admin.users.create');

    Route::get('admin/users/edit/{id}', 'edit')->name('admin.users.edit');

    Route::post('admin/users', 'store')->name('admin.users.store');
    Route::delete('admin/users/{id}', 'delete')->name('admin.users.delete');
    Route::put('admin/users/{id}', 'update')->name('admin.users.update');

});

Route::middleware('admin')->controller(\App\Http\Controllers\Admin\AdminCategoriasController::class)->group(function () {
    Route::get('admin/categorias/index', 'index')->name('admin.categorias.index');
    Route::get('admin/categorias/{id}', 'show')->name('admin.categorias.show');
    Route::get('admin/categoria/add', 'create')->name('admin.categorias.create');

    Route::get('admin/categorias/edit/{id}', 'edit')->name('admin.categorias.edit');

    Route::post('admin/categorias', 'store')->name('admin.categorias.store');
    Route::delete('admin/categorias/{id}', 'delete')->name('admin.categorias.delete');
    Route::put('admin/categorias/{id}', 'update')->name('admin.categorias.update');

});

