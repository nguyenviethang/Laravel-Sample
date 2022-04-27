<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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


Route::get('/', [LoginController::class, 'view']);

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('check.login');

Route::middleware(['auth'])->group(function () {
    Route::post('/change-password', [UserController::class, 'submitChangePassword'])->name('change.password');
    Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');
    Route::get('/change-password-view', [UserController::class, 'changePassword'])->name('change.password.view');
    Route::middleware('first.login.checker')->group(function () {
        Route::get('/user/list', [UserController::class, 'index'])->name('user.list')->middleware(['role.checker:' . config('const.ROLE.MANAGE') . ',null']);
        Route::get('/user/export/', [UserController::class, 'export'])->name('user.export')->middleware(['role.checker:' . config('const.ROLE.MANAGE') . ',null']);
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
        Route::post('update-profile', [UserController::class, 'updateProfile'])->name('profile.save');
        Route::middleware('role.checker:null ,null')->group(function () {
            Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/{id}', [UserController::class, 'edit'])->name('user.edit')->where('id', '[0-9]+');
            Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
            Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
            Route::post('/user/reset', [UserController::class, 'reset'])->name('user.reset');
            Route::get('/department/list', [DepartmentController::class, 'index'])->name('department.list');
            Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
            Route::post('/department/update', [DepartmentController::class, 'update'])->name('department.update');
            Route::post('/department/delete', [DepartmentController::class, 'delete'])->name('department.delete');

            Route::get('/prmanage/list', [PrmanageController::class, 'index'])->name('prmanage.list');
        });
    });
});
