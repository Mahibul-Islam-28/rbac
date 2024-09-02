<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManageController;

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

// ===========================================
// =============== User Panel ================
// ===========================================

Route::get('/login', [LoginController::class, 'login'])->name('userLogin');
Route::post('/login', [LoginController::class, 'logData']);

Route::get('/registration', [LoginController::class, 'register'])->name('userRegister');
Route::post('/registration', [LoginController::class, 'registerData']);

Route::middleware(['userLogin'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('userLogout');
});


// ===========================================
// =============== Admin Panel ===============
// ===========================================

Route::group(['prefix' => 'adminPanel'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('adminLogin');
    Route::post('/login', [AdminController::class, 'logData']);

    Route::middleware(['adminLogin'])->group(function () {
        // logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('adminLogout');

        Route::get('/', [UserManageController::class, 'dashboard'])->name('dashboard');

        Route::get('/user/create', [UserManageController::class, 'create'])->name('userCreate');
        Route::post('/user/create', [UserManageController::class, 'store']);
        Route::get('/user/{id}/edit', [UserManageController::class, 'edit'])->name('userEdit');
        Route::post('/user/{id}/edit', [UserManageController::class, 'update']);
        Route::delete('/user/{id}/delete', [UserManageController::class, 'delete'])->name('userDelete');

        // Permission
        Route::get('/user/{id}/permission', [UserManageController::class, 'permission'])->name('setPermission');
        Route::post('/user/{id}/permission', [UserManageController::class, 'setPermission']);
    });

});
